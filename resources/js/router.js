import {createRouter, createWebHistory} from 'vue-router';

import Home from './components/pages/Home';
import Practice from "./components/pages/Practice";
import Login from "./components/pages/auth/Login";
import Register from "./components/pages/auth/Register";
import Dictionary from "./components/pages/Dictionaries/Dictionary";
import Dictionaries from "./components/pages/Dictionaries/Dictionaries";
import Account from "./components/pages/account/Account";
import AccountGroups from './components/pages/account/Groups';
import AccountAchievements from './components/pages/account/Achievements';
import DictionaryCreate from "./components/pages/Dictionaries/DictionaryCreate";
import DictionaryProgress from "./components/pages/Dictionaries/DictionaryProgress";
import Arena from "./components/pages/dictionary_war/Arena";

import store from "./vuex/store";

const routes = [
    {
        name: 'home',
        path: '/',
        component: Home,
        meta: {
            middleware: "guest",
            title: `Home`
        }
    },
    {
        name: 'practiceTest',
        path: '/practiceTest',
        component: Practice,
        meta: {
            middleware: "guest",
            title: `PracticeTest`
        }
    },
    {
        name: 'dictionaryWar',
        path: '/dictionary-war',
        component: Arena,
        meta: {
            middleware: "auth",
            title: `DictionaryWar`
        }
    },
    {
        name: 'practice',
        path: '/practice/:dictionaryId',
        component: Practice,
        props: true,
        meta: {
            middleware: "auth",
            title: `Practice`
        }
    },
    {
        name: 'login',
        path: '/login',
        component: Login,
        meta: {
            middleware: "guest",
            title: `Login`
        }
    },

    {
        name: 'register',
        path: '/register',
        component: Register,
        meta: {
            middleware: "guest",
            title: `Register`
        }
    },

    {
        name: 'account',
        path: '/account',
        redirect: {name: 'accountDictionaries'},
        component: Account,
        meta: {
            middleware: "auth"
        },
        children: [
            {
                name: 'details',
                path: 'details',
                component: () => import('./components/pages/account/Details'),
            },
            {
                name: 'accountDictionaries',
                path: 'account_dictionaries',
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
    {
        name: 'dictionaries',
        path: '/dictionaries',
        component: Dictionaries,
        meta: {
            middleware: "auth"
        }
    },
    {
        name: 'dictionary',
        path: '/dictionary/:id',
        component: Dictionary,
        props: true,
        meta: {
            middleware: "auth"
        }
    },
    {
        name: 'dictionaryProgress',
        path: '/dictionaryProgress/:id',
        component: DictionaryProgress,
        props: true,
        meta: {
            middleware: "auth"
        }
    },
    {
        name: 'dictionaryCreate',
        path: '/dictionaryCreate',
        component: DictionaryCreate,
        meta: {
            middleware: "auth"
        }
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

router.beforeEach((to, from, next) => {
    store.dispatch('changeLoader', true);
    window.axios.get('/sanctum/csrf-cookie').then(() => {
        store.dispatch('user/isAuth').then(() => {
            store.dispatch('changeLoader', false);
            if (to.meta.middleware === "guest" || store.state.user.authenticated) {
                next()
            } else {
                next({name: "login"})
            }
        })
    })
})

export default router;
