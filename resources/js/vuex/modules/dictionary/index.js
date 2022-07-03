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
  async fetchDictionaries({commit}) {
    const data = await getDictionaries()
    console.log('data', data);
    commit('setDictionaries', data)
  }
}

const getters = {

}

const dictionaryModule = {
  namespaced: true,
  state,
  actions,
  getters,
  mutations,
};

export default dictionaryModule;