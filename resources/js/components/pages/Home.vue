<template>
    <!--    <div>-->
    <!--        <h1>Главная</h1>-->
    <!--        Здесь будет рассказано про сайт, предложено попробовать как он работает без регистрации и смс, а пока лучше посмотрить на<br>-->
    <!--        <router-link to="practiceTest">Практика</router-link><br>-->
    <!--        <router-link :to="{name: 'account'}">Аккаунт</router-link>-->

    <!--    </div>-->
    <main>
        <section class="promo">
            <h1 class="promo__title, visually-hidden">Language school project</h1>
            <img src="" alt="Language school project logotype" class="promo-logo">
            <p class="promo__tagline">начни изучать иностранные языки уже сейчас!</p>
            <button class="promo__button" type="button">Начать занятия</button>
        </section>
        <section class="features">
            <h2 class="features__title">Уникальная платформа для изучения иностранных слов!</h2>
            <p class="features__description">
                С другой стороны дальнейшее развитие различных форм деятельности требуют от нас анализа
                соответствующий
                условий активизации. Разнообразный и богатый опыт укрепление и развитие структуры обеспечивает
                широкому
                кругу (специалистов) участие в формировании форм развития.
            </p>
            <h3 class="features__subtitle">
                В чем особенности обучения?
            </h3>
            <ul class="features__list">
                <li class="features__list-item">Разнообразный и богатый опыт</li>
                <li class="features__list-item">Разнообразный и богатый опыт</li>
                <li class="features__list-item">Разнообразный и богатый опыт</li>
                <li class="features__list-item">Разнообразный и богатый опыт</li>
                <li class="features__list-item">Разнообразный и богатый опыт</li>
            </ul>
        </section>
    </main>
    <footer class="main-footer">
        <img src="" alt="" class="footer-logo">
        <ul class="navigation">
            <li class="navigation__item">Практика</li>
            <li class="navigation__item">Мои достижения</li>
            <li class="navigation__item">Словари</li>
            <li class="navigation__item">Политика конфидециальности</li>
        </ul>
        <ul class="contacts">
            <li class="contacts__item">
                <button class="main-footer__button" type="button">Заказать звонок</button>
            </li>
            <li class="contacts__item">
                <span class="contacts__phone">+7 (971) 999-99-99</span>
            </li>
            <li class="contacts__item">hi@sitename.ru</li>
            <li class="contacts__item">Адрес</li>
            <li class="contacts__item">Режим работы</li>
        </ul>
    </footer>
</template>

<script>
export default {
    name: "Home"
}
</script>

<style scoped>

</style>
