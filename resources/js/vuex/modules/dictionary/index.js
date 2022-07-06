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
    },
    addWord(state, payload) {
        state.dictionary.words.push({id: payload.id, word: payload.word, translation: payload.translation})
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
        try {
            const data = await getDictionaryOne(payload.id);
            console.log('dict', data)
            commit('setDictionary', data);
        } catch (e) {
            console.error('setDictionary', e);
        }
    },
    async addWord({commit}, payload) {
        try {
            // Посылается запрос на добавление слова, получается его id
            commit('addWord', payload);
        } catch(e) {
            console.error('addWord', e)
        }
    }
}

const getters = {}

const dictionaryModule = {
    namespaced: true,
    state,
    actions,
    getters,
    mutations,
};

export default dictionaryModule;
