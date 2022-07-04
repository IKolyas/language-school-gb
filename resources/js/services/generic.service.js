import axios from 'axios'

const BASE_URL = process.env.VUE_APP_API_URL
// const BASE_URL = '/sanctum/csrf-cookie'
// const BASE_URL = 'https://dev-language-school-gb.herokuapp.com'

export const request = async ({ url, method, data = {} }) => {
	const response = await axios[method](`${BASE_URL}/${url}`, data)
	return response.data
}
