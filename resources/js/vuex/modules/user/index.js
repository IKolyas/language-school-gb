// import state from './state';
import actions from './actions';
import getters from './getters';
import mutations from './mutations';

const state = () => ({
  isAuth: true,
  localStorage: {}, //Копия localstorage. Отслеживаем и меняем.
  name: '',
  lastname: '',
  email: '',
  token: '',
  tasks: {},
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