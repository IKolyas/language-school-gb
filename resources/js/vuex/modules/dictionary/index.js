import {
    addDictionary,
    addUserDictionary, addWord, deleteUserDictionary,
    destroyDictionary,
    getDictionaries,
    getDictionaryOne,
    getDictionaryWithRatings, removeWord, updateRatings,
} from '../../../services/dictionary.service';

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
            console.error('setDictionaryWithRating', e);
        }
    },

    async updateDictionaryRating({commit, dispatch}, payload) {
        try {
            await updateRatings(payload.user_id, {words: payload.words});
        } catch (e) {
            console.error('updateDictionaryRating', e);
        }
        dispatch('fetchDictionaryWithRating', {
            dictionary_id: payload.dictionary_id,
            user_id: payload.user_id
        });
    },

    async actionDestroyDictionary({commit, dispatch}, payload) {
        try {
            await destroyDictionary(payload.id);
        } catch (e) {
            console.error('destroyDictionary', e);
        }
        dispatch('fetchDictionaries');
    },
    async actionAddToMyDictionaries({commit, dispatch}, payload) {
        try {
            await addUserDictionary({user_id: payload.user_id, dictionary_id: payload.dictionary_id});
        } catch (e) {
            console.error('addToMyDictionaries', e);
        }
        dispatch('user/fetchUser', {id: payload.user_id}, {root: true});
    },
    async actionRemoveFromMyDictionaries({commit, dispatch}, payload) {
        try {
            await deleteUserDictionary(payload.user_id, payload.dictionary_id);
        } catch (e) {
            console.error('removeFromMyDictionaries', e);
        }
        dispatch('user/fetchUser', {id: payload.user_id}, {root: true});
    },
    async actionRemoveWord({commit, dispatch}, payload) {
        try {
            await removeWord(payload.dictionary_id, payload.word_id);
        } catch (e) {
            console.error('removeWord', e);
        }
        dispatch('fetchDictionaryWithRating', {dictionary_id: payload.dictionary_id, user_id: payload.user_id});
    },
    async addWord({commit, dispatch}, payload) {
        try {
            await addWord({
                word: payload.word,
                translation: payload.translation,
                dictionary_id: payload.dictionary_id,
                user_id: payload.user_id
            });
        } catch (e) {
            console.error('addWord', e)
        }
        dispatch("fetchDictionary", {id: payload.dictionary_id});
    },
    async addDictionary({commit, dispatch}, payload) {
        let data = {};
        try {
            data = await addDictionary({dictionary_name: payload.dictionary_name, creator_id: payload.creator_id})
        } catch (e) {
            console.error('addDictionary', e)
        }
        dispatch("fetchDictionaries");
        return Promise.resolve(data);
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
