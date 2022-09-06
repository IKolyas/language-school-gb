<template>
    <main class="home-page">
        <section class="promo">
			<div class="promo__inner container">
				<div class="promo__content">
					<h1 class="promo__title, visually-hidden">Language school project</h1>
					<img src="../../../img/main-logo.png" alt="Language school project logotype" class="promo__logo">
					<p class="promo__tagline">начни изучать иностранные языки уже сейчас!</p>
					<router-link to="/practiceTest" class="promo__button promo__button_move-right">Попробовать!</router-link>
				</div>
				<a href="#features" class="promo__features-link"></a>
			</div>
        </section>
        <section class="features container" id="features">
            <div class="features__top">
                <h2 class="features__title">Уникальная платформа для изучения иностранных слов!</h2>
                <p class="features__description">
                    Как говорится, повторение - мать учения! Не существует никакого волшебного способа
                    мгновенно выучить много иностранных слов, но есть более и менее эффективные.
                    Один из лучших - использовать карточки слов, раньше они были самыми настоящими, картонными
                    Сейчас всё намного удобнее - учись с любого устройства, твои карточки всегда с тобой!
                    А главное, мы проработали методику и добавили в неё разные способы запоминания,
                    не только выбор верного варианта, но и аудирование и письмо. Используй один из наборов
                    созданных лучшими преподавателями, или создай свой собственный.
                </p>
            </div>
            <h3 class="features__subtitle">
                В чем особенности обучения?
            </h3>
            <ul class="features__list">
                <li class="features__list-item">
					<img src="../../../img/icons/pulse-icon.png" alt="">
                    <p>Разные способы запоминания</p>
                </li>
                <li class="features__list-item">
					<img src="../../../img/icons/book-icon.png" alt="">
                    <p>Словари на все случаи</p>
                </li>
                <li class="features__list-item">
					<img src="../../../img/icons/hat-icon.png" alt="">
                    <p>Много школ и преподавателей</p>
                </li>
                <li class="features__list-item">
					<img src="../../../img/icons/thumbs-up-icon.png" alt="">
                    <p>Разнообразный и богатый опыт</p>
                </li>
                <li class="features__list-item">
					<img src="../../../img/icons/gear-icon.png" alt="">
                    <p>Увлекательный процесс</p>
                </li>
            </ul>
        </section>
    </main>
</template>

<script>
export default {
    name: "Home"
}
</script>

<style lang="scss">
.promo {
	background: linear-gradient(180deg, rgba(202, 230, 246, 0.27) 0%, rgba(162, 117, 249, 0.53) 100%);

	.promo__inner {
		@media (min-width: 1200px) {
			background: url('../../../img/promo-background.png')no-repeat right 120px bottom/60%;
			position: relative;
			display: flex;
			padding: 50px 50px 200px;
		}
	}

	.promo__logo {
		margin-bottom: 20px;
		object-fit: contain;
		width: 100%;
		max-width: 555px;
	}

	.promo__content {
		display: flex;
		flex-direction: column;
		align-items: center;
	}

	.promo__features-link {
		display: block;
		margin: 0 auto;
		width: 80px;
		height: 80px;
		padding: 20px;
		bottom: 15px;
		background: url("../../../img/icons/four-arrows-down-icon.png") no-repeat center center;
		background-size: 80%;
		transition: 0.2s;

		@media (min-width: 1200px) {
			position: absolute;
			left: 45%;
		}
	}

	.promo__features-link:hover {
		background-size: 100%
	}

	.promo__tagline {
		font-weight: 200;
		font-size: 32px;
		line-height: 38px;
		text-align: center;
		letter-spacing: 0.025em;
		max-width: 500px;
	}

	.promo__button {
		display: block;
		width: 270px;
		height: 50px;
		border: 1px solid #043FD6;
		border-radius: 5px;
		font-size: 20px;
		font-weight: 300;
		line-height: 50px;
		letter-spacing: 0.21em;
		text-align: center;
		animation: background-animation 3s infinite linear;
		background: linear-gradient(90deg, rgba(202, 230, 246, 0.27) 0%, rgba(162, 117, 249, 0.53) 50%, rgba(202, 230, 246, 0.27) 100%) 0 0;
		margin: 0 auto 20px;
		transition: all .3s;

		&:hover {
			animation-play-state: paused;
		}
	}

	@keyframes background-animation {
		100% {
			background-position: 270px 0;
		}
	}

	.promo__button:hover {
		background-color: rgba(59, 108, 233, 0.18);
	}

	.promo__button:active {
		background-color: rgba(59, 108, 233, 0.32);
	}
}


.features {
	padding: 50px 0;

	@media (min-width: 1200px) {
		background-image: url('../../../img/features-background.png');
		background-repeat: no-repeat;
		background-position: top 100px right 60px;
		background-size: 30%;
	}


	.features__top {
		min-height: 370px;
		@media (min-width: 1200px) {
			padding-right: 400px;
		}
	}

	.features__title {
		font-family: 'Raleway', sans-serif;
		font-size: 32px;
		font-weight: 400;
		line-height: 58px;
		letter-spacing: 0.05em;
		text-align: center;
	}

	.features__description {
		font-family: Raleway, sans-serif;
		font-size: 20px;
		font-weight: 300;
		line-height: 38px;
		letter-spacing: 0.025em;
		text-align: left;
	}

	.features__subtitle {
		font-family: 'Raleway', sans-serif;
		font-size: 25px;
		font-weight: 400;
		line-height: 47px;
		letter-spacing: 0.05em;
		text-align: center;
		padding-bottom: 30px;
	}

	.features__list {
		display: flex;
		flex-direction: column;
		align-items: center;
		padding: 0;

		@media (min-width: 500px) {
			display: grid;
			grid-template-columns: repeat(2, 1fr);
			grid-column-gap: 10px;
			grid-row-gap: 1em;
		}

		@media (min-width: 992px) {
			grid-template-columns: repeat(3, 1fr);
		}

		@media (min-width: 1200px) {
			grid-template-columns: repeat(5, 1fr);
		}
	}

	.features__list-item {
		text-align: center;
		width: 170px;
		font-family: Raleway, sans-serif;
		font-size: 20px;
		font-weight: 300;
		line-height: 23px;
		letter-spacing: 0.025em;

		img {
			margin-bottom: 20px;
		}

		p {
			margin-bottom: 0;
		}
	}
}


</style>
