import {Controller} from 'stimulus';

export default class extends Controller {

    show(event) {

        let items = this.element.getElementsByClassName('d-none');

        for (let i = 0; i < items.length; i++) {
            items[i].classList.remove("d-none");
        }

        event.target.parentElement.classList.add("d-none")
    }

}
