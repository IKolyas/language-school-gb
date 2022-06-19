<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="alert alert-danger" role="alert" v-if="error !== null">
                    {{ error }}
                </div>

                <div class="card card-default">
                    <div class="card-header">Регистрация</div>
                    <div class="card-body">
                        <form>
                            <div class="form-group row my-2">
                                <label for="name" class="col-sm-4 col-form-label text-md-right">Имя</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" v-model="name" required
                                           autofocus autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row my-2">
                                <label for="lastname" class="col-sm-4 col-form-label text-md-right">Фамилия</label>
                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control" v-model="lastname" required
                                           autofocus autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row my-2">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" required
                                           autofocus autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row my-2">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="password"
                                           required autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row mb-0 my-2">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                        Зарегистрироваться
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Register",
    data() {
        return {
            name: "",
            lastname: "",
            email: "",
            password: "",
            error: null
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault()
            if (this.password.length > 0) {
                this.$axios.get('/sanctum/csrf-cookie').then(() => {
                    this.$axios.post('api/register', {
                        name: this.name,
                        lastname: this.lastname,
                        email: this.email,
                        password: this.password
                    })
                        .then(response => {
                            if (response.data.success) {
                                window.location.href = "/login"
                            } else {
                                this.error = response.data.message
                            }
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                })
            }
        }
    },
    beforeRouteEnter(to, from, next) {
        if (window.Laravel.isAuth) {
            return next('dashboard');
        }
        next();
    }
}
</script>

<style scoped>

</style>
