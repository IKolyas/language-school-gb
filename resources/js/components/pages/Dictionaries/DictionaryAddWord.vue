<template>
    <form v-on:submit.prevent="onSubmitWord" class="dictionary-content__add-word-form add-word-form">
        <div class="add-word-form__row">
            <div class="add-word-form__input-area">
                <p class="add-word-form__input-label">Word in English</p>
                <input class="add-word-form__input" type="text" placeholder="Word in English"
                       v-model="word">
            </div>
            <div class="add-word-form__input-area">
                <p class="add-word-form__input-label">Слово на русском</p>
                <input class="add-word-form__input" type="text" placeholder="Слово на русском"
                       v-model="translation">
            </div>
        </div>
        <div class="add-word-form__row">
            <div class="add-word-form__input-area">
                <p class="add-word-form__input-label">Example sentence</p>
                <textarea class="add-word-form__textarea" rows="2" v-model="exampleEnglish"></textarea>
            </div>
            <div class="add-word-form__input-area">
                <p class="add-word-form__input-label">Пример использования</p>
                <textarea class="add-word-form__textarea" rows="2" v-model="exampleRussian"></textarea>
            </div>
        </div>
        <div class="add-word-form__row add-word-form__row_controls">
            <button type="submit" class="dictionary-content__button">Добавить слово</button>
            <button type="button" class="dictionary-content__button" @click="$emit('toggleAddForm')">
                Закончить добавлять слова
            </button>
        </div>
    </form>
</template>

<script>

export default {
    name: "DictionaryAddWord",
    data() {
        return {
            word: '',
            translation: '',
            exampleEnglish: '',
            exampleRussian: '',
        }
    },
    methods: {
        onSubmitWord() {
            this.$store.dispatch('dictionaries/addWord', {
                word: this.word,
                translation: this.translation,
                dictionary_id: this.$route.params.id,
                user_id: 3
            });
            //TODO User_Id из авторизации
            this.word = '';
            this.translation = '';
            this.exampleEnglish = '';
            this.exampleRussian = '';
        }
    },
    emits: ['toggleAddForm'],
}
</script>

<style scoped>

</style>
