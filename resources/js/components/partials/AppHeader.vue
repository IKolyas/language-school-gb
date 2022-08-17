<template>
    <header class="main-header">
        <ul class="main-nav">
            <li class="main-nav__item">
                <router-link tag="a" :to="{name: 'home'}" class="main-nav__link" active-class="main-nav__link_active">
                    Главная
                </router-link>
            </li>
            <li class="main-nav__item">
                <router-link tag="a" :to="{name: 'practiceTest'}" class="main-nav__link"
                             active-class="main-nav__link_active">
                    Практика
                </router-link>
            </li>
            <li class="main-nav__item">
                <router-link tag="a" :to="{name: 'achievements'}" class="main-nav__link"
                             active-class="main-nav__link_active">
                    Мои достижения
                </router-link>
            </li>
            <li class="main-nav__item">
                <router-link tag="a" :to="{name: 'dictionaries'}" class="main-nav__link"
                             active-class="main-nav__link_active">
                    Словари
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
            <div class="user-menu__dropdown-toggle"></div>
            <ul class="user-menu__options-list" v-if="AuthMenuIsActive">
                <li class="user-menu__options-item">
                    <router-link :to="{name: 'account'}" class="user-menu__options-link">
                        Профиль
                    </router-link>
                </li>
                <li class="user-menu__options-item">
                    <!--                    TODO logout router-link-->
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
            isAuth: 'authenticated',
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
        userLogout() {
            this.$axios.post('/api/user/logout').then((response) => {
                if (!response.data.success) return alert(response.data.message);
            }).catch(data => {
                return alert(data.message);
            }).finally(() => this.logout())
        },
        toggleAuthMenu() {
            this.AuthMenuIsActive = !this.AuthMenuIsActive;
        },
    },
}
</script>

<style lang="scss" scoped>
.user-menu__options-link:hover {
    cursor: pointer;
    color: blue;
}
</style>
