import {getDictionaries, getDictionaryOne, getDictionaryWithRatings} from '../../../services/dictionary.service';

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
    setDictionaryWithRating(state, dictionary) {
        state.dictionary = dictionary.data;
    },
    // addWord(state, payload) {
    //     state.dictionary.words.push({id: payload.id, word: payload.word, translation: payload.translation})
    // }
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
            commit('setDictionary', data);
        } catch (e) {
            console.error('setDictionary', e);
        }
    },
    async fetchDictionaryWithRating({commit}, payload) {
        try {
            const data = await getDictionaryWithRatings(payload.dictionary_id, payload.user_id);
            commit('setDictionaryWithRating', data);
        } catch (e) {
            console.error('setDictionary', e);
        }
    },
    // async addWord({commit}, payload) {
    //     try {
    //         commit('addWord', payload);
    //     } catch(e) {
    //         console.error('addWord', e)
    //     }
    // }
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
