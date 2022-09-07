import axios from 'axios'
import {request, requestAuth} from './generic.service';

const login = async data => {
	await axios.get('/sanctum/csrf-cookie')
	return await axios.post('api/user/login', data)
}
//
// const register = data => request({ url: `api/register`, method: 'get', data })
//
// const logout = data => request({ url: `api/logout`, method: 'post', data })

const getUser = id => axios.get(`api/user/${id}`)

const updateUser = (id, data) => request({ url: `api/user/${id}`, method: 'put', data })

const updateUserTask = (userId, taskId, data) => request({ url: `api/user/${userId}/task/${taskId}`, method: 'put', data })

export {
	login,
	// register,
	// logout,
	getUser,
	updateUser,
    updateUserTask
}
