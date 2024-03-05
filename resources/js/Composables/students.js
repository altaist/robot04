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


export const useStudents = (ui) =>{


    const saveStudent = (formData) => {

        return requestApi(
            getSubmitActionRouter(formData),
            getSubmitMethod(formData),
            formData
        )
    }

    return {
        saveStudent
    }

}

