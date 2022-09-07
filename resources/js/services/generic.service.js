import axios from 'axios'

// const BASE_URL = process.env.VUE_APP_API_URL
const BASE_URL = 'https://dev-language-school-gb.herokuapp.com'
// const BASE_URL = 'http://localhost'

// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// window.axios.interceptors.response.use(
// 	response => response.data,
// 	error => {
// 		if(error.response && error.response.status === 419) {
// 			window.location.reload()
// 		}
// 	}
// )

export const request = async ({ url, method, data = {} }) => {
	const response = await axios[method](`${BASE_URL}/${url}`, data)
	return response.data
}

export const requestAuth = ({ url, method, data = {} }) => {
	return axios.get('/sanctum/csrf-cookie').then((res) => {
		axios[method](`${BASE_URL}/${url}`, data)
	})
}
