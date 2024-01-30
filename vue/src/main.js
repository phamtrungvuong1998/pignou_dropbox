import { createApp } from 'vue';
import App from './App.vue';
import './bootstrap/css/bootstrap.min.css';
import './css/my-login.css';
import store from "./store.js";
import router from "./router.js";

createApp(App).use(store).use(router).mount('#app')
