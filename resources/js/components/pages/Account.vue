<template>
    <main class="d-flex flex-nowrap">
        <h1 class="visually-hidden">Личный кабинет пользователя</h1>
        <account-sidebar/>
        <div class="p-2 flex-fill position-relative">
            <account-details/>
            <account-dictionaries/>
            <account-achievements/>
            <account-groups/>
        </div>
    </main>
</template>

<script>
import AccountSidebar from "../partials/account/AccountSidebar";
import AccountDictionaries from "../partials/account/AccountDictionaries";
import AccountDetails from "../partials/account/AccountDetails";
import AccountAchievements from "../partials/account/AccountAchievements";
import AccountGroups from "../partials/account/AccountGroups";

export default {
    name: "Account",
    components: {AccountGroups, AccountAchievements, AccountDictionaries, AccountSidebar, AccountDetails}
}
</script>

<style scoped>

</style>
