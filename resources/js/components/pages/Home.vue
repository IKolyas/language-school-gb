<template>
    <main class="home-page">
        <section class="promo">
			<div class="promo__inner container">
				<h1 class="promo__title, visually-hidden">Language school project</h1>
				<img src="../../../img/main-logo.png" width="555" alt="Language school project logotype" class="main-logo">
				<p class="promo__tagline">начни изучать иностранные языки уже сейчас!</p>
				<button class="promo__button promo__button_move-right" type="button">Попробовать!</button>
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
                <li class="features__list-item features__list-item_pulse">
                    <p>Разные способы запоминания</p>
                </li>
                <li class="features__list-item features__list-item_book">
                    <p>Словари на все случаи</p>
                </li>
                <li class="features__list-item features__list-item_hat">
                    <p>Много школ и преподавателей</p>
                </li>
                <li class="features__list-item features__list-item_thumbs-up">
                    <p>Разнообразный и богатый опыт</p>
                </li>
                <li class="features__list-item features__list-item_gear">
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
		background: url('../../../img/promo-background.png')no-repeat right 120px bottom/60%;
		position: relative;
		padding: 50px;
	}

	.promo__features-link {
		display: block;
		position: absolute;
		content: '';
		width: 80px;
		height: 80px;
		padding: 20px;
		bottom: 15px;
		left: 45%;
		background: url("../../../img/icons/four-arrows-down-icon.png") no-repeat center center;
		background-size: 80%;
		transition: 0.2s;
	}

	.promo__features-link:hover {
		background-size: 100%
	}

	.promo__tagline {
		font-family: Raleway, sans-serif;
		font-size: 30px;
		font-weight: 400;
		letter-spacing: 0.025em;
		text-align: center;
		width: 500px;
	}

	.promo__button {
		width: 270px;
		height: 50px;
		border: 1px solid #043FD6;
		border-radius: 5px;
		font-family: Raleway, sans-serif;
		font-size: 20px;
		font-weight: 300;
		line-height: 23px;
		letter-spacing: 0.21em;
		text-align: center;
		animation: background-animation 3s infinite linear;
		background: linear-gradient(90deg, rgba(202, 230, 246, 0.27) 0%, rgba(162, 117, 249, 0.53) 50%, rgba(202, 230, 246, 0.27) 100%);
		background-position: 0 0;
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

	.promo__button_move-right {
		margin-left: 110px;
	}
}

</style>
