import './bootstrap';

import 'vue3-toastify/dist/index.css';

import { createApp } from 'vue';

import App from './app.vue';

import router from "./router/index.js";

createApp(App).use(router).mount("#app");
