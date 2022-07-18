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


// export default {
//     name: "App",
//     data() {
//         return {
//             user: false
//         }
//     },
//     created() {
//         if (this.$store.state.isAuth) {
//             this.isAuth = true
//             this.user = window.Laravel.user
//         }
//     },
//     methods: {
//         logout(e) {
//             e.preventDefault()
//             this.$axios.get('/sanctum/csrf-cookie').then(() => {
//                 this.$axios.post('/api/logout')
//                     .then(response => {
//                         if (response.data.success) {
//                             window.location.href = "/"
//                         } else {
//                             console.log(response)
//                         }
//                     })
//                     .catch(function (error) {
//                         console.error(error);
//                     });
//             })
//         }
//     },
// }
</script>
