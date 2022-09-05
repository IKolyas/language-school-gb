<template>
    <footer class="main-footer">
		<div class="container">
			<div class="main-footer__inner">
				<router-link to="/"><img src="../../../img/main-logo.png" alt="" class="main-footer__logo"></router-link>
				<ul class="main-footer__navigation navigation">
					<li
					class="navigation__item"
					v-for="(menu, index) in menus"
					:key="index"
					>
						<router-link :to="{name: menu.linkName}" class="navigation__link" active-class="navigation__item_active bottom-marked">
							{{ menu.text }}
						</router-link>
					</li>
				</ul>
			</div>

			<p class="main-footer__copyright">&copy; LanguageSchool 2022</p>
		</div>
    </footer>
</template>

<script>
export default {
    name: "AppFooter",
	data() {
		return {
			menus: [
				{
					text: 'Главная',
					linkName: 'home'
				},
				{
					text: 'Практика',
					linkName: 'practiceTest'
				},
				{
					text: 'Мои достижения',
					linkName: 'achievements'
				},
				// {
				// 	text: 'Политика конфиденциальности',
				// 	linkName: 'policy'
				// }
			],
		}
	}
}
</script>

<style lang="scss">
.main-footer {
	background: linear-gradient(180deg, rgba(90, 200, 225, 0.87) 0%, #CDB7FA 100%);

	.main-footer__inner {
		padding: 30px 0;
		display: flex;
		align-items: center;
		justify-content: space-between;
		color: #0061FE;
	}

	.main-footer__logo {
		max-width: 207px;
		max-height: 117px;
	}

	.main-footer__navigation {
	}

	.navigation {
		font-family: Source Sans Pro, sans-serif;
		font-size: 20px;
		font-weight: 400;
		line-height: 28px;
		letter-spacing: 0.05em;
		text-align: left;
	}

	.contacts {
		font-family: Source Sans Pro, sans-serif;
		font-size: 15px;
		font-weight: 400;
		line-height: 21px;
		letter-spacing: 0.05em;
		text-align: right;
	}

	.contacts__button {
		border: 1px solid #FFFFFF;
		background-color: #3660CC;
		color: #FFF;
		padding: 10px 20px;
		margin-bottom: 20px;
	}

	.contacts__button:hover {
		background-color: rgba(255, 255, 255, 0.12);
	}

	.contacts__button:active {
		background-color: rgba(255, 255, 255, 0.80);
		color: #3660CC;
	}

	.contacts__phone {
		font-family: Source Sans Pro, sans-serif;
		font-size: 20px;
		font-weight: 600;
		line-height: 28px;
		letter-spacing: 0.05em;
		text-align: left;
		margin-bottom: 20px;
	}
}
</style>
