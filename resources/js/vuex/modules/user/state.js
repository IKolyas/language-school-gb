
export default {
    state: () => ({
        // isAuth: true,
        localStorage: {}, //Копия localstorage. Отслеживаем и меняем.
        name: '',
        lastname: '',
        email: '',
        token: '',
        tasks: {},
        photo: '',
        statistics: {},
        userWords: [],
        authenticated: false,
        user: {}
    })

}
