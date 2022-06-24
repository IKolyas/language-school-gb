import { createStore, createLogger } from 'vuex';
import userModule from './modules/user';
import taskModule from './modules/task';


const debug = process.env.NODE_ENV !== 'production'

export default new createStore({
  strict: debug,
  plugins: debug ? [createLogger()] : [],

  state: {
    // isAuth: false,
    // user: false
  },

  mutations: {
    changeAuth (state) {
      state.isAuth = laravel.isAuth
    }
  },

  actions: {

  },

  getters: {

  },

  modules: {
    user: userModule,
    task: taskModule
  },
})
