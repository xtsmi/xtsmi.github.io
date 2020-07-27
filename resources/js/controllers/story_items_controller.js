import { Controller } from 'stimulus';

export default class extends Controller {
    static get targets() {
        return ['showMoreBtn'];
    }

    show() {
        const items = this.element.getElementsByClassName('d-none');

        for (const item of items) {
            item.classList.remove('d-none');
        }

        this.showMoreBtnTarget.classList.add('d-none');
    }
}
