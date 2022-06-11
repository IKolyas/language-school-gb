import { createStore, createLogger } from 'vuex'


const debug = process.env.NODE_ENV !== 'production'

export default new createStore({
  strict: debug,
  plugins: debug ? [createLogger()] : [],
  modules: {

  },
})
