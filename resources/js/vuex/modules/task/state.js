
export default {
    state: () => ({
        isAuth: false,
        localStorage: {}, //Копия localstorage. Отслеживаем и меняем.
        name: '',
        lastname: '',
        email: '',
        token: '',
        tasks: {},
        photo: '',
        statistics: {}

    })
    
}