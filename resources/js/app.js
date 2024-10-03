import './bootstrap';
import router from './vue/routes.js';
import App from './vue/App.vue';
import { createApp, h } from 'vue';

let vue = createApp({
    render: () => h(App),
    devtools: true,
  })
vue.config.devtools = true;
vue.use(router).mount('#app');
