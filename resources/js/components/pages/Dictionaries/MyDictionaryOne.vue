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

        <button type="button" class="btn btn-primary" v-if="userHasDictionary && !addFormActive"
                @click="removeFromMyDictionaries">Удалить из своих
            словарей
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
                <th scope="col">Текущий рейтинг</th>
                <th scope="col">Удалить?</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(word, index) in words">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ word.word }}</td>
                <td>{{ word.translation }}</td>
                <td>{{ word.rating }}</td>
                <!--                TODO удаление слов-->
                <td>
                    <button class="btn btn-primary" @click="removeWord(word.id)">X</button>
                </td>
            </tr>
            </tbody>
            >
        </table>
    </div>
</template>

<script>
import {mapGetters, mapState} from "vuex";
import DictionaryAddWord from "./DictionaryAddWord";
import {deleteUserDictionary, destroyDictionary, removeWord} from "../../../services/dictionary.service";

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
        ...mapGetters('user', {
            dictionaries: 'dictionaries',
        }),
        userHasDictionary() {
            let has = false;
            this.user.dictionaries.some(dictionary => {
                if (dictionary.id === this.dictionaryId) {
                    has = true;
                }
            })
            return has;
        }
    },
    mounted() {
        //TODO Здесь костыль, дважды вызывается fetchUser если эта страница загружается первой.
        if (this.user.id === '') {
            this.$store.dispatch('user/fetchUser', {id: 3}).then(() => {
                this.$store.dispatch('dictionaries/fetchDictionaryWithRating', {dictionary_id: this.$route.params.id, user_id: this.user.id});
            });
        } else {
            this.$store.dispatch('dictionaries/fetchDictionaryWithRating', {dictionary_id: this.$route.params.id, user_id: this.user.id});
        }
    },
    methods: {
        toggleAddForm() {
            this.addFormActive = !this.addFormActive;
        },
        removeWord(wordId) {
            removeWord(this.$route.params.id, wordId);
            this.$store.dispatch('dictionaries/fetchDictionaryWithRating', {dictionary_id: this.$route.params.id, user_id: this.user.id});
        },
        destroyDictionary() {
            destroyDictionary(this.dictionaryId);
            this.$router.push({
                name: 'dictionaries'
            });
        },
        removeFromMyDictionaries() {
            deleteUserDictionary(this.$route.params.id, this.user.id);
            this.$store.dispatch('user/fetchUser', {id: this.user.id});
            this.$router.push({
                name: 'account'
            });
        }
    }
}
</script>

<style scoped>

</style>
