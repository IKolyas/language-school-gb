<template>
    <main class="home-page">
        <section class="promo">
            <h1 class="promo__title, visually-hidden">Language school project</h1>
            <img src="../../../img/main-logo.png" width="555" alt="Language school project logotype" class="main-logo">
            <p class="promo__tagline">начни изучать иностранные языки уже сейчас!</p>
            <button class="promo__button promo__button_move-right" type="button">Попробовать!</button>
            <a href="#features" class="promo__features-link"></a>
        </section>
        <section class="features" id="features">
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

<style scoped>

</style>
