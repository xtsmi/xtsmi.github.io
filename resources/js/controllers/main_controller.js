import {Controller} from 'stimulus';
import Handlebars from 'handlebars'

const LOADING_DISTANCE = 100;

export default class extends Controller {
    static targets = ['groups', 'lastNews', 'groupsItem', 'lastNewsItem'];

    loadingLastNews = false;

    loadingGroups = false;

    async getNews() {
        const response = await fetch('/api/last-news.json');
        if (response.ok) {
            let json = await response.json();
            return json;
        } else {
            alert('Ошибка HTTP: ' + response.status);
        }
    }

    loadMoreGroups() {
        this.loadingGroups = true;

        const el = document.createElement('div');
        el.innerHTML = 'groups';
        this.groupsTarget.appendChild(el);
        console.log('load more groups');
        this.loadingGroups = false;
    }

    loadMoreNews() {
        this.loadingLastNews = true;

        const template = Handlebars.compile(
            document.getElementById('last-news-template').innerHTML
        );

        this.lastNewsTarget.innerHTML += template({
            $title: 'Загрузка...',
            $domain: 'Загрузка...',
            $favicon: 'Загрузка...',
            $link: 'Загрузка...',
            $pubDate: 'Загрузка...',
        })

        console.log('load more news');
        this.loadingLastNews = false;
    }

    needLoad(targets) {
        const lastTarget = targets[targets.length - 1];
        const rect = lastTarget.getBoundingClientRect();

        return rect.top - rect.height - LOADING_DISTANCE < 0;
    }

    async connect() {
        document.addEventListener('scroll', () => {
            this.loadingLastNews ||
                (this.needLoad(this.groupsItemTargets) &&
                    this.loadMoreGroups());
            this.loadingGroups ||
                (this.needLoad(this.lastNewsItemTargets) &&
                    this.loadMoreNews());
        });
    }
}
