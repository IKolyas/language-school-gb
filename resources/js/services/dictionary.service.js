import { request } from './generic.service'

const getDictionaries = () => request({ url: `api/dictionary`, method: 'get' })

const getDictionaryOne = id => request({ url: `api/dictionary/${id}`, method: 'get' });

const getDictionaryWithRatings = (dictionary_id, user_id) => request({ url: `api/dictionary/${dictionary_id}/user/${user_id}`, method: 'get' });

const addDictionary = data => request({url: 'api/dictionary', method: 'post', data: data});

const destroyDictionary = id => request({url: `api/dictionary/${id}`, method: 'delete'});

const addWord = data => request({url: 'api/word', method: 'post', data: data});

const removeWord = (dictionary_id, word_id) => request({url: `api/dictionary/${dictionary_id}/word/${word_id}`, method: 'delete'});

const addUserDictionary = (data) => request({url: `api/user/addUserDictionary`, method: 'post', data: data});

const deleteUserDictionary = (dictionary_id, user_id) => request({ url: `api/user/${user_id}/dictionary/${dictionary_id}`, method: 'delete' });


export { getDictionaries, getDictionaryOne, addDictionary, addWord, removeWord, destroyDictionary, getDictionaryWithRatings, addUserDictionary, deleteUserDictionary}
