<template>
    <main class="account-page">
        <h1 class="visually-hidden">Личный кабинет пользователя</h1>
        <nav class="account-page__sidebar account-navbar">
            <img src="http://placekitten.com/100/100" class="account-navbar__avatar" alt="avatar" width="120"
                 height="120">
            <p class="account-navbar__username bottom-marked">{{ user.name }} {{ user.lastname }}</p>
            <ul class="account-navbar__navigation account-navigation">
                <li class="account-navigation__item">
                    <router-link :to="{name: 'settings'}" class="account-navigation__item-link"
                                 active-class="account-navigation__item-link_active">Настройки
                    </router-link>
                </li>
                <li class="account-navigation__item">
                    <router-link :to="{name: 'accountDictionaries'}" class="account-navigation__item-link"
                                 active-class="account-navigation__item-link_active">Словари
                    </router-link>
                </li>
                <li class="account-navigation__item">
                    <router-link :to="{name: 'groups'}" class="account-navigation__item-link"
                                 active-class="account-navigation__item-link_active">Группы
                    </router-link>
                </li>
                <li class="account-navigation__item">
                    <router-link :to="{name: 'achievements'}" class="account-navigation__item-link"
                                 active-class="account-navigation__item-link_active">Достижения
                    </router-link>
                </li>
            </ul>
            <div class="navbar__dropdown dropdown-account" @click="toggleDropdown">
                <span>Помощь</span>
                <div class="dropdown-account__dropdown-toggle-mark dropdown-toggle-mark"></div>
                <ul class="dropdown-account__list" v-if="dropdownIsActive">
                    <li class="dropdown-account__item">
                        <a class="dropdown-account__link" href="#">Написать в техподдержку</a>
                    </li>
                    <li class="dropdown-account__item">
                        <a class="dropdown-account__link" href="#">Задать вопрос психологу</a>
                    </li>
                    <li class="dropdown-account__item">
                        <a class="dropdown-account__link" href="#">Мне не нужна помощь</a>
                    </li>
                    <li class="dropdown-account__item">
                        <a class="dropdown-account__link" href="#">Я просто хочу уйти</a>
                    </li>
                </ul>
            </div>
        </nav>
        <router-view class="account-page__content"/>
    </main>
</template>

<script>
import {mapGetters, mapState} from "vuex";

export default {
    name: "Account",
    components: {},
    data() {
        return {
            dropdownIsActive: false,
        }
    },
    computed: {
        ...mapState({
            user: state => state.user
        }),
        ...mapGetters('user', {
            dictionaries: 'dictionaries',
            groups: 'groups'
        })
    },
    methods: {
        toggleDropdown() {
            this.dropdownIsActive = !this.dropdownIsActive;
        },
    },
}
</script>

<style scoped>

</style>
