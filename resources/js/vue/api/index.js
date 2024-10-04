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
            if (errors && errors.errors) {
                if (errors.success) {
                    success = errors.success;
                }
                errors = errors.errors;
            }
            const componentInstance = error.config.vueComponentInstance;
            Object.keys(errors).forEach((key) => {
                if (componentInstance && componentInstance.value.form && key in componentInstance.value.form) {
                    if (Array.isArray(errors[key])) {
                        componentInstance.value.errors[key] = errors[key].join('. ');
                    } else if (typeof errors[key] === 'object') {
                        componentInstance.value.errors[key] = JSON.stringify(errors[key]);
                    } else {
                        componentInstance.value.errors[key] = errors[key];
                    }
                } else {
                    console.log('flashes ' + key);
                }
            });
            Object.keys(success).forEach((key) => {
                if (componentInstance && componentInstance.value.form && key in componentInstance.value.form) {
                    if (Array.isArray(success[key])) {
                        componentInstance.value.success[key] = success[key].join('. ');
                    } else if (typeof success[key] === 'object') {
                        componentInstance.value.success[key] = JSON.stringify(success[key]);
                    } else {
                        componentInstance.value.success[key] = success[key];
                    }
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