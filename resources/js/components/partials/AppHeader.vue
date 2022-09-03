<template>
    <header class="main-header">
		<div class="container">
			<div class="main-header__inner">
				<div class="arena-message"
					 v-if="userArena.owner">
					{{ userArena.owner.name }} приглашает Вас в игру
					<router-link :to="{name: 'dictionaryWar', params: {id: userArena.owner.id, name: userArena.owner.name}}">Принять</router-link>
				</div>
				<ul class="main-nav">
					<li class="main-nav__item">
						<router-link tag="a" :to="{name: 'home'}" class="main-nav__link"
									 active-class="main-nav__link_active bottom-marked">
							Главная
						</router-link>
					</li>
					<li class="main-nav__item">
						<router-link tag="a" :to="{name: 'practiceTest'}" class="main-nav__link"
									 active-class="main-nav__link_active bottom-marked">
							Практика
						</router-link>
					</li>
					<li class="main-nav__item">
						<router-link tag="a" :to="{name: 'achievements'}" class="main-nav__link"
									 active-class="main-nav__link_active bottom-marked">
							Мои достижения
						</router-link>
					</li>
					<li class="main-nav__item">
						<router-link tag="a" :to="{name: 'dictionaries'}" class="main-nav__link"
									 active-class="main-nav__link_active bottom-marked">
							Словари
						</router-link>
					</li>
					<li class="main-nav__item">
						<router-link tag="a" :to="{name: 'dictionaryWar'}" class="main-nav__link"
									 active-class="main-nav__link_active bottom-marked">
							Арена
						</router-link>
					</li>
				</ul>
				<ul class="login-group" v-if="!isAuth">
					<li class="login-group__item">
						<router-link tag="button" to="login" class="login-group__button">Войти</router-link>
					</li>
					<li class="login-group__item">
						<router-link tag="button" to="register" class="login-group__button">Регистрация</router-link>
					</li>
				</ul>
				<div class="user-menu" v-else @click="toggleAuthMenu">
					<span class="user-menu__name">
						{{ name }} {{ lastname }}
					</span>
					<img class="user-menu__avatar" src="https://github.com/mdo.png" alt="mdo" width="32" height="32">
					<div class="user-menu__dropdown-toggle dropdown-toggle-mark"></div>
					<ul class="user-menu__options-list" v-if="authMenuIsActive">
						<li class="user-menu__options-item bottom-marked">
							<router-link :to="{name: 'settings'}" class="user-menu__options-link">
								Профиль
							</router-link>
						</li>
						<li class="user-menu__options-item bottom-marked">
							<span class="user-menu__options-link" @click="userLogout">
								Выйти
							</span>
						</li>
						<li class="user-menu__options-item">
							<router-link :to="{name: 'account'}" class="user-menu__options-link">
								Техподдержка
							</router-link>
						</li>
					</ul>
				</div>
			</div>
		</div>
    </header>
</template>

<script>
import {mapGetters, mapActions, mapMutations} from 'vuex'

export default {
    data() {
        return {
            authMenuIsActive: false,
            arena: {}
        }
    },
    computed: {
        ...mapGetters('user', {
            isAuth: 'authenticated',
            name: 'name',
            lastname: 'lastname',
            email: 'email',
        }),
        userArena: function () {
            return this.arena;
        }
    },
    methods: {
        ...mapMutations({}),
        ...mapActions({
            logout: 'user/logout',
            fetchUser: 'user/fetchUser'
        }),
        userLogout() {
            this.$axios.post('/api/user/logout').then((response) => {
                if (!response.data.success) return alert(response.data.message);
            }).catch(data => {
                return alert(data.message);
            }).finally(() => this.logout())
        },
        toggleAuthMenu() {
            this.authMenuIsActive = !this.authMenuIsActive;
        },
    },

    created() {
        if (this.$store.getters['user/authenticated']) {
            console.log('arena.' + this.$store.getters['user/id']);
            window.Echo.channel('arena.' + this.$store.getters['user/id']).listen('Arena', (e) => {
                this.arena = e.arena
                console.log(e)
            })
        }
    }
}
</script>

<style lang="scss">

.main-header {
	background: rgba(202, 230, 246, 0.27) 0;

	.main-header__inner {
		display: flex;
		justify-content: space-between;
		padding: 34px 50px;
		align-items: center;
	}

	.main-logo {
		margin-bottom: 20px;
	}

	.main-nav__link_active {
		color: black;
	}

	.login-group {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 20px 15px;
		margin: 0;
	}

	.login-group__item {
		padding: 5px;
	}

	.login-group__button {
		padding: 12px 30px;
		color: #3B6CE9;
		border: 1px solid #3B6CE9;
		border-radius: 10px;
	}

	.user-menu {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 15px;
		border-radius: 10px;
		position: relative;
	}

	.user-menu__name {
		padding: 0 10px;
	}

	.user-menu__avatar {
		border-radius: 50%;
		border: 2px solid #3B6CE9;
	}

	.dropdown-toggle-mark {
		width: 0;
		height: 0;
		content: '';
		border: 5px solid transparent;
		border-top: 5px solid #000;
		margin-top: 5px;
	}

	.user-menu__dropdown-toggle {
		border-top: 5px solid #3B6CE9;
	}

	.user-menu__options-list {
		position: absolute;
		top: 80px;
		border: 1px solid #3B6CE9;
		border-radius: 5px;
		width: 200px;
		box-shadow: 0 4px 4px 0 rgba(59, 108, 233, 0.3);
		background-color: #FFF;
		z-index: 3;
		padding: 20px;
		margin: 0;
		text-align: center;
	}

	.user-menu__options-link {
		display: block;
		padding: 10px 0;
		color: #000;
		font-family: Raleway, sans-serif;
		font-size: 15px;
		font-weight: 500;
		line-height: 18px;
		letter-spacing: 0.21em;
	}

	.user-menu__options-link:hover {
		cursor: pointer;
		color: blue;
		font-size: 18px;
	}

	.main-nav {
		display: flex;
		justify-content: space-between;
		width: 934px;
		font-family: 'Raleway', sans-serif;
		font-weight: 300;
		font-size: 20px;
		padding: 0 50px;
		align-items: center;
		margin: 0;
	}

	.main-nav__link {
		color: black;
	}
}

.user-menu__options-link:hover {
    cursor: pointer;
    color: blue;
}
.arena-message {
    width: 200px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #e5e5e5;
    border: 1px solid #1a2226;
    font-weight: 400;
    position: fixed;
    top: 98px;
    right: 19%;
    border-radius: 10px;
}

</style>
