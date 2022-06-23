<template>
    <main class="d-flex flex-nowrap">
        <h1 class="visually-hidden">Личный кабинет пользователя</h1>
        <account-sidebar/>
        <div class="b-example-divider b-example-vr"></div>
        <div class="p-2 flex-fill">
            <account-dictionaries/>
            <account-details/>
        </div>
    </main>
</template>

<script>
import AccountSidebar from "../partials/AccountSidebar";
import AccountDictionaries from "../partials/AccountDictionaries";
import AccountDetails from "../partials/AccountDetails";

export default {
    name: "Account",
    components: {AccountDictionaries, AccountSidebar, AccountDetails}
}
</script>

<style scoped>
.b-example-vr {
    flex-shrink: 0;
    width: 1.5rem;
    height: 100vh;
}

</style>
