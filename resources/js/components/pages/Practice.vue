<template>
	<div>
		<AppLoader v-if="loading"/>
		<div v-else>
			<h2 class="h2 mb-3">{{`Время практиковаться со словарём ${dictionaryName}!`}}</h2>

			<button
				v-if="!isPractice"
				class="btn btn-outline-info mb-3"
				@click="onStartedPractice"
			>Начать тренировку
			</button>

			<div v-if="isPractice || isFinished" class="border p-3 mb-3 pos-r">
				<div class="score">
					<p>{{currentTask.successCounter}} / 5</p>
				</div>

				<VTask
					v-if="isPractice"
					@onAnswerClick="onAnswerClick"
				/>
				<FinishedTasks v-else-if="isFinished"/>
			</div>

			<div
				v-if="isPractice"
				class="d-flex justify-content-center"
			>
				<button
					v-if="!hasCheckAnswer"
					class="btn btn-outline-info"
					:class="{'disabled': !isActiveAnswer}"
					@click="onCheckAnswer(currentTask)"
				>
					Проверить
				</button>
				<button
					v-else
					class="btn btn-outline-info"
					@click="onNextTask"
				>
					Продолжить
				</button>
				<button
					class="btn btn-outline-info ms-3"
					@click="onFinishedTask"
				>
					Закончить тренировку
				</button>
			</div>
		</div>
	</div>
</template>

<script>
import {onBeforeMount, onMounted, provide, ref} from 'vue';
import {getDictionaryOne} from '../../services/dictionary.service';
import {updateUserTask} from '../../services/auth.service';
import {collectQuestions} from '../../use/practice/useCollectAnswers';
import VTask from '../partials/practice/VTask';
import FinishedTasks from '../partials/practice/FinishedTasks';
import {useRoute} from 'vue-router';

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
            // answers: ['word', 'words', 'would', 'write']
        },
        {
            id: 2,
            word: 'символ',
            translation: 'symbol',
            // answers: ['word', 'words', 'symbol', 'write']
        },
        {
            id: 3,
            word: 'число',
            translation: 'number',
            // answers: ['word', 'words', 'would', 'number']
        },
    ],
};

export default {
    name: 'Practice',

    setup() {
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
        const numberSuccessAnswer = 3;

        const count = ref(0);
        const successCount = ref(0);
        const maxCount = 10;
        const finishResults = ref(null);

        const isFinished = ref(false);
        const isPractice = ref(false);

        const currentTask = ref(null);
        const isActiveAnswer = ref(null);
        const hasCheckAnswer = ref(false);
        const hasRightAnswer = ref(false);

        const fillStudiedWord = array => {
            unlearnedWords = [...array].filter(item => item.successCounter < numberSuccessAnswer);

            if (repeatsCount.value > unlearnedWords.length) {
                repeatsCount.value = unlearnedWords.length;
            }

            for (let i = 0; i < repeatsCount.value; i++) {
                wordsInStudies.value.push(unlearnedWords[i]);
            }
        };

        onMounted(async () => {
            if (!dictionaryId.value) {
                isPracticeTest.value = true;
            }

            if (!isPracticeTest.value) {
                try {
                    const {data} = await getDictionaryOne(dictionaryId.value);
                    currentDictionary.value = data;
                }
                catch (e) {
                    console.error(e);
                } finally {
                    loading.value = false;
                }

            } else {
                currentDictionary.value = testDictionary;
                loading.value = false;
            }

            // const { data } = await getDictionaryOne(props.dictionaryId.value)

            dictionaryName.value = currentDictionary.value.dictionary_name;
            tasks = [...currentDictionary.value.words].map(task => {
                if (!task.successCounter) {
                    return {
                        ...task,
                        successCounter: 0,
                    };
                }
                return task;
            });
        });

        const onNextTask = () => {
            if (count.value === maxCount || wordsInStudies.value.length === 0) {
                return onFinishedTask();
            }

            resetValues();
            currentTask.value = wordsInStudies.value.shift();
            currentTask.value = collectQuestions(tasks, currentTask.value);
            return currentTask.value;
        };

        const onStartedPractice = () => {
            count.value = 0;
            isPractice.value = true;
            wordsInStudies.value.length = 0;
            fillStudiedWord(tasks);
            onNextTask();
        };

        const onFinishedTask = () => {
            const words = {
                ...learnedWords,
                ...unlearnedWords,
            };

            finishResults.value = words;
            isPractice.value = false;
            isFinished.value = true;

            if (!isPracticeTest.value) {
                const userId = 3;

                console.log('id', dictionaryId.value);

                const postData = {
                    ...currentDictionary.value,
                    words,
                }
                console.log('postData', postData);

                try {
                    updateUserTask(userId, dictionaryId.value, postData)
                }
                catch (e) {
                    console.log('error', e);
                }
            }
        };

        const onAnswerClick = word => isActiveAnswer.value = word;

        const onCheckAnswer = (task) => {
            const answer = isActiveAnswer.value.toLowerCase().trim();
            const translation = currentTask.value.translation.toLowerCase().trim();

            if (answer === translation) {
                task.successCounter++;
                successCount.value++;
                hasRightAnswer.value = true;
            } else {
                task.successCounter = 0;
                hasRightAnswer.value = false;
            }

            if (task.successCounter < numberSuccessAnswer) {
                wordsInStudies.value.push(task);
            } else {
                learnedWords.push(task);
                unlearnedWords = unlearnedWords.filter(t => t.id !== task.id);
            }
            hasCheckAnswer.value = true;
            count.value++;
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
        FinishedTasks,
        VTask,
    },
};
</script>

<style lang="scss">
.btn-outline-info.disabled, .btn-outline-info:disabled {
  color: gray;
  border-color: gray;
}

.pos-r {
  position: relative;
}
.score {
  position: absolute;
  right: 20px;
}
</style>
