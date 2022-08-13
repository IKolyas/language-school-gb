<template>
    <div class="container">
        <AppHeader/>
        <router-view/>
        <AppFooter/>
    </div>
</template>

<script>
import AppHeader from '../partials/AppHeader'
import AppFooter from "../partials/AppFooter";
export default {
    components: {AppFooter, AppHeader}
}
</script>

<style lang="scss" scoped>

</style>
