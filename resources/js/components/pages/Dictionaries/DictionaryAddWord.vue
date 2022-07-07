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
                <input type="textarea" class="form-control" style="height: 70px">
            </div>
            <div class="col-6">
                Пример использования
                <input type="textarea" class="form-control" style="height: 70px">
            </div>
        </div>
        <button type="submit" class="btn btn-primary" @click="onSubmitWord">Добавить слово</button>
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
            console.log({word: this.word, translation: this.translation})
            const word = addWord({word: this.word, translation: this.translation})
            console.log(word + "Here is your id")
            //TODO Метод не работает, должен возвращать id, который передается в dispatch
            // this.$store.dispatch("dictionaries/addWord", {word: this.word, translation: this.translation, id: 77});
            // this.word = '';
            // this.translation = '';
        }
    },
    emits: ['toggleAddForm'],
}
</script>

<style scoped>

</style>
