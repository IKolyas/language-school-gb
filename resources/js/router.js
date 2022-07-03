import {createRouter, createWebHistory} from 'vue-router';

import Home from './components/pages/Home';
import Practice from "./components/pages/Practice";
import Login from "./components/pages/auth/Login";
import Register from "./components/pages/auth/Register";
import Account from "./components/pages/Account";
import DictionaryOne from "./components/pages/Dictionaries/DictionaryOne";
import Dictionaries from "./components/pages/Dictionaries/Dictionaries";
import AccountNew from "./components/pages/account/Index";
import Details from './components/pages/account/Details';
import DictionariesAccount from './components/pages/account/DictionariesAccount';

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
        component: Account,
    },
    {
        name: 'accountNew',
        path: '/accountNew',
        component: AccountNew,
        children: [
            {
                name: 'details',
                path: 'details',
                component: Details,
            },
            {
                name: 'dictionariesNew',
                path: 'dictionaries_new',
                component: DictionariesAccount,
            }
        ]
    },
    {name: 'account', path: '/account', component: Account},
    {name: 'dictionaries', path: '/dictionaries', component: Dictionaries},
    {name: 'dictionaryOne', path: '/dictionaryOne/:id', component: DictionaryOne, props: true},
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
