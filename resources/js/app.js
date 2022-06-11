import './bootstrap';

import { createApp } from 'vue'

import HelloLanguageSchool from './components/HelloLanguageSchool.vue';

const app = createApp({});

app.component('hello-language-school', HelloLanguageSchool)

app.mount('#app')
