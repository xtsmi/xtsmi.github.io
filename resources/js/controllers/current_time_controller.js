import { Controller } from 'stimulus';

export default class extends Controller {
    /**
     *
     * @type {[string, string]}
     */
    static targets = ['minutes', 'hours', 'month', 'day', 'week'];

    /**
     *
     */
    connect() {
        const tick = () =>
            this.updateDay()
                .updateWeek()
                .updateHours()
                .updateMinutes()
                .updateMonth();

        tick();

        this.timer = setInterval(tick, 10000);
    }

    /**
     *
     * @returns {string}
     */
    getWeekDay(dayNumber) {
        return [
            'воскресенье',
            'понедельник',
            'вторник',
            'среда',
            'четверг',
            'пятница',
            'суббота',
        ][dayNumber];
    }

    /**
     *
     * @returns {string}
     */
    getMonth(monthNumber) {
        return [
            'января',
            'февраля',
            'марта',
            'апреля',
            'мая',
            'июня',
            'июля',
            'августа',
            'сентября',
            'октября',
            'ноября',
            'декабря',
        ][monthNumber];
    }

    /**
     *
     */
    updateDay() {
        this.dayTarget.textContent = new Date().getDate();

        return this;
    }

    /**
     *
     */
    updateHours() {
        let hours = new Date().getHours();
        this.hoursTarget.textContent = this.pad(hours);

        return this;
    }

    /**
     *
     */
    updateMinutes() {
        let minutes = new Date().getMinutes();
        this.minutesTarget.textContent = this.pad(minutes);

        return this;
    }

    /**
     *
     */
    updateMonth() {
        let month = new Date().getMonth();
        this.monthTarget.textContent = this.getMonth(month);

        return this;
    }

    /**
     *
     */
    updateWeek() {
        let week = new Date().getDay();
        this.weekTarget.textContent = this.getWeekDay(week);

        return this;
    }

    /**
     *
     * @param number
     * @returns {string|*}
     */
    pad(number) {
        return number.toString().padStart(2, 0);
    }

    /**
     * Clear time
     */
    disconnect() {
        clearInterval(this.timer);
    }
}
