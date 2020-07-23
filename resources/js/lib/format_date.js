/**
 *
 * @param {Date} date
 */
exports.formatLong = dateStr => {
    const date = new Date(dateStr);
    const DD = date
        .getDate()
        .toString()
        .padStart(2, 0);
    const MM = (date.getMonth() + 1)
        .toString()
        .toString()
        .padStart(2, 0);
    const YY = date.getFullYear();
    const HH = date
        .getHours()
        .toString()
        .padStart(2, 0);
    const mm = date
        .getMinutes()
        .toString()
        .padStart(2, 0);
    const SS = date
        .getSeconds()
        .toString()
        .padStart(2, 0);

    return `${YY}-${MM}-${DD} ${HH}:${mm}:${SS}`;
};

const getTimeSinceArrow = seconds =>
    seconds > 0 ? t => `${t} назад` : t => `через ${t}`;

const getTimeSinceInterval = seconds => {
    const cases = [2, 0, 1, 1, 1, 2];

    const periods = [
        [31536000, ['год', 'года', 'лет']],
        [2592000, ['месяц', 'месяца', 'месяцев']],
        [86400, ['день', 'дня', 'дней']],
        [3600, ['час', 'часа', 'часов']],
        [60, ['минуту', 'минуты', 'минут']],
    ];

    for (const [amount, periodCases] of periods) {
        const _interval = seconds / amount;
        const interval = Math.floor(_interval);

        if (_interval > 1) {
            return {
                interval,
                periodText:
                    periodCases[
                        interval % 100 > 4 && interval % 100 < 20
                            ? 2
                            : cases[interval % 10 < 5 ? interval % 10 : 5]
                    ],
            };
        }
    }
    return { interval: 0 };
};

exports.timeSince = dateStr => {
    const seconds = Math.floor(
        (new Date().getTime() - new Date(dateStr).getTime()) / 1000,
    );
    const { interval, periodText } = getTimeSinceInterval(seconds);

    if (interval === 0) {
        return 'только что';
    }

    const arrowFun = getTimeSinceArrow(seconds);

    return arrowFun(`${interval} ${periodText}`);
};
