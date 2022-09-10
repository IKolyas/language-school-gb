<template>
    <section class="achievements-page container">
        <h2 class="visually-hidden">Достижения</h2>
        <ul class="achievements-page__top bottom-marked">
            <li class="achievements-page__top-item">
                <p class="achievements-page__top-text">Дата начала занятий:</p>
                <span class="achievements-page__top-date">{{ startDay }}</span>
            </li>
            <li class="achievements-page__top-item">
                <p class="achievements-page__top-text">Последний раз занимался:</p>
                <span class="achievements-page__top-date">{{ lastTrainingDay }}</span>
            </li>
        </ul>
        <ul class="achievements-page__achievements-list achievements-list">
            <li class="achievements-list__item achievement-card achievement-card_training-days achievement-card_green-shadow">
                <p class="achievement-card__text">
                    Занимаешься <span class="achievement-card__number">{{ trainingDays }}</span> дней
                </p>
            </li>
            <li class="achievements-list__item achievement-card achievement-card_training-days-strike achievement-card_green-shadow">
                <p class="achievement-card__text">
                    Занимаешься <span class="achievement-card__number">{{ trainingDaysStrike }}</span> дней подряд
                </p>
            </li>
            <li class="achievements-list__item achievement-card achievement-card_max-training-days-strike achievement-card_green-shadow">
                <p class="achievement-card__text">
                    Максимально <span class="achievement-card__number">{{ maxTrainingDaysStrike }}</span> дней подряд
                </p>
            </li>
            <li class="achievements-list__item achievement-card achievement-card_user-words-total-count achievement-card_yellow-shadow">
                <p class="achievement-card__text">
                    В твоих словарях <span class="achievement-card__number">{{ userWordsTotalCount }}</span> слов
                </p>
            </li>
            <li class="achievements-list__item achievement-card achievement-card_user-words-in-progress-count achievement-card_yellow-shadow">
                <p class="achievement-card__text">
                    В процессе изучения <span class="achievement-card__number">{{ userWordsInProgressCount }}</span>
                    слов
                </p>
            </li>
            <li class="achievements-list__item achievement-card achievement-card_user-words-learned-count achievement-card_yellow-shadow">
                <p class="achievement-card__text">
                    Изучено <span class="achievement-card__number">{{ userWordsLearnedCount }}</span> слов
                </p>
            </li>
        </ul>
    </section>
</template>

<script>
import {mapState} from "vuex";

export default {
    name: "AccountAchievements",
    computed: {
        ...mapState({
            statistics: state => state.statistics.statistics,
            trainingDays: state => state.statistics.statistics.training_days,
            trainingDaysStrike: state => state.statistics.statistics.training_days_strike,
            maxTrainingDaysStrike: state => state.statistics.statistics.max_training_days_strike,
            startDay: state => state.statistics.statistics.created_at,
            lastTrainingDay: state => state.statistics.statistics.updated_at,
            userWords: state => state.user.userWords,
            userId: state => state.user.id,
        }),
        strike() {

        },
        userWordsTotalCount() {
            return this.userWords.length
        },
        userWordsInProgressCount() {
            const wordsInProgress = this.userWords.filter(word => word.rating > 0 && word.rating < 5);
            return wordsInProgress.length;
        },
        userWordsLearnedCount() {
            const wordsLearned = this.userWords.filter(word => word.rating >= 5);
            return wordsLearned.length;
        },
    },
    mounted() {
        this.$store.dispatch('statistics/fetchStatistics', {user_id: this.userId});
        this.$store.dispatch('user/fetchUsersWords', {user_id: this.userId});
    },
    methods: {
        updateStatistics() {
            this.$store.dispatch('statistics/saveStatistics', {user_id: this.userId});
        }
    }
}
</script>

<style scoped>

</style>
