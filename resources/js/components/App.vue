<template>
	<component :is="layout + '-layout'"/>
</template>

<script>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import MainLayout from './layout/MainLayout'

export default {
	setup () {
		const route = useRoute()

		return {
			layout: computed(() => route.meta.layout || 'main')
		}
	},
	components: { MainLayout },

    created() {
        this.$store.dispatch('user/fetchUser', {id: 3});
    },
}
</script>
