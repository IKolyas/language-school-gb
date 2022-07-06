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
        <dictionary-add-word v-if="addFormActive" @toggle-add-form="toggleAddForm"></dictionary-add-word>
        <button type="button" class="btn btn-primary" v-if="userHasDictionary && !addFormActive">Удалить из своих словарей</button>
        <button type="button" class="btn btn-primary" v-else-if="!addFormActive">Добавить словарь к себе</button>
        <!--             TODO эта кнопка активна, если словарь принадлежит пользователю, то есть он его создатель-->
        <button type="button" class="btn btn-primary" @click="toggleAddForm" v-if="!addFormActive">Добавить слова</button>
        <ul>
            <li v-for="word in words">
                <p>{{ word.word }} - {{ word.translation }}</p>
            </li>
        </ul>
        //эта кнопка активна, если словарь принадлежит пользователю, то есть он его создатель
    </div>


</template>

<script>
import {mapGetters, mapState} from "vuex";
import DictionaryAddWord from "./DictionaryAddWord";

export default {
    name: "DictionaryOne",
    components: {DictionaryAddWord},
    data() {
        return {
            addFormActive: false,
        }
    },
    props: ['id'],
    computed: {
        ...mapState({
            dictionary: state => state.dictionaries.dictionary,
            dictionaryName: state => state.dictionaries.dictionary.dictionary_name,
            creator: state => state.dictionaries.dictionary.creator,
            creationDate: state => state.dictionaries.dictionary.created_at,
            words: state => state.dictionaries.dictionary.words,
            dictionaryId: state => state.dictionaries.dictionary.id,
            user: state => state.user,
        }),
        ...mapGetters('user', {
            dictionaries: 'dictionaries',
        }),
        userHasDictionary() {
            let has = false;
            this.user.dictionaries.some( dictionary => {
                 if (dictionary.id === this.dictionaryId) {
                     has = true;
                 }
            })
            return has;
        }

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
    }
}
</script>

<style scoped>

</style>
