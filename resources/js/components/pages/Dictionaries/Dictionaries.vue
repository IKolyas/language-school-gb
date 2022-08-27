<template>
    <main class="dictionaries-page">
        <h1 class="visually-hidden">Все словари</h1>
        <form action="" class="dictionaries-page__search-form search-form">
            <input type="search" class="search-form__input" placeholder="Поиск по словарям"/>
            <input type="submit" class="search-form__submit" value="найти">
        </form>
        <router-link :to="{name: 'dictionaryCreate'}" class="dictionaries-page__new-dictionary-button">
            Создать новый словарь
        </router-link>
        <ul class="dictionaries-page__dictionaries-list dictionary-list">
            <li v-for="dictionary in dictionaries">
                <DictionaryCard :dictionary="dictionary"
                                class="dictionary-list__item">
                </DictionaryCard>
            </li>
        </ul>
    </main>
</template>

<script>
import {mapState} from "vuex";
import DictionaryCard from "./Components/DictionaryCard";

export default {
    name: "Dictionaries",
    components: {DictionaryCard},
    props: ['id'],
    computed: {
        ...mapState({
            dictionaries: state => state.dictionaries.dictionariesList,
        }),
    },
    mounted() {
        if (!this.dictionaries.length) {
            this.$store.dispatch('dictionaries/fetchDictionaries');
        }
    },
}
</script>
<style scoped>

</style>
