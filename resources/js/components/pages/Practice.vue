<template>
    <main class="practice-page">
        <AppLoader v-if="loading"/>
        <div v-else>
            <h2 class="practice-page__heading">Время практиковаться со словарём!</h2>
            <p class="practice-page__dictionary-name">'{{ dictionaryName }}'</p>

            <button
                class="practice-page__start-button"
                v-if="!isPractice"
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
import {getDictionaryWithRatings} from '../../services/dictionary.service';
import {updateUserTask} from '../../services/auth.service';
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
            // answers: ['word', 'words', 'would', 'write']
        },
        {
            id: 2,
            word: 'символ',
            translation: 'symbol',
            rating: 4,
            // answers: ['word', 'words', 'symbol', 'write']
        },
        {
            id: 3,
            word: 'число',
            translation: 'number',
            rating: 4,
            // answers: ['word', 'words', 'would', 'number']
        },

        {
            id: 4,
            word: 'мир',
            translation: 'world',
            rating: 0,
            // answers: ['word', 'words', 'would', 'write']
        },
        {
            id: 5,
            word: 'голубь',
            translation: 'pigeon',
            rating: 0,
            // answers: ['word', 'words', 'would', 'write']
        },
        {
            id: 6,
            word: 'звезда',
            translation: 'star',
            rating: 0,
            // answers: ['word', 'words', 'would', 'write']
        },
        {
            id: 7,
            word: 'земля',
            translation: 'ground',
            rating: 0,
            // answers: ['word', 'words', 'would', 'write']
        },
        {
            id: 8,
            word: 'море',
            translation: 'sea',
            rating: 0,
            // answers: ['word', 'words', 'would', 'write']
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
        // const maxCount = 10;
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
            console.log(unlearnedWords)

            for (let i = 0; i < repeatsCount.value; i++) {
                wordsInStudies.value.push(unlearnedWords.shift());
            }
            console.log('wordsInStudies', wordsInStudies.value);
        };

        onMounted(async () => {
            if (!dictionaryId.value) {
                isPracticeTest.value = true;
            }

            if (!isPracticeTest.value) {
                try {
                    const {data} = await getDictionaryWithRatings(dictionaryId.value, userId.value);
                    currentDictionary.value = data;
                } catch (e) {
                    console.error(e);
                } finally {
                    loading.value = false;
                }

            } else {
                currentDictionary.value = testDictionary;
                loading.value = false;
            }

            dictionaryName.value = currentDictionary.value.dictionary_name;

            tasks = [...currentDictionary.value.words];
        });

        const onStartedPractice = () => {
            count.value = 0;
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
            return currentTask.value;
        };

        const onAnswerClick = word => isActiveAnswer.value = word;

        const onCheckAnswer = (task) => {
            if (task.rating === 1 || task.rating === 3) {
                let tempWord = task.word
                task =  {
                    id: task.id,
                    word: task.translation,
                    translation: tempWord,
                    rating: task.rating,
                }
            }
            console.log('task', task)
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
                console.log('продолжаем изучать');
            } else {
                learnedWords.push(task);
                console.log('слово изучено');
                wordsInStudies.value.push(unlearnedWords.shift());
            }

            console.log('wordsInStudies', wordsInStudies.value)
            hasCheckAnswer.value = true;
            count.value++;
        };

        const onFinishedTask = () => {
            console.log('learnedWords', learnedWords);
            console.log('wordsInStudies', wordsInStudies.value);
            console.log('unlearnedWords', unlearnedWords);

            const words = {
                ...learnedWords,
                ...wordsInStudies.value,
                ...unlearnedWords,
            };


            console.log('words', words);

            finishResults.value = words;
            isPractice.value = false;
            isFinished.value = true;

            if (!isPracticeTest.value) {

                const postData = {
                    ...currentDictionary.value,
                    words,
                }

                try {
                    updateUserTask(userId, dictionaryId.value, postData)
                } catch (e) {
                    console.log('error', e);
                }
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
            dictionaryName,
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
</style>
