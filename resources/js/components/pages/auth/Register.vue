<template>
    <main class="container">
       <div class="register-page">
		   <div class="alert alert-danger" role="alert" v-if="error !== null">
			   {{ error }}
		   </div>
		   <img src="../../../../img/register-logo.png" alt="Language school project logotype"
				class="register-page__logo">
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

					   <AppButton
						   text="Зарегистрироваться"
						   width="100%"
						   height="44px"
						   class="btn-outline-primary"
						   :loading="loadingBtn"
						   typeBtn="submit"
					   />
				   </form>
			   </div>
			   <div class="register-page__column register-page__column_right">
				   <ul class="register-page__authorization-options authorization-options">
					   <li class="authorization-options__item authorization-options__item_google">
						   <img src="../../../../img/icons/google-icon.png" alt="google">
						   <span>Продолжить с Google</span>
					   </li>
					   <li class="authorization-options__item authorization-options__item_apple">
						   <img src="../../../../img/icons/apple-icon.png" alt="apple">
						   <span>Продолжить с Apple</span>
					   </li>
					   <li class="authorization-options__item authorization-options__item_vk">
						   <img src="../../../../img/icons/vk-square-icon.png" alt="vk">
						   <span>Продолжить с Вконтакте</span>
					   </li>
				   </ul>
			   </div>
		   </div>
	   </div>
    </main>
</template>

<script>
import AppButton from '../../partials/AppButton';
export default {
    name: "Register",
	components: {AppButton},
	data() {
        return {
            name: "",
            lastname: "",
            email: "",
            password: "",
            passwordSubmit: "",
            error: null,

			loadingBtn: false
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

<style lang="scss">
.authorization-options {
	padding: 0;
	margin: 0;
	box-sizing: border-box;
	display: flex;
	flex-direction: column;
	align-items: flex-end;
	height: 100%;

	.authorization-options__item {
		width: 100%;
		height: 64px;
		line-height: 64px;
		border-radius: 40px;
		margin-bottom: 35px;
		text-align: center;
		font-size: 16px;
		font-weight: 600;
		position: relative;
		@media (min-width: 768px) {
			font-size: 20px;
		}

		& img {
			position: absolute;
			top: 0;
			left: 22px;
			transform: translateY(50%);
			margin-right: 5px;
		}
		&:last-child {
			margin-bottom: 0;
		}
	}

	.authorization-options__item_google {
		background-color: #F1F1F1;
	}

	.authorization-options__item_apple {
		background-color: #0A0A0A;
		color: #FFF;
	}

	.authorization-options__item_vk {
		background-color: #567FBD;
		color: #FFF;
	}
}

.register-page {
	padding-top: 30px;
	padding-bottom: 30px;

	@media (min-width: 1200px) {
		background-image: url("../../../../img/register-page-background.png");
		background-repeat: no-repeat;
		background-position: top 90px right;
		background-size: 90%;
	}

	.register-page__logo {
		margin-bottom: 14px;
	}

	.register-page__heading {
		font-size: 36px;
		text-align: center;
		margin-bottom: 60px;
		color: #2A79F8;
	}

	.register-page__column-wrapper {

		@media (min-width: 1200px) {
			display: flex;
			justify-content: space-between;
		}
	}

	.register-page__column {
		max-width: 570px;
		width: 100%;
		padding: 20px 0;

		&.register-page__column_right {
			margin-top: auto;
		}
	}

	.register-form__label {
		font-family: Open Sans, sans-serif;
		font-size: 24px;
		font-weight: 400;
		margin-bottom: 19px;
	}

	.register-form {
		input {
			margin-bottom: 20px;
		}
		input:last-child {
			margin-bottom: 37px;
		}
	}

}
</style>
