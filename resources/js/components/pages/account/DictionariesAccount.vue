<template>
    <h2 class="my-4">Словари</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col" v-for="dictionary in dictionaries">
            <router-link
                :to="{name: 'practice', params: { dictionaryId: dictionary.id }}"
            >
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
    <router-link :to="{name: 'dictionaries'}">
        <button class="btn btn-primary">Найти словарь</button>
    </router-link>
    <router-link :to="{name: 'dictionaryCreate'}">
        <button class="btn btn-primary">Создать новый словарь</button>
    </router-link>


</template>

<script>
import {mapGetters} from 'vuex';

export default {
    name: "Dictionaries",

    computed: {
        ...mapGetters('user', {
            dictionaries: 'dictionaries',
        })
    }
}
</script>

<style scoped>

</style>
