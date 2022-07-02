import {getDictionaries, getDictionaryOne} from '../../../services/dictionary.service';

const state = () => ({
    dictionary: {},
    dictionariesList: [],
})

const mutations = {
    setDictionaries(state, dictionaries) {
        state.dictionariesList = dictionaries.data
    },
    setDictionary(state, dictionary) {
        state.dictionary = dictionary.data;
    }
}

const actions = {
    async fetchDictionaries({commit}) {
        try {
            const data = await getDictionaries();
            commit('setDictionaries', data);
        } catch (e) {
            console.error('setDictionaries', e);
        }
    },
    async fetchDictionary({commit}, payload) {
        console.log(payload.id)
        try {
            const data = await getDictionaryOne(payload.id);
            console.log('data', data);
            commit('setDictionary', data);
        } catch (e) {
            console.error('setDictionary', e);
        }
    }
}

const getters = {}

const userModule = {
    namespaced: true,
    state,
    actions,
    getters,
    mutations,
};

export default userModule;
