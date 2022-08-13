<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-3 card">
                <img src="http://placekitten.com/300/150" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">{{ dictionaryName }}</h5>
                    <p class="card-text">Словарь создал {{ creator }}</p>
                    <p class="card-text">Языки: русский-английский</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Создан {{ creationDate }}</small>
                    <p>Приватный\публичный</p>
                </div>
            </div>
        </div>
        <dictionary-add-word v-if="addFormActive" @toggle-add-form="toggleAddForm"></dictionary-add-word>
        <div v-if="userHasDictionary && !addFormActive">
            <button type="button" class="btn btn-primary" @click="removeFromMyDictionaries">Удалить из своих
                словарей
            </button>
            <router-link
                :to="{name: 'dictionaryProgress', params: { id: id }}">
                <button type="button" class="btn btn-primary">Посмотреть прогресс</button>
            </router-link>
        </div>
        <button type="button" class="btn btn-primary" v-else-if="!addFormActive"
                @click="addToMyDictionaries">Добавить словарь к себе
        </button>

        <div v-if="!addFormActive && isThisUserCreator">
            <button type="button" class="btn btn-primary" @click="toggleAddForm">Добавить слова</button>
            <button type="button" class="btn btn-primary" @click="destroyDictionary">Уничтожить словарь</button>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Слово на русском</th>
                <th scope="col">Word in English</th>
                <th scope="col" v-if="addFormActive">Удалить</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(word, index) in words">
                <th scope="row">{{ index }}</th>
                <td>{{ word.word }}</td>
                <td>{{ word.translation }}</td>
                <td v-if="addFormActive">
                    <button class="btn btn-primary" @click="removeWord(word.id)">X</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import {mapState} from "vuex";
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
        isThisUserCreator() {
            return this.dictionary.creator_id === this.user.id;
        },
        userHasDictionary() {
            let userHasDictionary = false;
            this.user.dictionaries.some(dictionary => {
                if (dictionary.id === this.dictionaryId) {
                    userHasDictionary = true;
                }
            })
            return userHasDictionary;
        },
    },
    mounted() {
        if (this.dictionaryId !== +this.$route.params.id) {
            this.$store.dispatch('dictionaries/fetchDictionary', {id: this.$route.params.id});
        }
    },
    methods: {
        toggleAddForm() {
            this.addFormActive = !this.addFormActive;
        },
        removeWord(wordId) {
            this.$store.dispatch('dictionaries/actionRemoveWord', {
                word_id: wordId,
                dictionary_id: this.dictionaryId,
                user_id: this.user.id
            });
        },
        destroyDictionary() {
            this.$store.dispatch('dictionaries/actionDestroyDictionary', {id: this.dictionaryId});
            this.$router.push({
                name: 'dictionaries'
            });
        },
        addToMyDictionaries() {
            this.$store.dispatch('dictionaries/actionAddToMyDictionaries', {
                user_id: this.user.id,
                dictionary_id: this.dictionaryId
            })
            this.$router.push({
                name: 'account'
            });
        },
        removeFromMyDictionaries() {
            this.$store.dispatch('dictionaries/actionRemoveFromMyDictionaries', {
                user_id: this.user.id,
                dictionary_id: this.dictionaryId
            })
            this.$router.push({
                name: 'account'
            });
        }
    }
}
</script>

<style scoped>

</style>
