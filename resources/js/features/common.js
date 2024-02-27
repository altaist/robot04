
import { date } from 'quasar'

export const getLessonTitle = item => item.title || "Занятие " + (item.date_start ? date.formatDate(item.date_start, 'DD.MM') : '');

export const f_date = (datetime) => {
    return date.formatDate(datetime, 'DD.MM.YYYY HH:mm')
}

export const f_schedule = (schedule) => {
    const days = 'Пн Вт Ср Чт Пт Сб Вс'.split(' ');
    let scheduleStr = "";
    const daysArr = schedule['days'];
    for (let i = 0; i < daysArr.length; i++) {
        const element = daysArr[i];
        if(!element || element.length==0){
            continue;
        }

        scheduleStr += (days[i] + ":" + element.join('-') + ";  ");
    }

    return scheduleStr;
}


