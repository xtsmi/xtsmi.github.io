import { Controller } from 'stimulus';

export default class extends Controller {
    show(event) {
        const items = this.element.getElementsByClassName('d-none');

        for (const item of items) {
            item.classList.remove('d-none');
        }

        event.target.parentElement.classList.add('d-none');
    }
}
