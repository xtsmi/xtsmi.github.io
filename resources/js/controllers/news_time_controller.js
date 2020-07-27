import { Controller } from 'stimulus';
import { timeSince } from '../lib/format_date';

export default class extends Controller {
    initialize() {
        this.element.innerHTML = timeSince(this.element.innerText.trim());
    }
}
