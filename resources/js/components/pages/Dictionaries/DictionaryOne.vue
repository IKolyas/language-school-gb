<template>
    {{dictionary}}
    <div class="container">
        <h2>На этой страничке выводится один словарь и список его слов</h2>
            <div class="row justify-content-center">
                <div class="col-3 card">
                    <img src="http://placekitten.com/300/150" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Название</h5>
                        <p class="card-text">Словарь создал Автор</p>
                        <p class="card-text">Языки: русский-английский</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Создан Дата</small>
                        <p>Приватный\публичный</p>
                    </div>
                </div>
            </div>
        <div v-if="addFormActive">
                <form v-on:submit.prevent="onSubmitWord">
                    <div class="row g-2">
                        <div class="col-6">
                            <input type="text" class="form-control"  placeholder="Word in English">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="Слово на русском">
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
                    <button type="submit" class="btn btn-primary" @click="addWord">Добавить слово</button>
                </form>
            <button type="button" class="btn btn-primary" @click="toggleAddForm">Закончить добавлять слова</button>
            //эта кнопка активна, если словарь принадлежит пользователю, то есть он его создатель
        </div>
        <ul>
            <li v-for="word in words">
                <p>{{ word.word }} - {{ word.translation }}</p>
            </li>
        </ul>
        <button type="button" class="btn btn-primary">Добавить словарь к себе</button>
        //если словаря нет у пользователя
        <button type="button" class="btn btn-primary">Удалить из своих словарей</button>
        //если словарь уже у пользователя
        <button type="button" class="btn btn-primary" @click="toggleAddForm" v-if="!addFormActive">Добавить слова</button>
        //эта кнопка активна, если словарь принадлежит пользователю, то есть он его создатель
    </div>


</template>

<script>
import {mapState} from "vuex";

export default {
    name: "DictionaryOne",
    data() {
        return {
            addFormActive: false,
        }
    },
    props: {
        id: id,
    },
    computed: {
        ...mapState({
            dictionary: state => state.dictionaries.dictionary,
            dictionaryName: state => state.dictionaries.dictionary.dictionary_name,
            creator: state => state.dictionaries.dictionary.creator,
            creationDate: state => state.dictionaries.dictionary.created_at,
            words: state => state.dictionaries.dictionary.words,
            id: state => state.dictionaries.dictionary.id,
        }),
    },
    mounted() {
        const id = this.$route.params.id;
        this.$store.dispatch('dictionaries/fetchDictionary', {id: id});
        console.log(this.words);
    },
    methods: {
        toggleAddForm() {
            this.addFormActive = !this.addFormActive;
        },
        addWord() {
            this.$store.dispatch("dictionaries/addWord", {word: 'victoria', translation: 'победа'});
        }
    }
}
</script>

<style scoped>

</style>
