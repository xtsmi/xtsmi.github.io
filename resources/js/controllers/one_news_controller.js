import {Controller} from 'stimulus';

export default class extends Controller {

    connect() {
        const baseURI = document.baseURI;

        if (document.referrer.includes(baseURI)) {
            window.location.replace(this.data.get('url'));
        }
    }
}
