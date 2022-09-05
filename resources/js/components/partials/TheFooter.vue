<template>
    <footer class="main-footer">
		<div class="container">
			<div class="main-footer__inner">
				<img src="../../../img/main-logo.png" alt="" class="main-footer__logo" width="207" height="117">
				<ul class="main-footer__navigation navigation">
					<li class="navigation__item">Практика</li>
					<li class="navigation__item">Мои достижения</li>
					<li class="navigation__item">Словари</li>
					<li class="navigation__item">Политика конфидециальности</li>
				</ul>
				<ul class="main-footer__contacts contacts">
					<li class="contacts__item">
						<button class="contacts__button" type="button">Заказать звонок</button>
					</li>
					<li class="contacts__item contacts__phone">
						+7 (971) 999-99-99
					</li>
					<li class="contacts__item">hi@sitename.ru</li>
					<li class="contacts__item">Адрес</li>
					<li class="contacts__item">Режим работы</li>
				</ul>
			</div>
		</div>
    </footer>
</template>

<script>
export default {
    name: "AppFooter"
}
</script>

<style lang="scss">
.main-footer {
	background: linear-gradient(180deg, rgba(90, 200, 225, 0.87) 0%, #CDB7FA 100%);

	.main-footer__inner {
		padding: 50px 80px;
		display: flex;
		color: #0061FE;
	}

	.main-footer__logo {
		margin-top: 50px;
	}

	.main-footer__navigation {
		margin-top: 70px;
		margin-left: 100px;
	}

	.navigation {
		font-family: Source Sans Pro, sans-serif;
		font-size: 20px;
		font-weight: 400;
		line-height: 28px;
		letter-spacing: 0.05em;
		text-align: left;
	}

	.main-footer__contacts {
		margin-left: auto;
		margin-top: 30px;
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
