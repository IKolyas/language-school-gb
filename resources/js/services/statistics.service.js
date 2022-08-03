import {request} from "./generic.service";

const getStatistics = id => request({url: `api/statistics/${id}`, method: 'get'});

const saveStatistics = (id, data) => request({url: `api/statistics/${id}`, method: 'put', data: data});

const getAllUserWords = id => request({url: `api/word/all/${id}`, method: 'get'});

export {getStatistics, saveStatistics, getAllUserWords}
