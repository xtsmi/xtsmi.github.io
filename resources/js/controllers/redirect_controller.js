import {Controller} from 'stimulus';

export default class extends Controller {
    initialize() {
        const baseURI = document.baseURI;

        if (this.data.get('url') === '') {
            return;
        }

        if (document.referrer.includes(baseURI)) {
            //window.open(window.location.href,'_blank');
            //window.location.replace(this.data.get('url'));

            //window.open(this.data.get('url'),'_blank');

            fetch('/').then(() => window.open(this.data.get('url'), '_blank'))
        }
    }
}
