/* eslint-disable no-useless-escape */
import { Controller } from 'stimulus';

const LOAD_LAST_NEWS_COUNT = 7;
const LOAD_GROUPS_COUNT = 2;

export default class extends Controller {
    static targets = ['groups', 'lastNews', 'groupsItem', 'lastNewsItem'];

    loadingLastNews = false;

    loadingGroups = false;

    async connect() {
        this.newsTemplate = document.getElementById('news-template').innerHTML;
        this.storyTemplate = document.getElementById(
            'story-template',
        ).innerHTML;

        document.addEventListener('scroll', () => {
            if (!(this.loadingLastNews && this.loadingGroups)) {
                if (this.needLoad(this.groupsItemTargets, 'groups')) {
                    this.loadMoreGroups();
                    this.groupsTarget.classList.add('news-ended');
                }

                this.needLoad(this.lastNewsItemTargets, 'news') &&
                    this.loadMoreNews();
            }
        });

        this.news = Object.values(await this.getNews());
        this.groups = Object.values(await this.getGroups());
    }

    async getNews() {
        const response = await fetch('/api/last-news.json');
        if (response.ok) {
            let json = await response.json();
            return json;
        } else {
            console.error('NEWS HTTP ERROR: ' + response.status);
        }
    }

    async getGroups() {
        const response = await fetch('/api/similar-news.json');
        if (response.ok) {
            let json = await response.json();
            return json;
        } else {
            console.error('GROUPS HTTP ERROR: ' + response.status);
        }
    }

    renderTemplate(template, params) {
        return Object.entries(params).reduce((memo, [key, val]) => {
            return memo.replace(
                // eslint-disable-next-line no-useless-escape
                new RegExp(`\\{\\{\\s*\\$${key}\\s*\\}\\}`, 'gm'),
                val,
            );
        }, template);
    }

    loadMoreGroups() {
        if (!this.groups) {
            return;
        }

        this.loadingGroups = true;

        const lastIndex = this.groupsItemTargets.length;

        this.groupsTarget.innerHTML += this.groups
            .slice(lastIndex, lastIndex + LOAD_GROUPS_COUNT)
            .reduce((memo, item) => {
                const { main, items } = item;
                const headerTemplate = this.storyTemplate.replace(
                    main.image
                        ? /(?:(\@empty\(\!\$image\))|(\@endempty))/gs
                        : /\@empty.*\@endempty/gs,
                    '',
                );
                const newsContent = Object.values(items)
                    .slice(0, 3)
                    .reduce((memo, item) => {
                        console.log(item);
                        return (
                            memo + this.renderTemplate(this.newsTemplate, item)
                        );
                    }, '');

                //todo: убрать хардкод
                return `${memo}
                    <article class="bg-white pt-3 px-3 mb-4 rounded shadow-sm" data-target="main.groupsItem">
                        ${this.renderTemplate(headerTemplate, item.main)}
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                            ${newsContent}
                        </div>
                    </article>
                    `;
            }, '');

        this.loadingGroups = false;
    }

    loadMoreNews() {
        if (!this.news) {
            return;
        }

        this.loadingLastNews = true;

        const lastIndex = this.lastNewsItemTargets.length;

        if (lastIndex === this.news.length) {
            this.lastNewsTarget.classList.add('news-ended');
        }

        this.lastNewsTarget.innerHTML += this.news
            .slice(lastIndex, lastIndex + LOAD_LAST_NEWS_COUNT)
            .reduce((memo, item) => {
                return memo + this.renderTemplate(this.newsTemplate, item);
            }, '');

        this.loadingLastNews = false;
    }

    needLoad(targets) {
        const lastTarget = targets[targets.length - 1];
        const rect = lastTarget.getBoundingClientRect();

        return (
            rect.bottom > 0 &&
            rect.top <
                (window.innerHeight || document.documentElement.clientHeight)
        );
    }
}
