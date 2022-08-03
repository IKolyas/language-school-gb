import { createStore, createLogger } from 'vuex';
import userModule from './modules/user';
import taskModule from './modules/task';
import dictionaryModule from './modules/dictionary';
import statisticsModule from "./modules/statistics";

const debug = process.env.NODE_ENV !== 'production'

const store = createStore({
  strict: debug,
  plugins: debug ? [createLogger()] : [],

  modules: {
    user: userModule,
    task: taskModule,
    dictionaries: dictionaryModule,
    statistics: statisticsModule,
  },
})

export default store;
