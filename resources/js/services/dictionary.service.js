import { request } from './generic.service'

const getDictionaries = () => request({ url: `api/dictionary`, method: 'get' })

const getDictionaryOne = id => request({ url: `api/dictionary/${id}`, method: 'get' })

const addDictionary = data => request({url: 'api/dictionary', method: 'post', data: data});

const addWord = data => request({url: 'api/word', method: 'post', data: data});


export { getDictionaries, getDictionaryOne, addDictionary, addWord}
