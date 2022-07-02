import {getDictionaries} from '../../../services/dictionary.service';

const state = () => ({
  dictionary: {},
  dictionaries: []
})

const mutations = {
  setDictionaries(state, dictionaries) {
    state.dictionaries = dictionaries
  }
}

const actions = {
  fetchDictionaries({commit}) {
    const {data} = getDictionaries()
    console.log('data', data);
    commit('setDictionaries', data)
  }
}

const getters = {

}

const userModule = {
  namespaced: true,
  state,
  actions,
  getters,
  mutations,
};

export default userModule;