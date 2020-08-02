import { Controller } from 'stimulus';

export default class extends Controller {
    static get targets() {
        return ['content'];
    }

    toggleMobileView(e) {
        const method = e.target.checked ? 'add' : 'remove';
        this.contentTarget.classList[method]('last-news');
    }
}
