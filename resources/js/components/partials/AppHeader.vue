<template>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark" style="margin-right: 30px">
                    Language school project
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li>
                        <router-link to="/" class="nav-link px-2 link-dark">Главная</router-link>
                    </li>
                    <li>
                        <router-link :to="{name: 'practiceTest'}" class="nav-link px-2 link-dark">
                            Практика
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{name: 'dictionaries'}" class="nav-link px-2 link-dark">
                            Словари
                        </router-link>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <router-link to="/login" class="flex-shrink-0 text-dark" v-if="!isAuth" style="margin-right: 10px">
                        Войти
                    </router-link>
                    <router-link to="/register" class="flex-shrink-0 text-dark" v-if="!isAuth"
                                 style="margin-right: 10px">Регистрация
                    </router-link>
                    <!--	Заменить на v-else	-->
                    <div v-if="isAuth" class="flex-shrink-0 dropdown">
						<span class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
                              id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
								<span class="nav-item"
                                      style="margin-right: 10px; cursor: pointer">{{ `${name} ${lastname}` }}</span>
							<img src="https://github.com/mdo.png" alt="mdo" width="32" height="32"
                                 class="rounded-circle">
						</span>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                            <li class="dropdown-item"><strong>Статус</strong></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Новый проект</a></li>
                            <li>
                                <router-link class="dropdown-item" :to="{name: 'account'}">Профиль</router-link>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a @click.prevent='logout' class="dropdown-item" href="#">Выйти</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <header class="main-header">
        <ul class="main-nav">
            <li class="main-nav__item">
                <router-link tag="a" :to="{name: 'home'}" class="main-nav__link" active-class="main-nav__link_active">
                    Главная
                </router-link>
            </li>
            <li class="main-nav__item">
                <router-link tag="a" :to="{name: 'practiceTest'}" class="main-nav__link" active-class="main-nav__link_active">
                    Практика
                </router-link>
            </li>
            <li class="main-nav__item">
                <router-link tag="a" :to="{name: 'achievements'}" class="main-nav__link" active-class="main-nav__link_active">
                    Мои достижения
                </router-link>
            </li>
            <li class="main-nav__item">
                <router-link tag="a" :to="{name: 'dictionaries'}" class="main-nav__link" active-class="main-nav__link_active">
                    Словари
                </router-link>
            </li>
        </ul>
        <ul class="login-group" v-if="!isAuth">
            <li class="login-group__item">
                <button class="login-group__button">Войти</button>
            </li>
            <li class="login-group__item">
                <button class="login-group__button">Регистрация</button>
            </li>
        </ul>
        <div class="user-menu" v-else @click="toggleAuthMenu">
            <span class="user-menu__name">
                {{name}} {{lastname}}
            </span>
            <img class="user-menu__avatar" src="https://github.com/mdo.png" alt="mdo" width="32" height="32">
            <div class="user-menu__dropdown-toggle"></div>
            <ul class="user-menu__options-list" v-if="AuthMenuIsActive">
                <li class="user-menu__options-item">
                    Профиль
                </li>
                <li class="user-menu__options-item">
                    Выйти
                </li>
            </ul>
        </div>
    </header>
</template>

<script>
import {mapGetters, mapActions, mapMutations} from 'vuex'

export default {
    setup() {

    },
    data() {
        return {
            AuthMenuIsActive: false,
        }
    },
    computed: {
        ...mapGetters('user', {
            isAuth: 'isAuth',
            name: 'name',
            lastname: 'lastname',
            email: 'email',
        }),
    },
    methods: {
        ...mapMutations({}),
        ...mapActions({
            logout: 'user/logout',
            fetchUser: 'user/fetchUser'
        }),
        toggleAuthMenu() {
            console.log(1)
            this.AuthMenuIsActive = !this.AuthMenuIsActive;
        },
    },
}
</script>

<style lang="scss" scoped></style>
