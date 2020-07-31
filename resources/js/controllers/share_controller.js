import {Controller} from 'stimulus';

export default class extends Controller {

    /**
     *
     * @param event
     */
    openVK(event) {
        this.popupCenter('http://vk.com/share.php?url=', '', 600, 400);
    }

    /**
     *
     * @param event
     */
    openOk(event) {
        this.popupCenter('http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl=', '', 600, 400);
    }

    /**
     *
     * @param event
     */
    openFacebook(event) {
        this.popupCenter('http://www.facebook.com/sharer.php?u=', '', 600, 400);
    }

    /**
     *
     * @param event
     */
    openTwitter(event) {
        this.popupCenter('https://twitter.com/share?url=', '', 600, 400);
    }

    /**
     *
     * @param url
     * @param title
     * @param w
     * @param h
     * @returns {Window}
     */
    popupCenter(url, title, w, h) {
        let left = (screen.width / 2) - (w / 2);
        let top = (screen.height / 2) - (h / 2);

        return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    }
}
