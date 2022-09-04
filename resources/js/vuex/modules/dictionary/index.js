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
    fetchDictionaries({commit}) {
        try {
            const data = getDictionaries()
            data.then((response) => {
                commit('setDictionaries', response);
            })
        } catch (e) {
            console.error('setDictionaries', e);
        }
    },
    fetchDictionary({commit}, payload) {
        try {
            getDictionaryWithRatings(payload.dictionary_id, payload.user_id).then((response) => {
                if(response) {
                    commit('setDictionaryWithRating', response);
                } else {
                    getDictionaryOne(payload.dictionary_id).then(response => {
                        commit('setDictionary', response);
                    });
                }
            });
        } catch (e) {
            console.error('setDictionary', e);
        }
    },
    fetchDictionaryWithRating({commit}, payload) {
        try {
            getDictionaryWithRatings(payload.dictionary_id, payload.user_id).then((response) => {
                if(response) {
                    commit('setDictionaryWithRating', response);
                } else {
                    getDictionaryOne(payload.dictionary_id).then(response => {
                        commit('setDictionary', response);
                    });
                }
            });
        } catch (e) {
            console.error('setDictionaryWithRating', e);
        }
    },

    updateDictionaryRating({commit, dispatch}, payload) {
        try {
            updateRatings(payload.user_id, {words: payload.words}).then();
        } catch (e) {
            console.error('updateDictionaryRating', e);
        }
        dispatch('fetchDictionaryWithRating', {
            dictionary_id: payload.dictionary_id,
            user_id: payload.user_id
        });
    },

    actionDestroyDictionary({commit, dispatch}, payload) {
        try {
            destroyDictionary(payload.id).then(() => {
                dispatch('fetchDictionaries');
            });
        } catch (e) {
            console.error('destroyDictionary', e);
        }

    },
    actionAddToMyDictionaries({commit, dispatch}, payload) {
        try {
            addUserDictionary({user_id: payload.user_id, dictionary_id: payload.dictionary_id}).then(() => {
                dispatch('fetchDictionaryWithRating', {dictionary_id: payload.dictionary_id, user_id: payload.user_id});
                dispatch('user/fetchUser', {id: payload.user_id}, {root: true});
            });
        } catch (e) {
            console.error('addToMyDictionaries', e);
        }
    },
    actionRemoveFromMyDictionaries({commit, dispatch}, payload) {
        try {
            deleteUserDictionary(payload.user_id, payload.dictionary_id).then(() => {
                dispatch('user/fetchUser', {id: payload.user_id}, {root: true});
            });
        } catch (e) {
            console.error('removeFromMyDictionaries', e);
        }
    },
    async actionRemoveWord({commit, dispatch}, payload) {
        try {
            removeWord(payload.dictionary_id, payload.word_id).then();
        } catch (e) {
            console.error('removeWord', e);
        }
        dispatch('fetchDictionaryWithRating', {dictionary_id: payload.dictionary_id, user_id: payload.user_id});
    },
    addWord({commit, dispatch}, payload) {
        try {
            addWord({
                word: payload.word,
                translation: payload.translation,
                dictionary_id: payload.dictionary_id,
                user_id: payload.user_id
            }).then();
        } catch (e) {
            console.error('addWord', e)
        }
        dispatch('fetchDictionaryWithRating', {dictionary_id: payload.dictionary_id, user_id: payload.user_id});
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

const getters = {
    dictionary: state => state.dictionary,
}

const dictionaryModule = {
    namespaced: true,
    state,
    actions,
    getters,
    mutations,
};

export default dictionaryModule;
