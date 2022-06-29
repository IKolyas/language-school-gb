<template>
    <main class="d-flex flex-nowrap">
        <h1 class="visually-hidden">Личный кабинет пользователя</h1>
        <account-sidebar :user-info="user"/>
        <div class="p-2 flex-fill position-relative">
            <account-details :user-info="user"/>
            <account-dictionaries :user-dictionaries="dictionaries"/>
            <account-achievements/>
            <account-groups :user-groups="groups"/>
        </div>
    </main>
</template>

<script>
import AccountSidebar from "../partials/account/AccountSidebar";
import AccountDictionaries from "../partials/account/AccountDictionaries";
import AccountDetails from "../partials/account/AccountDetails";
import AccountAchievements from "../partials/account/AccountAchievements";
import AccountGroups from "../partials/account/AccountGroups";
import {mapState} from "vuex";

export default {
    name: "Account",
    components: {AccountGroups, AccountAchievements, AccountDictionaries, AccountSidebar, AccountDetails},
    // data() {
    //     return {
    //         userInfo: {
    //             name: "Уилл",
    //             lastname: "Смит",
    //             email: "WillSmith@WillSmith.com",
    //             tasks: {}
    //         },
    //         userDictionaries: [
    //             {
    //                 dictionaryId: "16",
    //                 dictionaryName: "Словарь неправильных глаголов",
    //                 dictionaryCreator: "Вернер Гейзенберг",
    //                 dictionaryDescription: "Словарь как бы есть, но как бы нет"
    //             },
    //             {
    //                 dictionaryId: "17",
    //                 dictionaryName: "Словарь простых слов",
    //                 dictionaryCreator: "Марья Ивановна",
    //                 dictionaryDescription: "Вы уже знаете эти слова"
    //             },
    //             {
    //                 dictionaryId: "6",
    //                 dictionaryName: "Словарь избранного",
    //                 dictionaryCreator: "Уилл Смит",
    //                 dictionaryDescription: "Smith Will Smith will smith Will Smith's statue"
    //             },
    //         ],
    //         userGroups: [
    //             {
    //                 groupId: "144",
    //                 groupDescription: "Младшая группа отстающих школы села Васюки",
    //                 groutTeacher: "Марья Ивановна",
    //                 groupTeacherDegree: "школьный учитель",
    //                 groupSchool: "Школа Васюки",
    //             },
    //             {
    //                 groupId: "602",
    //                 groupDescription: "Группа самых умных ребят закрытого клуба второкурсников",
    //                 groutTeacher: "Вернер Гейзенберг",
    //                 groupTeacherDegree: "профессор",
    //                 groupSchool: "Гарвардский университет",
    //             },
    //
    //         ]
    //     };
    // },
    // mounted() {
    //     fetch('https://dev-language-school-gb.herokuapp.com/api/user/3')
    //     .then(response => response.json())
    //     .then(json => {this.userInfo = json.data})
    // }
    computed: mapState({
        user: state => state.user,
        dictionaries: state => state.user.dictionaries,
        groups: state => state.user.groups,
    })
}
</script>

<style scoped>
    .active {
        z-index: 10;
    }
</style>
