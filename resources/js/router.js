import {createWebHashHistory, createRouter} from 'vue-router';
import store from './vuex/store';
import {sync} from 'vuex-router-sync';

import HelloLanguageSchool from './components/HelloLanguageSchool';

const routes = [
    {path: '/', component: HelloLanguageSchool},
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

sync(store, router);

export default router;
