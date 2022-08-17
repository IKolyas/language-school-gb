import "bootstrap/dist/css/bootstrap.min.css";
import 'bootstrap';
import './bootstrap';

import { createApp } from 'vue'

import store from './vuex/store' // vuex store instance
import router from './router' // vue-router instance

import axios from 'axios'

import '../styles/style.scss'

import App from './components/App';
const app = createApp(App);
import AppLoader from './components/partials/AppLoader'

app.use(router);
app.use(store);
app.component('AppLoader', AppLoader)


app.config.globalProperties.$axios = axios;
axios.defaults.headers.common['Authorization'] = `Bearer ${store.getters['user/token']}`;
app.mount('#app'); // Vue Instance - Root component

if (window.Cypress) {
  window.store = store;
}
