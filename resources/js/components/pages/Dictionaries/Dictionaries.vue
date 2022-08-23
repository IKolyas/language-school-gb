<template>
    <main class="dictionaries-page">
        <h1 class="visually-hidden">Все словари</h1>
        <form action="" class="dictionaries-page__search-form search-form">
            <input type="search" class="search-form__input" placeholder="Поиск по словарям"/>
            <input type="submit" class="search-form__submit" value="найти">
        </form>
        <router-link :to="{name: 'dictionaryCreate'}" class="dictionaries-page__new-dictionary-button">
            Создать новый словарь
        </router-link>
        <ul class="dictionaries-page__dictionaries-list dictionary-list">
            <li class="dictionary-list__item dictionary-item" v-for="dictionary in dictionaries">
                <router-link
                    :to="{name: 'dictionary', params: { id: dictionary.id }}">
                    <div class="dictionary-item__body">
                        <img src="../../../../img/image_25.png" class="dictionary-item__image" alt="dictionary-image" width="187" height="186">
                        <h3 class="dictionary-item__title">{{ dictionary.dictionary_name }}</h3>
                        <p class="dictionary-item__text">Словарь создал <span class="dictionary-item__text_name">{{ dictionary.creator }}</span></p>
                        <p class="dictionary-item__meta">
                            Создан {{ dictionary.created_at }}
                        </p>
                    </div>
                </router-link>
            </li>
        </ul>
    </main>
</template>

<script>
import {mapState} from "vuex";

export default {
    name: "Dictionaries",
    props: ['id'],

    computed: {
        ...mapState({
            dictionaries: state => state.dictionaries.dictionariesList,
        }),
    },
    mounted() {
        if (!this.dictionaries.length) {
            this.$store.dispatch('dictionaries/fetchDictionaries');
        }
    },
}
</script>
<style scoped>

</style>
