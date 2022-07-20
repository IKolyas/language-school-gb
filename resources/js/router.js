import {createRouter, createWebHistory} from 'vue-router';

import Home from './components/pages/Home';
import Practice from "./components/pages/Practice";
import Login from "./components/pages/auth/Login";
import Register from "./components/pages/auth/Register";
import DictionaryOne from "./components/pages/Dictionaries/DictionaryOne";
import Dictionaries from "./components/pages/Dictionaries/Dictionaries";
import Account from "./components/pages/account/Index";
import AccountGroups from './components/pages/account/Groups';
import AccountAchievements from './components/pages/account/Achievements';
import DictionaryCreate from "./components/pages/Dictionaries/DictionaryCreate";
import MyDictionaryOne from "./components/pages/Dictionaries/MyDictionaryOne";

const routes = [
    {name: 'home', path: '/', component: Home},
    {
        name: 'practiceTest',
        path: '/practiceTest',
        component: Practice
    },
    {
        name: 'practice',
        path: '/practice/:dictionaryId',
        component: Practice,
        props: true
    },
    {name: 'login', path: '/login', component: Login},
    {name: 'register', path: '/register', component: Register},
    {
        name: 'account',
        path: '/account',
        redirect: { name: 'dictionariesNew' },
        component: Account,
        children: [
            {
                name: 'details',
                path: 'details',
                component: () => import('./components/pages/account/Details'),
            },
            {
                name: 'dictionariesNew',
                path: 'dictionaries_new',
                component: () => import('./components/pages/account/Dictionaries'),
            },
            {
                name: 'groups',
                path: 'groups',
                component: AccountGroups,
            },
            {
                name: 'achievements',
                path: 'achievements',
                component: AccountAchievements,
            }
        ]
    },
    {name: 'dictionaries', path: '/dictionaries', component: Dictionaries},
    {name: 'dictionaryOne', path: '/dictionaryOne/:id', component: DictionaryOne, props: true},
    {name: 'myDictionaryOne', path: '/myDictionaryOne/:id', component: MyDictionaryOne, props: true},
    {name: 'dictionaryCreate', path: '/dictionaryCreate', component: DictionaryCreate},
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
