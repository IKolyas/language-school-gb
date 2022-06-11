import './bootstrap';

import { createApp } from 'vue'

import store from './vuex/store' // vuex store instance
import router from './router' // vue-router instance

import App from './components/App'


const app = createApp(App)
app.use(router)
app.use(store)

app.mount('#app') // Vue Instance - Root component

if (window.Cypress) {
  window.store = store
}

//
//import HelloLanguageSchool from './components/HelloLanguageSchool.vue';
//
//const app = createApp({});
//
//app.component('hello-language-school', HelloLanguageSchool)
//
//app.mount('#app')
