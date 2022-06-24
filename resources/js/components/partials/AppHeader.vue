<template>
	<header class="p-3 mb-3 border-bottom">
		<div class="container">
			<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
				<a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark" style="margin-right: 30px">
					Language school project
				</a>

				<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
					<li><router-link to="/" class="nav-link px-2 link-dark">Главная</router-link></li>
					<li><router-link to="/practice" class="nav-link px-2 link-dark">Практика</router-link></li>
				</ul>

				<div class="d-flex align-items-center">
					<router-link to="/login" class="flex-shrink-0 text-dark" v-if="!isAuth" style="margin-right: 10px">Войти</router-link>
					<router-link to="/register" class="flex-shrink-0 text-dark" v-if="!isAuth" style="margin-right: 10px">Регистрация</router-link>
					<!--	Заменить на v-else	-->
					<div v-if="'exit'" class="flex-shrink-0 dropdown">
						<span class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
							<span class="nav-item" style="margin-right: 10px">{{ 'user.name' }}</span>
							<img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
						</span>
						<ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
							<li class="dropdown-item"><strong>Статус</strong></li>
							<li><hr class="dropdown-divider"></li>
							<li><a class="dropdown-item" href="#">Новый проект</a></li>
							<li><a class="dropdown-item" href="#">Профиль</a></li>
							<li><hr class="dropdown-divider"></li>
							<li><a @click.pervent='logout' class="dropdown-item" href="#">Выйти</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
</template>

<script>
import {mapState, mapGetters, mapActions, mapMutations} from 'vuex'
// import TheNav from '@/components/TheNav'

export default {
  setup () {

  },
  data() {
	return {
	}
  },
  components: {
    // TheNav
  },
  methods: {
        ...mapState({
            isAuth: 'user/isAuth',
            // name: 'user/name',
            // lastname: 'user/lastname',
            // email: 'user/email',
            // photo: 'user/photo',
        }),
        ...mapMutations({
            
        }),
        ...mapActions({
			logout: 'user/logout',
        }),

    }
}
</script>

<style lang="scss" scoped>

</style>
