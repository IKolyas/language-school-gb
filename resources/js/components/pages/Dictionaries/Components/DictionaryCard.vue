<template>
    <div class="dictionary-item">
        <router-link
            :to="{name: 'dictionary', params: { id: dictionary.id }}">
            <div class="dictionary-item__body">
                <img src="/images/image_24.png" class="dictionary-item__image" alt="dictionary-image" width="187" height="186">
                <h3 class="dictionary-item__title">{{ dictionary.dictionary_name }}</h3>
                <p class="dictionary-item__text">Словарь создал <span class="dictionary-item__text_name">{{ dictionary.creator }}</span></p>
                <p class="dictionary-item__meta">
                    Создан {{ dictionary.created_at }}
                </p>
            </div>
        </router-link>
    </div>
</template>

<script>
export default {
    name: "DictionaryCard",
    props: ['dictionary'],
}
</script>

<style scoped>

</style>
