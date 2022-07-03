<template>
    <h2>На этой страничке выводится один словарь и список его слов</h2>
    <h3>Название{{ dictionaryName }}</h3>
    <h3>Словарь создал {{ creator }}</h3>
    <ul>
        <li v-for="word in words">
            <p>{{word.word}}  -  {{word.translation}}</p>
        </li>
    </ul>
   <button type="button" class="btn btn-primary">Добавить словарь к себе</button>
</template>

<script>
import {mapState} from "vuex";

export default {
    name: "DictionaryOne",
    computed: {
        ...mapState({
            dictionary: state => state.dictionaries.dictionary,
            dictionaryName: state => state.dictionaries.dictionary.dictionary_name,
            creator: state => state.dictionaries.dictionary.creator,
            creationDate: state => state.dictionaries.dictionary.created_at,
            words: state => state.dictionaries.dictionary.words
        }),
    },
    mounted() {
        const id = this.$route.params.id;
        this.$store.dispatch('dictionaries/fetchDictionary', {id: id});
    }
}
</script>

<style scoped>

</style>
