/* eslint-disable no-useless-escape */
import { Controller } from 'stimulus';

const PORTION_COUNT = 7;

export default class extends Controller {
    static targets = ['item'];

    loading = false;

    async connect() {
        this.newsTemplate = document.getElementById('news-template').innerHTML;

        document.addEventListener('scroll', () => this.loadMoreNews());

        this.news = Object.values(await this.getNews());
        this.loadMoreNews();
    }

    async getNews() {
        const response = await fetch('/api/last-news.json');
        if (response.ok) {
            let json = await response.json();
            return json;
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

        this.element.innerHTML += this.news
            .slice(lastIndex, lastIndex + PORTION_COUNT)
            .reduce(
                (memo, item) =>
                    memo + this.renderTemplate(this.newsTemplate, item),
                '',
            );

        this.loading = false;

        return this.loadMoreNews();
    }

    needLoad(targets) {
        const lastTarget = targets[targets.length - 1];
        const rect = lastTarget.getBoundingClientRect();

        return (
            rect.top <
            (window.innerHeight || document.documentElement.clientHeight) + 300
        );
    }
}
