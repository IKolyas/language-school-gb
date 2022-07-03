<template>
    <div class="position-absolute top-0 start-30">
        <div class="d-flex flex-wrap justify-content-between py-3 mb-4 border-bottom">
            <span class="fs-4">Настройте свой профиль</span>
        </div>
        <img src="http://placekitten.com/200/200" alt="" width="200" height="200"><br>
        <form v-on:submit.prevent="onSubmit">
            <div class="mb-3">
                <label for="formFile" class="form-label">Выберите новый аватар</label>
                <input class="form-control" type="file" id="formFile">
            </div>
            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="floatingInputGridEmail" placeholder="name@example.com"
                               :value="userInfo.email">
                        <label for="floatingInputGridEmail">Email address</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <input
							type="password"
							class="form-control"
							id="floatingInputGrid"
							placeholder="password"
                            @click.prevent="changePassword"
						>
                        <label for="floatingInputGrid">Password</label>
                    </div>
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="notifyCheckbox" checked>
                <label class="form-check-label" for="notifyCheckbox">Sent me notifications</label>
            </div>
            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInputGridName" placeholder="name"
                               :value="userInfo.name">
                        <label for="floatingInputGridName">Your name</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInputLastname" placeholder="lastname"
                               :value="userInfo.lastname">
                        <label for="floatingInputLastname">Your lastname</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                About you
                <input type="textarea" class="form-control" value="current user info" style="height: 100px"
                       placeholder="tell about yourself">
            </div>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
    </div>
</template>

<script>
import {mapState} from 'vuex';

export default {
    name: "AccountDetails",

    computed: {
        ...mapState({
            userInfo: state => state.user
        })
    },

    methods: {
        onSubmit() {
            alert("Новые данные сохранены");
        },
        changePassword() {
            alert("Появляется форма смены пароля");
        }
    }
}
</script>

<style scoped>

</style>
