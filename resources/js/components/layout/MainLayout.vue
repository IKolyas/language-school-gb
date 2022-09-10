<template>
	<TheLoader v-if="isLoadingMain" />
	<div class="root-container" :class="{'locked': isPageLocked}" style="height: 100%">
		<TheHeader/>
		<router-view/>
		<TheFooter/>
	</div>
</template>

<script>
import TheHeader from '../partials/TheHeader'
import TheFooter from "../partials/TheFooter";
import TheLoader from '../partials/TheLoader';
export default {
    components: {TheLoader, TheFooter, TheHeader},

    computed: {
		isLoadingMain () {
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
