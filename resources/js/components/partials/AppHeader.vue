<template>
    <header class="main-header">
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

<style lang="scss" scoped>

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
