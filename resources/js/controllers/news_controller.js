/* eslint-disable no-useless-escape */
import { Controller } from 'stimulus';

const PORTION_COUNT = 7;

export default class extends Controller {
    static targets = ['item', 'news'];

    loading = false;

    async connect() {
        this.newsTemplate = document.getElementById('news-template').innerHTML;

        document.addEventListener('scroll', () => this.loadMoreNews());

        this.news = Object.values(await this.getNews()).sort(
            (a, b) => new Date(b.pubDate) - new Date(a.pubDate),
        );
        this.loadMoreNews();
    }

    async getNews() {
        const response = await fetch('/api/last-news.json');
        if (response.ok) {
            return response.json();
        }
    }

    renderTemplate(template, params) {
        return Object.entries(params).reduce(
            (memo, [key, val]) =>
                memo.replace(
                    // eslint-disable-next-line no-useless-escape
                    new RegExp(`\\{\\{\\s*\\$${key}\\s*\\}\\}`, 'gm'),
                    val,
                ),
            template,
        );
    }

    loadMoreNews() {
        if (!this.news || this.loading || !this.needLoad(this.itemTargets)) {
            return;
        }

        this.loading = true;

        const lastIndex = this.itemTargets.length;

        if (lastIndex === this.news.length) {
            this.element.classList.add('news-ended');
        }

        this.news.slice(lastIndex, lastIndex + PORTION_COUNT).forEach(
            _item => {
                const item = {
                    ..._item,
                    link: _item.internalLink,
                };

                const div = document.createElement('div');
                div.innerHTML = this.renderTemplate(this.newsTemplate, item);

                this.newsTarget.appendChild(div);
            },

            '',
        );

        this.loading = false;

        return this.loadMoreNews();
    }

    needLoad(targets) {
        const lastTarget = targets[targets.length - 1];
        const rect = lastTarget.getBoundingClientRect();

        return (
            rect.bottom !== 0 &&
            rect.top <
                (window.innerHeight || document.documentElement.clientHeight) +
                    300
        );
    }
}
