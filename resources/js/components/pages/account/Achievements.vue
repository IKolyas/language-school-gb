<template>
    <button class="btn btn-primary" @click="updateStatistics">Нажать когда закончил тренировку</button>
    <!--    TODO этот метод надо вызывать когда заклнчил тренировку-->
    <h2 class="my-4">Достижения</h2>
    <p>Начал заниматься {{ startDay }}</p>
    <p>Последний раз занимался {{ lastTrainingDay }}</p>
    <ul class="nav nav-pills d-flex flex-wrap justify-content-between achivement-list">
        <li class="nav-item">
            <div class="card bg-info" style="width: 180px">
                <div class="card-body text-center">
                    <p class="card-text">занимаешься</p>
                    <h3 class="card-title">{{ trainingDays }}</h3>
                    <p class="card-text">дня</p>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <div class="card bg-info" style="width: 180px">
                <div class="card-body text-center">
                    <p class="card-text">занимаешься</p>
                    <h3 class="card-title">{{ trainingDaysStrike }}</h3>
                    <p class="card-text">дней подряд</p>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <div class="card bg-info" style="width: 180px">
                <div class="card-body text-center">
                    <p class="card-text">максимально</p>
                    <h3 class="card-title">{{ maxTrainingDaysStrike }}</h3>
                    <p class="card-text"> дней подряд</p>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <div class="card bg-success" style="width: 180px">
                <div class="card-body text-center">
                    <p class="card-text">В твоих словарях</p>
                    <h3 class="card-title">{{ userWordsTotalCount }}</h3>
                    <p class="card-text">слов</p>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <div class="card bg-success" style="width: 180px">
                <div class="card-body text-center">
                    <p class="card-text">В процессе изучения</p>
                    <h3 class="card-title">{{ userWordsInProgressCount }}</h3>
                    <p class="card-text">слов</p>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <div class="card bg-warning" style="width: 180px">
                <div class="card-body text-center">
                    <p class="card-text">Изучено</p>
                    <h3 class="card-title">{{userWordsLearnedCount}}</h3>
                    <p class="card-text">слов</p>
                </div>
            </div>
        </li>
    </ul>
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
            const wordsLearned = this.userWords.filter(word => word.rating === 5);
            return wordsLearned.length;
        },
    },
    mounted() {
        this.$store.dispatch('statistics/fetchStatistics', {user_id: 3});
        this.$store.dispatch('user/fetchUsersWords', {user_id: 3});
    },
    methods: {
        updateStatistics() {
            this.$store.dispatch('statistics/saveStatistics', {user_id: 3});
        }
    }
}
</script>

<style scoped>

</style>
