import state from './state';
import actions from './actions';
import getters from './getters';
import mutations from './mutations';



const userModule = {
  namespaced: true,
  state,
  actions,
  getters,
  mutations,
};

export default userModule;