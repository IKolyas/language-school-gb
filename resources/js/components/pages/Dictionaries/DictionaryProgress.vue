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
        <router-link
            :to="{name: 'dictionary', params: { id: id }}">
            <button type="button" class="btn btn-primary">Назад</button>
        </router-link>
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
                <td>
                    <button class="btn btn-primary" @click="removeWord(word.id)">X</button>
                </td>
            </tr>
            </tbody>
        </table>
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
                this.$store.dispatch('dictionaries/fetchDictionaryWithRating', {
                    dictionary_id: this.$route.params.id,
                    user_id: this.user.id
                });
            });
        } else {
            this.$store.dispatch('dictionaries/fetchDictionaryWithRating', {
                dictionary_id: this.$route.params.id,
                user_id: this.user.id
            });
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
