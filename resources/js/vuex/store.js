import { createStore, createLogger } from 'vuex';
import userModule from './modules/user';
import taskModule from './modules/task';

// const laravel = window.Laravel

const debug = process.env.NODE_ENV !== 'production'

const store = createStore({
  strict: debug,
  plugins: debug ? [createLogger()] : [],

  // state: {
  //   // isAuth: false,
  //   // commonState: true
  // },

  // mutations: {
  //   CHANGE_AUTH (state) {
  //     state.isAuth = laravel.isAuth
  //   }
  // },

  // actions: {

  // },

  // getters: {

  // },

  modules: {
    user: userModule,
    task: taskModule
  },
})

export default store;
