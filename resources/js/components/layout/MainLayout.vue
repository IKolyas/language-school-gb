<template>
    <div class="container">
        <AppHeader/>
        <AppLoader v-if="isLoading"/>
        <router-view/>
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
</style>
