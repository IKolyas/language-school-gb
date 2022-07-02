import { request } from './generic.service'

const getDictionaries = () => request({ url: `api/dictionary`, method: 'get' })

const getDictionaryOne = id => request({ url: `api/dictionary/${id}`, method: 'get' })

export { getDictionaries, getDictionaryOne }