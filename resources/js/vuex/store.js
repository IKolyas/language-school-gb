import {createStore, createLogger} from 'vuex';
import userModule from './modules/user';
import taskModule from './modules/task';
import dictionaryModule from './modules/dictionary';
import statisticsModule from "./modules/statistics";
import createPersistedState from 'vuex-persistedstate';

const debug = process.env.NODE_ENV !== 'production'

const store = createStore({
    strict: debug,
    plugins:
        debug ? [createLogger(), createPersistedState()] : [createPersistedState()]
    ,

    state: {
        mainLoader: false
    },

    getters: {
       mainLoader(state) {
           return state.mainLoader;
       }
    },

    mutations: {
        setLoader(state, value) {
            state.mainLoader = value;
        }
    },

    actions: {
        changeLoader({commit}, value) {
            commit('setLoader', value)
        }
    },

    modules: {
        user: userModule,
        task: taskModule,
        dictionaries: dictionaryModule,
        statistics: statisticsModule
    },
})

export default store;
