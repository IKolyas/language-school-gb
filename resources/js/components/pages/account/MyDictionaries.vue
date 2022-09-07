<template>
    <section class="user-dictionaries-page">
        <h2 class="visually-hidden">Ваши словари</h2>
        <div class="user-dictionaries-page__links-group">
            <router-link :to="{name: 'dictionaryCreate'}" class="user-dictionaries-page__link-button">
                <!--TODO поменять классы кнопок-->
                Создать новый словарь
            </router-link>
            <router-link :to="{name: 'dictionaries'}" class="user-dictionaries-page__link-button">
                Найти словарь
            </router-link>
        </div>
        <ul class="user-dictionaries-page__dictionaries-list dictionary-list">
            <li v-for="dictionary in dictionaries">
                <DictionaryCard :dictionary="dictionary" class="dictionary-list__item"></DictionaryCard>
            </li>
        </ul>
    </section>
</template>

<script>
import {mapGetters} from 'vuex';
import DictionaryCard from "../Dictionaries/Components/DictionaryCard";

export default {
    name: "Dictionaries",
    components: {DictionaryCard},
    computed: {
        ...mapGetters('user', {
            dictionaries: 'dictionaries',
        })
    },
}
</script>

<style scoped>

</style>
