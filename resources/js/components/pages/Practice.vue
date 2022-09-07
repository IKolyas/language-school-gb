<template>
    <main class="practice-page">
        <AppLoader v-if="loading"/>
        <div class="practice-page__wrap" v-else>
            <h2 class="practice-page__heading">Время практиковаться со&nbsp;словарём!</h2>
            <p class="practice-page__dictionary-name">{{ dictionaryName }}</p>

            <button
                class="practice-page__start-button"
                v-if="!isPractice && !isFinished"
                @click="onStartedPractice"
            >Начать тренировку
            </button>

            <div v-if="isPractice || isFinished" class="practice-page__practice practice">
                <div class="practice__score" v-if="isPractice">
                    <p>{{ currentTask.rating }} / 5</p>
                </div>
                <p class="practice__question" v-if="isPractice">Выберите верный вариант:</p>

                <VTask
                    v-if="isPractice"
                    @onAnswerClick="onAnswerClick"
                />
                <FinishedTasks v-else-if="isFinished"/>
                <div
                    v-if="isPractice"
                    class="practice__controls"
                >
                    <button
                        v-if="!hasCheckAnswer"
                        class="practice-controls__button practice-controls__button_check"
                        :class="{'disabled': !isActiveAnswer}"
                        @click="onCheckAnswer(currentTask)"
                    >
                        Проверить
                    </button>
                    <button
                        v-else
                        class="practice-controls__button practice-controls__button_continue"
                        @click="onNextTask"
                    >
                        Продолжить
                    </button>
                    <button
                        class="practice-controls__button practice-controls__button_finish"
                        @click="onFinishedTask"
                    >
                        Закончить тренировку
                    </button>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import {onBeforeMount, onMounted, provide, ref, computed} from 'vue';
import {collectQuestions} from '../../use/practice/useCollectAnswers';
import VTask from '../partials/practice/VTask';
import AppLoader from "../partials/AppLoader";
import FinishedTasks from '../partials/practice/FinishedTasks';
import {useRoute} from 'vue-router';
import {useStore} from "vuex";

const testDictionary = {
    dictionary_name: 'тестовый словарь',
    author: 'author_name',
    dictionary_description: 'desc',
    created_at: '03-07-2022',
    words: [
        {
            id: 1,
            word: 'слово',
            translation: 'word',
            rating: 4,
        },
        {
            id: 2,
            word: 'символ',
            translation: 'symbol',
            rating: 4,
        },
        {
            id: 3,
            word: 'число',
            translation: 'number',
            rating: 4,
        },

        {
            id: 4,
            word: 'мир',
            translation: 'world',
            rating: 0,
        },
        {
            id: 5,
            word: 'голубь',
            translation: 'pigeon',
            rating: 0,
        },
        {
            id: 6,
            word: 'звезда',
            translation: 'star',
            rating: 0,
        },
        {
            id: 7,
            word: 'земля',
            translation: 'ground',
            rating: 0,
        },
        {
            id: 8,
            word: 'море',
            translation: 'sea',
            rating: 0,
        },
    ],
};

export default {
    name: 'Practice',

    setup() {
        const store = useStore();
        const userId = computed(() => store.getters['user/id']);
        let loading = ref(true);
        const route = useRoute();
        const dictionaryId = ref(undefined);

        onBeforeMount(async () => {
            dictionaryId.value = +route.params.dictionaryId;
        });

        const currentDictionary = ref({});
        const dictionaryName = ref('');
        const isPracticeTest = ref(false);
        let tasks = [];

        let unlearnedWords = [];
        let learnedWords = [];
        let wordsInStudies = ref([]);
        const repeatsCount = ref(5);
        const numberSuccessAnswer = 5;

        const count = ref(0);
        const successCount = ref(0);
        const finishResults = ref(null);

        const isFinished = ref(false);
        const isPractice = ref(false);

        const currentTask = ref(null);
        const isActiveAnswer = ref(null);
        const hasCheckAnswer = ref(false);
        const hasRightAnswer = ref(false);

        const fillStudiedWord = array => {
            unlearnedWords = [...array].filter(item => item.rating < numberSuccessAnswer);

            if (repeatsCount.value > unlearnedWords.length) {
                repeatsCount.value = unlearnedWords.length;
            }

            for (let i = 0; i < repeatsCount.value; i++) {
                wordsInStudies.value.push(unlearnedWords.shift());
            }
        };

        onMounted(() => {
            if (!dictionaryId.value) {
                isPracticeTest.value = true;
            }

            if (!isPracticeTest.value) {
                store.dispatch("dictionaries/fetchDictionaryWithRating", {
                    dictionary_id: dictionaryId.value,
                    user_id: userId.value
                })
                currentDictionary.value = store.getters['dictionaries/dictionary'];
                loading.value = false;
            } else {
                currentDictionary.value = testDictionary;
                loading.value = false;
            }

            dictionaryName.value = currentDictionary.value.dictionary_name;

            tasks = [...currentDictionary.value.words];
        });

        const onStartedPractice = () => {
            count.value = 0;
            successCount.value = 0;
            isPractice.value = true;
            wordsInStudies.value.length = 0;
            fillStudiedWord(currentDictionary.value.words);
            onNextTask();
        };

        const onNextTask = () => {
            if (wordsInStudies.value.length === 0) {
                return onFinishedTask();
            }

            resetValues();
            currentTask.value = wordsInStudies.value.shift();
            currentTask.value = collectQuestions(tasks, currentTask.value);
        };

        const onAnswerClick = word => isActiveAnswer.value = word;

        const onCheckAnswer = (task) => {
            if (task.rating === 1 || task.rating === 3) {
                let tempWord = task.word
                task = {
                    id: task.id,
                    word: task.translation,
                    translation: tempWord,
                    rating: task.rating,
                }
            }
            const answer = isActiveAnswer.value.toLowerCase().trim();
            const translation = currentTask.value.translation.toLowerCase().trim();

            if (answer === translation) {
                task.rating++;
                successCount.value++;
                hasRightAnswer.value = true;
            } else {
                task.rating = 0;
                hasRightAnswer.value = false;
            }

            if (task.rating < numberSuccessAnswer) {
                wordsInStudies.value.push(task);
            } else {
                learnedWords.push(task);
                if (unlearnedWords.lenght) {
                    wordsInStudies.value.push(unlearnedWords.shift());
                }
            }

            hasCheckAnswer.value = true;
            count.value++;
        };

        const onFinishedTask = () => {

            const words = [
                ...learnedWords,
                ...wordsInStudies.value,
            ];

            finishResults.value = words;
            isPractice.value = false;
            isFinished.value = true;

            if (!isPracticeTest.value) {
                store.dispatch('dictionaries/updateDictionaryRating',
                    {words: words, user_id: userId.value, dictionary_id: dictionaryId.value});
                store.dispatch('statistics/saveStatistics', {user_id: userId.value});
            }
        };

        const resetValues = () => {
            hasRightAnswer.value = false;
            hasCheckAnswer.value = false;
            isActiveAnswer.value = null;
            currentTask.value = null;
        };

        provide('task', currentTask);
        provide('isActiveAnswer', isActiveAnswer);
        provide('hasRightAnswer', hasRightAnswer);
        provide('hasCheckAnswer', hasCheckAnswer);
        provide('count', count);
        provide('successCount', successCount);
        provide('finishResults', finishResults);

        return {
            loading,
            currentTask,
            isPractice,
            isFinished,
            isActiveAnswer,
            hasCheckAnswer,
            hasRightAnswer,
            count,
            dictionaryName: computed(() => dictionaryName.value.charAt(0).toUpperCase() + dictionaryName.value.slice(1)),
            onNextTask,
            onStartedPractice,
            onFinishedTask,
            onAnswerClick,
            onCheckAnswer,
        };
    },
    components: {
        AppLoader,
        FinishedTasks,
        VTask,
    },
};
</script>

<style lang="scss">
.practice-page {
	text-align: center;

	@media (min-width: 1200px) {
		background-image: url("../../../img/practice-page-background.png");
		background-repeat: no-repeat;
		background-position: center bottom;
		padding: 10px 80px 270px;
	}

	.practice-page__wrap {
		padding-top: 10%;
		padding-bottom: 10%;
	}

	.practice-page__heading {
		font-size: 30px;
		font-weight: 400;
		color: #3B6CE9;
		margin-bottom: 50px;
		@media (min-width: 768px) {
			font-size: 50px;
		}
	}

	.practice-page__dictionary-name {
		font-family: Sacramento, cursive;
		font-size: 20px;
		font-weight: 400;
		@media (min-width: 768px) {
			font-size: 40px;
		}
	}

	.practice-page__start-button {
		max-height: 74px;
		max-width: 320px;
		width: 100%;
		border-radius: 10px;
		border: 2px solid #3B6CE9;
		padding: 10px 30px 14px;
		font-size: 16px;
		font-weight: 400;
		background: #FFF;
		color: #3B6CE9;
		margin-bottom: 30px;
		white-space: nowrap;

		@media (min-width: 768px) {
			font-size: 36px;
			max-width: 395px;
		}
	}

	.practice {
		box-shadow: 0 5px 5px 5px #3B6CE973;
		padding: 50px;
		border-radius: 10px;
		position: relative;
	}

	.practice__question {
		font-family: Raleway, sans-serif;
		font-size: 36px;
		font-weight: 300;
	}

	.practice__score {
		position: absolute;
		top: 10px;
		right: 10px;
		font-family: Raleway, sans-serif;
		font-size: 36px;
		font-weight: 700;
		color: #3B6CE9;
	}

	.current-word {
		position: relative;
	}

	.current-word__word {
		font-family: Raleway, sans-serif;
		font-size: 36px;
		font-weight: 700;
		color: #3B6CE9;
	}

	.current-word__voice-option {
		position: absolute;
		top: 0;
		right: 10px;
		width: 200px;
	}

	.voice-action {
		margin-left: 10px;
	}

	.answers-list {
		display: flex;
		justify-content: space-around;
		padding: 30px;
		margin-bottom: 0;
	}

	.answer-list__answer-item {
		border: 3px solid #3B6CE9;
		border-radius: 10px;
		padding: 8px 52px;
		color: #3B6CE9;
		font-family: Source Sans Pro, sans-serif;
		font-size: 36px;
		font-weight: 400;
	}

	.answer-list__answer-item.active {
		color: white;
		background-color: #3B6CE9;
	}

	.answer-list__answer-item:hover {
		color: white;
		background-color: #3B6CE9;
	}

	.task-area__result {
		height: 50px;
		font-family: Source Sans Pro, sans-serif;
		font-size: 30px;
		font-weight: 400;
	}

	.task-area__success {
		color: green;
	}

	.task-area__mistake {
		color: red;
	}

	.practice__controls {
		display: flex;
		justify-content: space-around;
		padding: 0 250px;
	}

	.practice-controls__button {
		font-family: Source Sans Pro, sans-serif;
		font-size: 24px;
		font-weight: 400;
		border-radius: 10px;
		border: 3px solid #256C39;
		color: #256C39;
		padding: 8px 15px;
		background-color: #FFF;
	}

	.practice-controls__button_finish {
		color: #CA0000;
		border-color: #CA0000;
	}

	.practice-controls__button.disabled, .practice-controls__button:disabled {
		color: gray;
		border-color: gray;
	}

	.practice-result {
		font-family: Source Sans Pro, sans-serif;
		font-size: 36px;
		font-weight: 400;
	}
}

</style>
