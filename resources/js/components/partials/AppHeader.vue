<template>
    <header class="main-header">
        <ul class="main-nav">
            <li class="main-nav__item">
                <router-link tag="a" :to="{name: 'home'}" class="main-nav__link" active-class="main-nav__link_active bottom-marked">
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
                {{ name }} {{ lastname }}
            </span>
            <img class="user-menu__avatar" src="https://github.com/mdo.png" alt="mdo" width="32" height="32">
            <div class="user-menu__dropdown-toggle dropdown-toggle-mark"></div>
            <ul class="user-menu__options-list" v-if="authMenuIsActive">
                <li class="user-menu__options-item bottom-marked">
                    <router-link :to="{name: 'account'}" class="user-menu__options-link">
                        Профиль
                    </router-link>
                </li>
                <li class="user-menu__options-item bottom-marked">
                    <!--                    TODO logout router-link-->
                    <router-link :to="{name: 'login'}" class="user-menu__options-link">
                        Войти
                    </router-link>
                </li>
                <li class="user-menu__options-item bottom-marked">
                    <router-link :to="{name: 'register'}" class="user-menu__options-link">
                        Регистрация
                    </router-link>
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
            authMenuIsActive: false,
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
            this.authMenuIsActive = !this.authMenuIsActive;
        },
    },
}
</script>

<style lang="scss" scoped></style>
