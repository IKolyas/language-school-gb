<template>
    <form v-on:submit.prevent="onSubmitDictionary">
        <div class="mb-3">
            <label for="formFile" class="form-label">Выберите изображение</label>
            <input class="form-control" type="file" id="formFile">
        </div>
        <div class="row g-2">
            <div class="col-md">
                <select class="form-select" aria-label="Choose a language">
                    <option selected>English</option>
                    <option value="1">Русский</option>
                    <option value="2">Espanol</option>
                    <option value="3">Türkçe</option>
                </select>
            </div>
            <div class="col-md">
                <select class="form-select" aria-label="Choose a language">
                    <option selected>Русский</option>
                    <option value="1">English</option>
                    <option value="2">Espanol</option>
                    <option value="3">Türkçe</option>
                </select>
            </div>
        </div>
        <input type="text" class="form-control" id="floatingInputGridName" placeholder="Название словаря"
               v-model="dictionary_name">
        <div class="mb-3">
            Описание словаря
            <textarea class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="notifyCheckbox" checked>
            <label class="form-check-label" for="notifyCheckbox">Сделать приватным</label>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
</template>

<script>
import {addDictionary} from "../../../services/dictionary.service";
import {mapState} from "vuex";

export default {
    name: "DictionaryCreate",
    data() {
        return {
            dictionary_name: '',
        }
    },
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
    },
    methods: {
        onSubmitDictionary() {
            addDictionary({dictionary_name: this.dictionary_name, creator_id: this.user.id}).then((data) => {
                this.$router.push({
                    name: 'dictionaryOne',
                    params: {
                        id: data.dictionary
                    }
                });
            });
        }
    }
}
</script>

<style scoped>

</style>
