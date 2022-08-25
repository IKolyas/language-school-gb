<template>
    <section class="settings-page">
        <h2 class="visually-hidden">Настройте свой профиль</h2>
        <img class="settings-page__avatar" src="http://placekitten.com/300/300" alt="avatar" width="200" height="200">
        <form v-on:submit.prevent="onSubmit" class="settings-page__form settings-form">
            <div class="settings-form__row">
                <div class="setting-form__group">
                    <label for="avatarFile" class="settings-form__label">Новый аватар</label>
                    <input type="file" id="avatarFile" class="settings-form__file-input">
                </div>
            </div>
            <div class="settings-form__row">
                <div class="setting-form__group">
                    <label for="email" class="settings-form__label">Email address</label><br>
                    <input type="email" class="settings-form__input" id="email" :value="userInfo.email">
                </div>
                <div class="setting-form__group">
                    <label class="settings-form__label" for="notifyCheckbox">Sent me notifications</label><br>
                    <input type="checkbox" class="setting-form__checkbox" id="notifyCheckbox" checked>
                </div>
            </div>
            <div class="settings-form__row">
                <div class="setting-form__group">
                    <label for="name">Your name</label>
                    <input type="text" class="settings-form__input" id="name" placeholder="name"
                           :value="userInfo.name">
                </div>
                <div class="setting-form__group">
                    <label for="lastname">Your lastname</label>
                    <input type="text" class="settings-form__input" id="lastname" placeholder="lastname"
                           :value="userInfo.lastname">
                </div>
            </div>
            <div class="settings-form__row">
                <label for="about">About you</label>
                <textarea id="about" class="setting-form__textarea settings-form__input"
                          placeholder="tell about yourself"></textarea>
            </div>
            <button type="submit" class="setting-form__button">Save changes</button>
        </form>
    </section>
</template>

<script>
import {mapState} from 'vuex';

export default {
    name: "AccountDetails",

    computed: {
        ...mapState({
            userInfo: state => state.user
        })
    },

    methods: {
        onSubmit() {
            //TODO сделать обновление данных пользователя
            alert("Новые данные сохранены");
        },
    }
}
</script>

<style scoped>

</style>
