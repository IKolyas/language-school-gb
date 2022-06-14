<template>
    <div class="container">
        <div class="text-center" style="margin: 20px 0 20px 0;">
            <span class="text-secondary">Language school project</span>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav" v-if="isAuth">
                    <router-link to="/practice" class="nav-item nav-link">Практика</router-link>
                    <router-link to="/" class="nav-item nav-link">Главная</router-link>
                    <span class="nav-item nav-link">{{ user.name }}</span>
                    <a class="nav-item nav-link" style="cursor: pointer;" @click="logout">Выход</a>
                </div>
                <div class="navbar-nav" v-else>
                    <router-link to="/" class="nav-item nav-link">Главная</router-link>
                    <router-link to="/login" class="nav-item nav-link">Войти</router-link>
                    <router-link to="/register" class="nav-item nav-link">Регистрация</router-link>
                </div>
            </div>
        </nav>
        <br/>
        <router-view/>
    </div>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            isAuth: false,
            user: false
        }
    },
    created() {
        if (window.Laravel.isAuth) {
            this.isAuth = true
            this.user = window.Laravel.user
        }
    },
    methods: {
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
        }
    },
}
</script>
