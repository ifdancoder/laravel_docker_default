import axios from 'axios';

const apiClient = axios.create({
    baseURL: 'http://localhost:80/api',
    headers: {
        'Content-Type': 'application/json',
    },
    withCredentials: true,
});

apiClient.interceptors.request.use(config => {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers['Authorization'] = `Bearer ${token}`;
    }
    return config;
});

apiClient.interceptors.response.use(
    response => response,
    error => {
        if (error.response && error.response.data) {
            let errors = error.response.data;
            let success = [];
            if (errors.message && errors.message.errors) {
                if (errors.message.success) {
                    success = errors.message.success;
                }
                errors = errors.message.errors;
            }
            const componentInstance = error.config.vueComponentInstance;
            Object.keys(errors).forEach((key) => {
                if (componentInstance && componentInstance.value.form && key in componentInstance.value.form) {
                    componentInstance.value.errors[key] = errors[key].join('. ');
                } else {
                    console.log('flashes ' + key);
                }
            });
            Object.keys(success).forEach((key) => {
                if (componentInstance && componentInstance.value.form && key in componentInstance.value.form) {
                    componentInstance.value.success[key] = success[key].join('. ');
                } else {
                    console.log('flashes ' + key);
                }
            });
        } else {
            console.log(error);
        }
        return Promise.reject(error);
    }
);

export default apiClient;