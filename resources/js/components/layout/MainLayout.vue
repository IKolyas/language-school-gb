<template>
	<div class="root-container" :class="{'locked': isPageLocked}" style="height: 100%">
		<TheHeader/>
	<!--	<AppLoader v-if="isLoading"/>-->
		<router-view/>
		<TheFooter/>
	</div>
</template>

<script>
import TheHeader from '../partials/TheHeader'
import TheFooter from "../partials/TheFooter";
export default {
    components: {TheFooter, TheHeader},

    computed: {
        isLoading () {
            return this.$store.getters.mainLoader;
        },
		isPageLocked () {
			return this.$store.getters.isPageLocked;
		}
    }
}
</script>

<style lang="scss">
.root-container {
	height: 100%;
	display: flex;
	flex-direction: column;

}
</style>
