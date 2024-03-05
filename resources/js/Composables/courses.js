import ref from 'vue';
import axios from 'axios';

const getSubmitActionRouter = (formData) => {
    return formData.id ? route('student.update', formData.id) : route('student.store');
}
const getSubmitMethod = (formData) => {
    return formData.id ? 'patch' : 'post';
}

const requestApi = (url, method, data) => {
    return axios({
        url,
        method,
        data
    })
}

const attachedStudents = ref([]);

export const useCourses = (ui) =>{
    
    return {
        attachedStudents
    }

}

