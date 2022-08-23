<template>
    <main class="dictionary-page">
        <section class="dictionary-content dictionary-page__content">
            <dictionary-add-word v-if="addFormActive" @toggle-add-form="toggleAddForm"></dictionary-add-word>
            <router-link :to="{name: 'practice', params: {dictionaryId: id}}"
                         class="dictionary-content__start-button dictionary-content__button"
                         v-if="userHasDictionary">
                Начать неистово тренироваться
            </router-link>
            <div class="dictionary-content__buttons-group">
                <button type="button" class="dictionary-content__button" @click="removeFromMyDictionaries"
                        v-if="userHasDictionary && !addFormActive">Удалить из своих
                    словарей
                </button>
                <button type="button" class="dictionary-content__button" v-else-if="!addFormActive"
                        @click="addToMyDictionaries">Добавить словарь к себе
                </button>
                <button v-if="!addFormActive && isThisUserCreator" type="button" class="dictionary-content__button"
                        @click="toggleAddForm">Изменить слова
                </button>
                <button v-if="!addFormActive && isThisUserCreator" type="button" class="dictionary-content__button"
                        @click="destroyDictionary">Уничтожить словарь
                </button>
            </div>
            <table class="dictionary-content__table dictionary-table">
                <thead class="dictionary-table__head">
                <tr>
                    <th class="dictionary-table__cell dictionary-table__cell_head">#</th>
                    <th scope="col" class="dictionary-table__cell dictionary-table__cell_head">Слово на русском</th>
                    <th scope="col" class="dictionary-table__cell dictionary-table__cell_head">Word in English</th>
                    <th scope="col" class="dictionary-table__cell dictionary-table__cell_head">Текущий рейтинг</th>
                    <th scope="col" class="dictionary-table__cell dictionary-table__cell_head" v-if="addFormActive">
                        Удалить
                    </th>
                </tr>
                </thead>
                <tbody class="dictionary-table__body">
                <tr v-for="(word, index) in words">
                    <th scope="row" class="dictionary-table__cell">{{ index }}</th>
                    <td class="dictionary-table__cell">{{ word.word }}</td>
                    <td class="dictionary-table__cell">{{ word.translation }}</td>
                    <td class="dictionary-table__cell">{{ word.rating }}</td>
                    <td class="dictionary-table__cell" v-if="addFormActive">
                        <button class="dictionary-table__delete-button" @click="removeWord(word.id)">Удалить</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </section>
        <article class="dictionary-page__dictionary-card dictionary-item">
            <div class="dictionary-item__body">
                <img src="../../../../img/image_24.png" class="dictionary-item__image" alt="dictionary-image"
                     width="187" height="186">
                <h3 class="dictionary-item__title">{{ dictionaryName }}</h3>
                <p class="dictionary-item__text">Словарь создал <span
                    class="dictionary-item__text_name">{{ creator }}</span></p>
                <p class="dictionary-item__meta">
                    Создан {{ creationDate }}
                </p>
            </div>
        </article>
    </main>
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
            this.$store.dispatch('dictionaries/fetchDictionaryWithRating', {
                dictionary_id: this.$route.params.id,
                //TODO Get User_id
                user_id: 3
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
