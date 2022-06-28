<template>
    <div class="tab-pane fade position-absolute top-0 start-30"
         id="dictionaries-pane" role="tabpanel"
         aria-labelledby="pills-dictionaries-tab" tabindex="0">
    <h2 class="my-4">Словари</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col" v-for="dictionary in userDictionaries">
            <div class="card h-100">
                <img src="http://placekitten.com/300/150" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">{{dictionary.dictionary_name}}</h5>
                    <p class="card-text">Словарь создал {{dictionary.creator}}</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Создан {{dictionary.created_at}}</small>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "Dictionaries",
    props: ['userDictionaries']
}
</script>

<style scoped>

</style>
