<?php

namespace App;

use Illuminate\Support\Collection;

/**
 * Class Similar
 *
 * @package App
 */
class Similar
{
    /**
     * @var Collection
     */
    protected $matrix;

    /**
     * @return Collection|null
     */
    private function getMatrix(): ?Collection
    {
        return $this->matrix;
    }

    /**
     * @param Collection $titles
     * @param float      $percent
     *
     * @return Similar
     */
    private function create(Collection $titles, float $percent): Similar
    {
        $matrix = [];

        $titles->each(static function ($item, $key) use ($titles, &$matrix, $percent) {

            $titles->each(static function ($title, $relation) use ($item, $key, &$matrix, $percent) {
                similar_text($item, $title, $copy);

                if ($percent < $copy) {
                    $matrix[$key][] = $relation;
                }

            });
        });

        $this->matrix = collect($matrix);

        return $this;
    }

    /**
     * @return Similar
     */
    private function merge(): Similar
    {
        $similarGroup = [];

        $this->matrix->each(function ($group, $key) use (&$similarGroup) {

            $this->matrix->each(function ($simGroup) use ($group, $key, &$similarGroup) {

                if (empty(array_intersect($group, $simGroup))) {
                    return;
                }

                $similarGroup[$key] = collect(array_merge($group, $simGroup))->unique()->toArray();
            });
        });

        $this->matrix = collect($similarGroup);

        return $this;
    }

    /**
     *
     * @return Similar
     */
    private function removeDuplicated(): Similar
    {
        $removes = [];

        $this->matrix->each(function ($items) use (&$removes) {

            sort($items, SORT_NUMERIC);
            $items = array_values($items);

            $this->matrix->each(function ($collect, $keyCollect) use ($items, &$removes) {

                sort($collect, SORT_NUMERIC);
                $collect = array_values($collect);


                // Проверяемый блок больше, то его нельзя удалить
                if (count($items) < count($collect)) {
                    return;
                }

                // Полностью одинаковые блоки будут удалены позднее
                if ($items === $collect) {
                    return;
                }

                if (count(array_intersect($collect, $items)) > 0) {
                    $removes[] = $keyCollect;
                    return;
                }


            });
        });

        $this->matrix = $this->matrix->map(static function ($item, $key) use ($removes) {

            if (in_array($key, $removes, true)) {
                return [];
            }

            asort($item);

            return $item;

        })
            ->filter()
            ->unique(function ($item) {
                return implode(',', $item);
            });

        return $this;
    }

    /**
     * @param array $titles
     * @param float $percent
     *
     * @return Collection
     */
    public static function build(array $titles, float $percent = 51): Collection
    {
        $matrix = (new self())
            ->create(collect($titles), $percent)
            ->merge()
            ->removeDuplicated()
            ->getMatrix();

        $realGroup = [];


        foreach ($matrix as $key => $groups) {
            foreach ($groups as $titleKey) {
                $realGroup[$key][$titleKey] = $titles[$titleKey];
            }
        }

        return collect($realGroup)
            ->sortByDesc(function ($product) {
                return count($product);
            });
    }
}
