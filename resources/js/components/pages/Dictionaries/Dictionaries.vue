<template>
<h2>На этой странице представлены вообще все словари, которые есть. Выбирай нужный, добавляй к себе и тренируйся!</h2>
    <div class="input-group">
        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
        <button type="button" class="btn btn-outline-primary">search</button>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col" v-for="dictionary in dictionaries">
            <router-link
                :to="{name: 'dictionaryOne', params: { id: dictionary.id }}">
                <div class="card h-100">
                    <img src="http://placekitten.com/300/150" class="card-img-top" alt="">
                    <div class="card-body">

                        <h5 class="card-title">{{ dictionary.dictionary_name }}</h5>

                        <p class="card-text">Словарь создал {{ dictionary.creator }}</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Создан {{ dictionary.created_at }}</small>
                    </div>
                </div>
            </router-link>
        </div>
    </div>
    <router-link :to="{name: 'dictionaryCreate'}">
        <button class="btn btn-primary">Создать новый словарь</button>
    </router-link>

</template>

<script>
import {mapState} from "vuex";

export default {
    name: "Dictionaries",
    props: ['id'],

    computed: {
        ...mapState({
            state: state => state,
            dictionaries: state => state.dictionaries.dictionariesList,
        }),
    },
    mounted() {
        this.$store.dispatch('dictionaries/fetchDictionaries');
    },
}
</script>
<style scoped>

</style>
