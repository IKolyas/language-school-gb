<template>
    <h2 class="my-4">Группы</h2>
    <p>Число групп, в которых вы состоите: {{groupsCount}}</p>
        <div class="row">
            <div class="card col-3" v-for="group in groups">
                <img src="http://placekitten.com/300/150" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">Группа номер {{group.id}} школы "{{group.school}}"</h5>
                    <p class="card-text">{{ group.description }}</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Преподаватель: {{ group.teacher }} {{group.academic_degree}}</small>
                </div>
            </div>
        </div>
</template>

<script>
import {mapState} from "vuex";

export default {
    name: "AccountGroups",
    computed: {
        ...mapState({
            groups: state => state.user.groups,
            groupsCount: state => state.user.groups.length,
        }),
    },
}
</script>

<style scoped>

</style>
