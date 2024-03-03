import axios from 'axios';

const getSubmitActionRouter = (formData) => {
    return formData.id ? route('course.update', formData.id) : route('course.store');
}

export const useStudents = (useUi) =>{

    const { showLoading, hideLoading } = useUi();

    const saveStudent = (formData) => {
        
        return axios.post(
            getSubmitActionRouter(formData),
            formData
        ).then((response) => {
            console.log(response);
        }).catch(() => {
            hideLoading();
        });
    }

    const sendRequuest = (endpoint, formData) => {
        return axios.post(
            endpoint,
            formData
        ).then((response) => {
            console.log(response);
        }).catch(() => {
            hideLoading()
        });
    }

    return {
        saveStudent
    }

}

