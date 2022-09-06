<template>
    <main class="dictionaries-page">
        <h1 class="visually-hidden">Все словари</h1>
        <div class="dictionaries-page__search-form search-form">
            <input v-model="search" type="search" class="search-form__input" placeholder="Поиск по словарям"/>
        </div>
        <router-link :to="{name: 'dictionaryCreate'}" class="dictionaries-page__new-dictionary-button">
            Создать новый словарь
        </router-link>
        <ul v-if="dictionaryFilter" class="dictionaries-page__dictionaries-list dictionary-list">
            <li v-for="dictionary in dictionaryFilter">
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
    data() {
       return {
           search: null
       }
    },
    computed: {
        ...mapState({
            dictionaries: state => state.dictionaries.dictionariesList,
        }),
        dictionaryFilter: function () {
            return this.search && this.search.length > 2
                ? this.dictionaries.filter(dictionary => dictionary.dictionary_name.toLowerCase().includes(this.search.toLowerCase()))
                : this.dictionaries
        }
    },
    mounted() {
        if (!this.dictionaries.length) {
            this.$store.dispatch('dictionaries/fetchDictionaries');
        }
    },
    methods: {
        clearSearch: () => {
            this.search = null;
        }
    }
}
</script>
<style lang="scss" scoped>

</style>
