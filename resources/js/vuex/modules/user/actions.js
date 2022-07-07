import {getUser} from '../../../services/auth.service';

export default {
    login(e) {
        e.preventDefault()
        if (this.password.length > 0) {
            this.$axios.get('/sanctum/csrf-cookie').then(() => {
                this.$axios.post('api/login', {
                    email: this.email,
                    password: this.password
                })
                    .then(response => {
                        console.log(response.data)
                        if (response.data.success) {
                            this.$router.go('/')
                        } else {
                            this.error = response.data.message
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },

    register(e) {
        e.preventDefault()
        if (this.password.length > 0) {
            this.$axios.get('/sanctum/csrf-cookie').then(() => {
                this.$axios.post('api/register', {
                    name: this.name,
                    lastname: this.lastname,
                    email: this.email,
                    password: this.password
                })
                    .then(response => {
                        if (response.data.success) {
                            window.location.href = "/login"
                        } else {
                            this.error = response.data.message
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },

    logout(e) {
        e.preventDefault()
        this.$axios.get('/sanctum/csrf-cookie').then(() => {
            this.$axios.post('/api/logout')
                .then(response => {
                    if (response.data.success) {
                        window.location.href = "/"
                    } else {
                        console.log(response)
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },

    async fetchUser({commit}, payload) {
        try {
            const { data } = await getUser(payload.id)
            commit('setCurrentUser', data)
        } catch (e) {
            console.error('fetchUser', e);
        }
    }
}
