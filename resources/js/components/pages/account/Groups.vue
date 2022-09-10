<template>
    <section class="user-groups container">
        <h2 class="visually-hidden">Ваши группы</h2>
        <h3 class="user-groups__title">Число групп, в которых вы состоите: <span
            class="user-groups__count">{{ groupsCount }} группы</span></h3>
        <ul class="user-groups__groups-list groups-list">
            <li class="groups-list__item group-item" v-for="group in groups">
                <div class="group-item__body">
                    <img src="http://placekitten.com/166/166" class="group-item__image" alt="group-logo" width="166"
                         height="166">
                    <h5 class="group-item__title">Группа номер {{ group.id }}<br> школы "{{ group.school }}"</h5>
                    <p class="group-item__description">{{ group.description }}</p>
                </div>
                <div class="group-item__footer">
                    <p class="group-item__footer-text">
                        Преподаватель:
                        <span class="group-item__footer-value">{{ group.teacher }}</span>
                    </p>
                    <p class="group-item__footer-text">
                        Должность:
                        <span class="group-item__footer-value">{{ group.academic_degree }}</span>
                    </p>
                </div>
            </li>
        </ul>
    </section>
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
