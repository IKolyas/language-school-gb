import { request } from './generic.service'

// const login = data => request({ url: `api/login`, method: 'post', data })
//
// const register = data => request({ url: `api/register`, method: 'get', data })
//
// const logout = data => request({ url: `api/logout`, method: 'post', data })

const getUser = id => request({ url: `api/user/${id}`, method: 'get' })

const updateUser = (id, data) => request({ url: `api/user/${id}`, method: 'put', data })
const updateUserTask = (id, data) => request({ url: `api/user/tasks/${id}`, method: 'put', data })

export {
	// login,
	// register,
	// logout,
	getUser,
	updateUser,
    updateUserTask
}
