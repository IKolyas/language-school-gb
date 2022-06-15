import {createWebHashHistory, createRouter} from 'vue-router';

import Home from './components/Home';
import Login from "./components/auth/Login";
import Register from "./components/auth/Register";
import Practice from "./components/Practice";

const routes = [
    {name: 'home', path: '/', component: Home},
    {name: 'login', path: '/login', component: Login},
    {name: 'register', path: '/register', component: Register},
    {name: 'practice', path: '/practice', component: Practice},
];

const router = createRouter({
    history: createWebHashHistory(),
    routes: routes,
});

export default router;
