// import state from './state';
import actions from './actions';
import getters from './getters';
import mutations from './mutations';

const state = () => ({
  isAuth: true,
  localStorage: {}, //Копия localstorage. Отслеживаем и меняем.
  id: '',
  name: '',
  lastname: '',
  email: '',
  groups: [],
  token: '',
  tasks: {},
  dictionaries: [],
  photo: '',
  statistics: {}
})

const userModule = {
  namespaced: true,
  state,
  actions,
  getters,
  mutations,
};

export default userModule;