import {createRouter, createWebHistory} from 'vue-router';

import Home from './components/pages/Home';
import Practice from "./components/pages/Practice";
import Login from "./components/pages/auth/Login";
import Register from "./components/pages/auth/Register";

const routes = [
    {name: 'home', path: '/', component: Home},
    {name: 'practice', path: '/practice', component: Practice},
    {name: 'login', path: '/login', component: Login},
    {name: 'register', path: '/register', component: Register},
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
