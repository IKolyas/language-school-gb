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
                    <input type="email" class="settings-form__input" id="email" :value="email" @input="updateEmail">
                </div>
                <div class="setting-form__group">
                    <label class="settings-form__label" for="notifyCheckbox">Sent me notifications</label><br>
                    <input type="checkbox" class="setting-form__checkbox" id="notifyCheckbox" checked>
                </div>
            </div>
            <div class="settings-form__row">
                <div class="setting-form__group">
                    <label for="name">Your name</label>
                    <input type="text" class="settings-form__input" id="name"
                           :value="name" @input="updateName">
                </div>
                <div class="setting-form__group">
                    <label for="lastname">Your lastname</label>
                    <input type="text" class="settings-form__input" id="lastname"
                           :value="lastname" @input="updateLastname">
                </div>
            </div>
            <div class="settings-form__row">
                <label for="about">About you</label>
                <textarea id="about" class="setting-form__textarea settings-form__input"
                          placeholder="tell about yourself" v-model="newAbout"></textarea>
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
                email:  state => state.user.email,
                name: state => state.user.name,
                lastname: state => state.user.lastname,
                userId: state => state.user.id,
            })
    },
    methods: {
        onSubmit() {
            this.$store.dispatch('user/updateUser', {
                user_id: this.userId,
                data: {
                    name: this.name,
                    lastname: this.lastname,
                    email: this.email,
                    about: this.about,
                }
            });
            alert('Настройки сохранены');
        },
        updateName(e) {
            this.$store.commit('user/updateName', e.target.value);
        },
        updateLastname(e) {
            this.$store.commit('user/updateLastname', e.target.value);
        },
        updateEmail(e) {
            this.$store.commit('user/updateEmail', e.target.value);
        }
    }
}
</script>

<style scoped>

</style>
