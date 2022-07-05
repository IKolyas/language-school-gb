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
        <input type="text" class="form-control" id="floatingInputGridName" placeholder="Название словаря">
        <div class="mb-3">
            Описание словаря
            <input type="textarea" class="form-control" style="height: 100px">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="notifyCheckbox" checked>
            <label class="form-check-label" for="notifyCheckbox">Сделать приватным</label>
        </div>
        <button type="submit" class="btn btn-primary">Продолжить</button>
    </form>
    <h2>Когда закончил наполнять форму и нажал сохранить должно редиректить на страничку просмотра одного словаря</h2>
</template>

<script>
export default {
    name: "DictionaryCreate",
    methods: {
        onSubmitDictionary() {
            console.log('Отправляем создание словаря');
            //здесь нужно получить значение его id
            this.$router.push({
                name: 'dictionaryOne',
                params: {
                    id: 2 //сюда вставить нужный id
                }
            });
        }
    }

}
</script>

<style scoped>

</style>
