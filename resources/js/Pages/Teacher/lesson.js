import { date } from 'quasar'

const getLessonTitle = item => item.title || "Занятие " + (item.date_start ? date.formatDate(item.date_start, 'DD.MM') : '');

export const useLesson = () => {
    return {
        getLessonTitle
    }
}
