<template>
    <div
        class="tab-pane fade position-absolute top-0 start-30"
        id="groups-pane"
        role="tabpanel"
        aria-labelledby="pills-groups-tab"
        tabindex="0">
        <h2 class="my-4">Группы</h2>
        <div class="card-group">
            <div class="card">
                <img src="http://placekitten.com/300/150" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">Название группы</h5>
                    <p class="card-text">Описание группы</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Преподаватель</small>
                </div>
            </div>
            <div class="card">
                <img src="http://placekitten.com/300/150" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">Название группы</h5>
                    <p class="card-text">Описание группы</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Преподаватель</small>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AccountGroups"
}
</script>

<style scoped>

</style>
