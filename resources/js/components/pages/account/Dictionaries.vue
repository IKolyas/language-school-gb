<template>
    <section class="user-dictionaries-page">
        <h2 class="visually-hidden">Словари</h2>
        <div class="user-dictionaries-page__links-group">
            <router-link :to="{name: 'dictionaryCreate'}" class="user-dictionaries-page__link-button">
                <!--TODO поменять классы кнопок-->
                Создать новый словарь
            </router-link>
            <router-link :to="{name: 'dictionaries'}" class="user-dictionaries-page__link-button">
                Найти словарь
            </router-link>
        </div>

        <ul class="user-dictionaries-page__dictionaries-list dictionary-list">
            <li class="dictionary-list__item dictionary-item" v-for="dictionary in dictionaries">
                <router-link
                    :to="{name: 'dictionary', params: { id: dictionary.id }}">
                    <div class="dictionary-item__body">
                        <img src="http://placekitten.com/186/186" class="dictionary-item__image" alt="dictionary-image"
                             width="186" height="186">
                        <h3 class="dictionary-item__title">{{ dictionary.dictionary_name }}</h3>
                        <p class="dictionary-item__text">Словарь создал <span
                            class="dictionary-item__text_name">{{ dictionary.creator }}</span></p>
                        <p class="dictionary-item__meta">
                            Создан {{ dictionary.created_at }}
                        </p>
                    </div>
                </router-link>
            </li>
        </ul>
    </section>
</template>

<script>
import {mapGetters} from 'vuex';

export default {
    name: "Dictionaries",
    computed: {
        ...mapGetters('user', {
            dictionaries: 'dictionaries',
        })
    },
}
</script>

<style scoped>

</style>
