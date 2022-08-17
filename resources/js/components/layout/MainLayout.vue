<template>
    <div class="container">
        <AppHeader/>
        <div class="main-content">
            <AppLoader v-if="isLoading"/>
            <router-view/>
        </div>
        <AppFooter/>
    </div>
</template>

<script>
import AppHeader from '../partials/AppHeader'
import AppFooter from "../partials/AppFooter";
export default {
    components: {AppFooter, AppHeader},
    computed: {
        isLoading: function () {
            return this.$store.getters.mainLoader;
        }
    }
}
</script>

<style lang="scss" scoped>
    .main-content {
        min-height: calc(100vh - 450px);
        position: relative;
    }
</style>
