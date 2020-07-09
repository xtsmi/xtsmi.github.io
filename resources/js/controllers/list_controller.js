import { Controller } from 'stimulus';
import ScrollWatch from 'scrollwatch';
import Handlebars from 'handlebars';

export default class extends Controller {
    async getNews() {
        const response = await fetch('/api/last-news.json');
        if (response.ok) {
            let json = await response.json();
            return json;
        } else {
            alert('Ошибка HTTP: ' + response.status);
        }
    }

    async connect() {
        const news = await this.getNews();
        // eslint-disable-next-line no-undef
        var template = Handlebars.compile(newsListItemTemplate.innerHTML);
        var sw = new ScrollWatch({
            watch: 'div',
            infiniteScroll: true,
            infiniteOffset: 400,
            onInfiniteYInView: () => {
                const item = Object.values(news)[0];
                var child = document.createElement('div');
                child.innerHTML = template({
                    favicon: 'favicon',
                    domain: 'domain',
                    link: item.link,
                    title: item.title,
                    pubDate: item.pubDate,
                });
                this.element.appendChild(child);

                sw.refresh();
            },
        });
    }
}
