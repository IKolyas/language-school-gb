<template>
    <div class="vk-logo">
        <img src="/images/vk.gif" height="600" width="800" alt="vk">
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "AuthSocialite",
    created() {
        this.vkAuth();
    },
    methods: {
        ...mapActions({signIn: 'user/login'}),
        vkAuth() {
            this.$axios.get('/sanctum/csrf-cookie').then(() => {
                this.$axios.post('/api/user/vk/get-user/').then(response => {
                    if (!response.data.success) return alert(response.data.message);
                    this.signIn(response.data.token, response.data.user)
                    this.$store.dispatch('user/fetchUser', {id: response.data.user.id}).then(() => {
                        window.location.href = '/'
                    });

                })

            })
        }
    }
}
</script>

<style lang="scss" scoped>
.vk-logo {
    min-height: calc(100% - 378px);
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
