<template>
	<TheHeader/>
<!--	<AppLoader v-if="isLoading"/>-->
	<router-view/>
	<TheFooter/>
</template>

<script>
import TheHeader from '../partials/TheHeader'
import TheFooter from "../partials/TheFooter";
export default {
    components: {TheFooter, TheHeader},
    computed: {
        isLoading: function () {
            return this.$store.getters.mainLoader;
        }
    }
}
</script>

<style lang="scss" scoped>
</style>
