<template>
    <main class="register-page">
        <div class="alert alert-danger" role="alert" v-if="error !== null">
            {{ error }}
        </div>
        <img src="../../../../img/register-logo.png" alt="Language school project logotype"
             class="register-page__logo" width="401" height="69">
        <h1 class="register-page__heading">Добро пожаловать!</h1>
        <div class="register-page__column-wrapper">
            <div class="register-page__column">
                <form class="register-page__form register-form">
                    <label for="name" class="register-form__label">Имя пользователя</label>
                    <input id="name" type="text" class="primary-input register-form__input" v-model="name" required
                           autofocus autocomplete="off" placeholder="введите имя">
                    <label for="lastname" class="register-form__label">Фамилия</label>
                    <input id="lastname" type="text" class="primary-input register-form__input" v-model="lastname" required
                           autofocus autocomplete="off" placeholder="введите фамилию">
                    <label for="email" class="register-form__label">E-Mail</label>
                    <input id="email" type="email" class="primary-input register-form__input" v-model="email" required
                           autofocus autocomplete="off" placeholder="введите email">
                    <label for="password" class="register-form__label">Пароль</label>
                    <input id="password" type="password" class="primary-input register-form__input" v-model="password"
                           required autocomplete="off" placeholder="введите пароль">
                    <label for="password-submit" class="register-form__label">Подтверждение пароля</label>
                    <input id="password-submit" type="password" class="primary-input register-form__input register-form__input_last-input" v-model="passwordSubmit"
                           required autocomplete="off" placeholder="повторите пароль">
                    <button type="submit" class="register-form__submit-button" @click="handleSubmit">
                        Зарегистрироваться
                    </button>
                </form>
            </div>
            <div class="register-page__column register-page__column_right">
                <ul class="register-page__authorization-options authorization-options">
                    <li class="authorization-options__item authorization-options__item_google">Продолжить с Google</li>
                    <li class="authorization-options__item authorization-options__item_apple">Продолжить с Apple</li>
                    <li class="authorization-options__item authorization-options__item_vk">Продолжить с Вконтакте</li>
                </ul>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    name: "Register",
    data() {
        return {
            name: "",
            lastname: "",
            email: "",
            password: "",
            passwordSubmit: "",
            error: null
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault()
            if (this.password.length > 0) {
                this.$axios.get('/sanctum/csrf-cookie').then(() => {
                    this.$axios.post('api/user/register', {
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
        }
    },
}
</script>

<style scoped>

</style>
