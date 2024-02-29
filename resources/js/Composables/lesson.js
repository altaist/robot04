import { date } from 'quasar'


export const useLesson = () => {
    const getLessonTitle = item => item.title || "Занятие " + (item.date_start ? date.formatDate(item.date_start, 'DD.MM') : '');

    return {
        getLessonTitle
    }
}
