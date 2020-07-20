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
