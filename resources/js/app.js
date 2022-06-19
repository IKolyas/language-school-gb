import "bootstrap/dist/css/bootstrap.min.css";
import 'bootstrap';

import { createApp } from 'vue'

import store from './vuex/store' // vuex store instance
import router from './router' // vue-router instance

import axios from 'axios'

import '../styles/style.scss'

import App from './components/App';
const app = createApp(App);

app.use(router);
app.use(store);

app.config.globalProperties.$axios = axios;

app.mount('#app'); // Vue Instance - Root component

if (window.Cypress) {
  window.store = store;
}
