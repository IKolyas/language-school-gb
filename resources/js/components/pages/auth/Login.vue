<template>
    <main class="container">
       <div class="enter-page">
		   <div class="alert alert-danger" role="alert" v-if="error !== null">
			   {{ error }}
		   </div>
		   <div class="enter-page__inner">
			   <div class="enter-page__img">
				   <img src="../../../../img/main-logo.png" alt="Language school project logotype" class="enter-page__logo">
			   </div>
			   <div class="enter-page__content">
				   <h1 class="enter-page__heading">Вход</h1>
				   <form class="enter-page__form enter-form" @submit.prevent="loginHandler">
					   <input type="email" class="primary-input enter-form__input" v-model="email" required
							  autofocus autocomplete="off" placeholder="Email">
					   <input type="password" class="primary-input enter-form__input enter-form__input_password" v-model="password"
							  required autocomplete="off" placeholder="Пароль">
					   <div class="enter-form__additions">
						   <div>
							   <input type="checkbox" class="enter-form__checkbox" checked id="rememberMe">
							   <label for="rememberMe" class="enter-form__text">Запомнить меня</label>
						   </div>
						   <a href="" class="enter-form__text enter-form__link">Забыли пароль?</a>
					   </div>

					   <AppButton
						   text="Войти"
						   width="150px"
						   height="40px"
						   class="btn btn-outline-primary"
						   :loading="loadingBtn"
						   typeBtn="submit"
					   />
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
					   <router-link :to="{name: 'register'}" class="enter-form__link">Зарегистрируйтесь!</router-link>
				   </p>
			   </div>
		   </div>
	   </div>
    </main>
</template>

<script>
import {mapActions} from "vuex";
import { login } from '../../../services/auth.service'
import AppButton from '../../partials/AppButton';

export default {
    name: "Login",
	components: {AppButton},
	data() {
        return {
            email: "",
            password: "",
            error: null,
			loadingBtn: false
        }
    },
    methods: {
        ...mapActions({signIn: 'user/login'}),
		loginHandler() {
			login({email: this.email, password: this.password})
			.then((response) => {
				if (!response.data.success) return alert(response.data.message);

				this.signIn(response.data.token, response.data.user)

				this.$store.dispatch('user/fetchUser', {id: response.data.user.id});
			})
			.catch((data) => {
				alert(data)
			})
        },
    },
}
</script>

<style lang="scss">
.enter-page {
	.enter-page__inner {
		text-align: center;
		padding-top: 97px;
		padding-bottom: 90px;

		@media (min-width: 1400px) {
			background-image: url("../../../../img/enter-page-background.png");
			background-repeat: no-repeat;
			background-position: top 100px left 50px;
			background-size: 45%;

			padding-left: 700px;
			padding-right: 100px;
		}
	}

	.enter-page__logo {
		margin-bottom: 20px;
		object-fit: contain;
		width: 100%;
		max-width: 350px;

		@media (min-width: 1200px) {
			max-width: 555px;
		}
	}

	.enter-page__heading {
		font-size: 36px;
		color: #2A79F8;
		margin-bottom: 20px;
	}

	.enter-page__form {
		display: flex;
		flex-direction: column;
		align-items: center;
		margin-bottom: 15px;
	}

	.enter-form__input {
		margin-bottom: 40px;
		padding-left: 50px;
		background-repeat: no-repeat;
		background-position: top 5px left 10px;
	}

	.enter-form__input_email {
		background-image: url("../../../../img/icons/user-icon.png");
	}

	.enter-form__input_password {
		background-image: url("../../../../img/icons/lock-icon.png");
	}

	.enter-form__additions {
		display: flex;
		justify-content: space-between;
		padding-left: 20px;
	}

	.enter-form__checkbox {
		width: 15px;
		height: 15px;
		margin-right: 15px;
	}

	.enter-form__text {
		font-family: 'Raleway', sans-serif;
		font-size: 13px;
		font-weight: 400;
	}

	.enter-form__button {
		height: 45px;
		width: 94px;
		border-radius: 10px;
		padding: 12px 30px;
		border: 1px solid #3B6CE9;
		background-color: #FFF;
	}

	.enter-form__button:hover {
		background-color: rgba(59, 108, 233, 0.12);
	}

	.enter-form__button:active {
		background-color: rgba(59, 108, 233, 0.24);
	}

	.enter-page__social-networks {
		margin: auto auto 40px;
	}

	.social-networks {
		display: flex;
		max-width: 350px;
		justify-content: space-between;
		padding: 0;
	}

	.social-networks__link {
		display: block;
		font-size: 0;
		width: 50px;
		height: 50px;
		background-image: url("../../../../img/icons/vk-round-icon.png");
	}

	.social-networks__link_ok {
		background-image: url("../../../../img/icons/ok-icon.png");
	}

	.social-networks__link_gmail {
		background-image: url("../../../../img/icons/gmail-icon.png");
	}

	.social-networks__link_yandex {
		background-image: url("../../../../img/icons/yandex-icon.png");
	}

	.social-networks__link_appstore {
		background-image: url("../../../../img/icons/appstore-icon.png");
	}
}
</style>
