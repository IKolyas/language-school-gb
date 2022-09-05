<template>
    <header class="main-header">
		<div class="container">
			<div class="main-header__inner">
				<div class="arena-message"
					 v-if="userArena.owner">
					{{ userArena.owner.name }} приглашает Вас в игру
					<router-link :to="{name: 'dictionaryWar', params: {id: userArena.owner.id, name: userArena.owner.name}}">Принять</router-link>
				</div>

				<div class="header__menu menu">
					<div @click.prevent="toggle">
						<button
						type="button"
						class="menu__icon"
						:class="{ 'active' : isOpen }"
						>
							<span></span>
						</button>
					</div>

					<nav class="menu__body" :class="{ 'active' : isOpen }">
						<ul class="menu__list">
							<li
							class="menu__item"
							v-for="(menu, index) in menus"
							:key="index"
							>
								<router-link :to="{name: menu.linkName}" class="menu__link" active-class="menu__link_active bottom-marked">
									{{ menu.text }}
								</router-link>
							</li>
						</ul>
					</nav>
				</div>
				<router-link v-if="!isAuth" tag="button" to="login" class="btn btn-outline-primary login-btn">Войти</router-link>
				<div class="user-menu" v-else @click="toggleAuthMenu">
					<span class="user-menu__name">
						{{ userName }}
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
            arena: {},
			menus: [
				{
					text: 'Главная',
					linkName: 'home'
				},
				{
					text: 'Практика',
					linkName: 'practiceTest'
				},
				{
					text: 'Мои достижения',
					linkName: 'achievements'
				},
				{
					text: 'Словари',
					linkName: 'dictionaries'
				},
				{
					text: 'Арена',
					linkName: 'dictionaryWar'
				}
			],
			isOpen: false,
			isMobile: true
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
        },
		userName() {
			const lastnameLetter = this.lastname.substr(0, 1).toUpperCase()
			return `${this.name} ${lastnameLetter}.`
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

		toggle() {
			this.isOpen = !this.isOpen
		}
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
		padding: 34px 0;
		align-items: center;
	}

	.main-logo {
		margin-bottom: 20px;
	}

	.login-btn {
		margin-left: auto;
		width: 120px;
	}

	.login-group__button {
		padding: 8px 30px;
		color: #3B6CE9;
		border: 1px solid #3B6CE9;
		border-radius: 5px;
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

	.bottom-marked {
		position: relative;
	}

	.bottom-marked::before {
		display: block;
		width: 5px;
		height: 5px;
		background-color: #3B6CE9;
		content: "";
		position: absolute;
		transform: rotate(45deg);
		bottom: -2px;
	}

	.bottom-marked::after {
		display: block;
		height: 1px;
		background-color: #3B6CE9;
		content: "";
		position: absolute;
		bottom: 0;
		width: 100%;
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

.header__menu {
	width: 100%;

	.menu__icon {
		background: none;
		//outline: none;
		display: none;
	}

	.menu__list > li:not(:last-child) {
		position: relative;
		margin-right: 5%;
	}
	.menu__link {
		font-weight: 300;
		font-size: 20px;
		line-height: 23px;
		letter-spacing: 0.21em;
		padding-bottom: 5px;
		color: black;
		border-bottom: 1px solid transparent;
		transition: all .3s;

		&.menu__link_active {
			cursor: default;
			user-select: none;
		}

		&:hover:not(.menu__link_active) {
			border-bottom-color: #3B6CE9;
			transition: all .3s;
		}
	}
	@media (min-width: 1200px) {
		.menu__list {
			display: flex;
			align-items: center;
			margin-bottom: 0;
		}
	}
	@media (max-width: 1199px) {
		.menu__icon {
			z-index: 43;
			display: block;
			position: relative;
			width: 30px;
			height: 18px;
			cursor: pointer;
		}
		.menu__icon span,
		.menu__icon::before,
		.menu__icon::after {
			left: 0;
			position: absolute;
			height: 10%;
			width: 100%;
			transition: all 0.3s ease 0s;
			background-color: black;
		}
		.menu__icon::before,
		.menu__icon::after {
			content: "";
		}
		.menu__icon::before {
			top: 0;
		}
		.menu__icon::after {
			bottom: 0;
		}
		.menu__icon span {
			top: 50%;
			transform: scale(1) translate(0px, -50%);
		}

		.menu__icon.active span {
			transform: scale(0) translate(0px, -50%);
		}
		.menu__icon.active::before {
			top: 50%;
			transform: rotate(-45deg) translate(0px, -50%);
		}
		.menu__icon.active::after {
			bottom: 50%;
			transform: rotate(45deg) translate(0px, 50%);
		}

		.menu__body {
			position: fixed;
			top: 0;
			left: -100%;
			width: 100%;
			height: 100%;
			background-color: #ffffff;
			padding: 140px 0 30px;
			transition: left 0.3s ease 0s;
			overflow: auto;
			z-index: 42;
		}
		.menu__body.active {
			left: 0;
		}

		.menu__list > li {
			flex-wrap: wrap;
			margin: 0px 0px 30px 0px;
		}
		.menu__list > li:last-child {
			margin-bottom: 0;
		}
		.menu__link {
			font-size: 24px;
		}
	}
}


</style>
