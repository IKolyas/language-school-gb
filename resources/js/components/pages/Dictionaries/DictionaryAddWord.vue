<template>
    <form v-on:submit.prevent="onSubmitWord">
        <div class="row g-2">
            <div class="col-6">
                <input type="text" class="form-control"  placeholder="Word in English" v-model="word">
            </div>
            <div class="col-6">
                <input type="text" class="form-control" placeholder="Слово на русском" v-model="translation">
            </div>
        </div>

        <div class="row g-2">
            <div class="col-6">
                Example sentence
                <textarea class="form-control" rows="3">Поле пока не работает</textarea>
            </div>
            <div class="col-6">
                Пример использования
                <textarea class="form-control" rows="3">Надо ли нам эти поля?</textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Добавить слово</button>
    </form>
    <button type="button" class="btn btn-primary" @click="$emit('toggleAddForm')">Закончить добавлять слова</button>
</template>

<script>
import {addWord} from "../../../services/dictionary.service";

export default {
    name: "DictionaryAddWord",
    data() {
        return {
            word: '',
            translation: '',
        }
    },
    methods: {
        onSubmitWord() {
            addWord({word: this.word, translation: this.translation, dictionary_id: this.$route.params.id})
            this.$store.dispatch('dictionaries/fetchDictionary', {id: this.$route.params.id});
            this.word = '';
            this.translation = '';
        }
    },
    emits: ['toggleAddForm'],
}
</script>

<style scoped>

</style>
