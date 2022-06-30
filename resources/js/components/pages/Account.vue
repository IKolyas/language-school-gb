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
