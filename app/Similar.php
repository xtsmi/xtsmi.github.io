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
     * @return Collection
     */
    private function getMatrix(): Collection
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
        $this->matrix = $titles->transform(static function ($item) use ($titles, $percent) {
            return $titles->filter(static function ($title) use ($item, $percent) {

                similar_text($item, $title, $copy);

                return $percent < $copy;
            });
        });

        return $this;
    }

    /**
     * @return Similar
     */
    private function merge(): Similar
    {
        $this->matrix->transform(function (Collection $group) {
            return $this->matrix->map(function (Collection $simGroup) use ($group) {

                return $group->intersect($simGroup)->isNotEmpty()
                    ? $group->merge($simGroup)
                    : null;

            })->flatten()->filter()->unique();
        });

        return $this;
    }

    /**
     *
     * @return Similar
     */
    private function removeDuplicated(): Similar
    {
        $removes = [];

        $this->matrix->each(function (Collection $items, $keys) use (&$removes) {

            $this->matrix->each(function (Collection $collect, $keyCollect) use ($keys, $items, &$removes) {

                // Проверяемый блок больше, то его нельзя удалить
                if ($items->count() < $collect->count()) {
                    return;
                }

                // Полностью одинаковые блоки будут удалены позднее
                if ($items === $collect) {
                    return;
                }

                if ($collect->intersect($items)->isNotEmpty()) {
                    $removes[$keys][] = $keyCollect;
                    return;
                }
            });
        });


        $this->matrix = $this->matrix
            ->filter(function ($item, $key) use ($removes) {
                return isset($removes[$key]);
            })
            ->unique(function (Collection $item) {
                return $item->sort()->implode('~~~');
            });

        return $this;
    }

    /**
     * @param array $titles
     *
     * @return Similar
     */
    private function recoveryKeys(array $titles): Similar
    {
        $this->matrix = $this->matrix->map->keyBy(function ($value) use ($titles) {
            return array_search($value, $titles, true);
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
        return (new self())
            ->create(collect($titles), $percent)
            ->merge()
            ->removeDuplicated()
            ->recoveryKeys($titles)
            ->getMatrix()
            ->sortByDesc(function (Collection $items) {
                return $items->count();
            });
    }
}
