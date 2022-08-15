<template>
    <main class="enter-page">
        <div class="alert alert-danger" role="alert" v-if="error !== null">
            {{ error }}
        </div>
        <img src="../../../../img/main-logo.png" alt="Language school project logotype" width="555"
             class="enter-page__logo">
        <h1 class="enter-page__heading">Вход</h1>
        <form class="enter-page__form enter-form">
            <input type="email" class="primary-input enter-form__input enter-form__input_email" v-model="email" required
                   autofocus autocomplete="off" placeholder="Имя">
            <input type="password" class="primary-input enter-form__input enter-form__input_password" v-model="password"
                   required autocomplete="off" placeholder="Пароль">
            <div class="enter-form__additions">
                <div>
                    <input type="checkbox" class="enter-form__checkbox" checked id="rememberMe">
                    <label for="rememberMe" class="enter-form__text">Запомнить меня</label>
                </div>
                <a href="" class="enter-form__text enter-form__link">Забыли пароль?</a>
            </div>
            <button type="submit" class="enter-form__button" @click="handleSubmit">
                Вход
            </button>
        </form>
        <p class="enter-page__text">с помощью аккаунта в социальных сетях</p>
        <ul class="enter-page__social-networks social-networks">
            <li class="social-networks__item">
                <a href="" class="social-networks__link social-networks__link_vk">VK</a>
            </li>
            <li class="social-networks__item">
                <a href="" class="social-networks__link social-networks__link_ok">OK</a>
            </li>
            <li class="social-networks__item">
                <a href="" class="social-networks__link social-networks__link_gmail">Gmail</a>
            </li>
            <li class="social-networks__item">
                <a href="" class="social-networks__link social-networks__link_yandex">Yandex</a>
            </li>
            <li class="social-networks__item">
                <a href="" class="social-networks__link social-networks__link_appstore">AppStore</a>
            </li>
        </ul>
        <p class="enter-page__text">
            Нет аккаунта?
            <a href="" class="enter-form__link">Зарегистрируйтесь!</a>
        </p>
    </main>
</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            email: "",
            password: "",
            error: null
        }
    },
    methods: {
        handleSubmit(e) {
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
        }
    },
    beforeRouteEnter(to, from, next) {
        if (window.Laravel.isAuth) {
            return next('practice');
        }
        next();
    }
}
</script>

<style scoped>

</style>
