import {Controller} from 'stimulus';

export default class extends Controller {
    initialize() {
        const baseURI = document.baseURI;

        if (this.data.get('url') === '') {
            return;
        }

        if (document.referrer.includes(baseURI)) {
            window.location.replace(this.data.get('url'));
        }
    }
}
