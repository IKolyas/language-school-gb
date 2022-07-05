<template>
<!--   	<h2 class="h2 mb-3" v-if="!dictionaryId">Практика!</h2>-->
    <h2 class="h2 mb-3">{{`Время практиковаться со словарём ${dictionaryName}!`}}</h2>

	<button
		v-if="!isPractice"
		class="btn btn-outline-info mb-3"
		@click="onStartedPractice"
	>Начать тренировку
	</button>

	<div v-if="isPractice || isFinished" class="border p-3 mb-3">
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
</template>

<script>
import { onMounted, onUnmounted, provide, ref } from 'vue';
import {getDictionaryOne} from '../../services/dictionary.service';
import {updateUser, updateUserTask} from '../../services/auth.service';
import {randomIncorrectAnswers} from '../../use/practice/useCollectAnswers';
import VTask from '../partials/practice/VTask';
import FinishedTasks from '../partials/practice/FinishedTasks';

const testDictionary = {
    dictionary_name: 'тестовый словарь',
    author: 'author_name',
    dictionary_description: 'desc',
    created_at: '03-07-2022',
    words:[
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
        }
    ]
}

export default {
    name: 'Practice',
	props: ['dictionaryId'],

	setup (props) {
		const currentDictionary = ref({})
        const dictionaryName = ref('')
        const isPracticeTest = ref(false)
		let tasks = []

		let unlearnedWords = []
		let learnedWords = []
		let wordsInStudies = ref([])
		const repeatsCount = ref(5)
		const numberSuccessAnswer = 3

        const count = ref(0)
        const successCount = ref(0)
        const maxCount = 20
		const finishResults = ref(null)

        const isFinished = ref(false)
        const isPractice = ref(false)

        const currentTask = ref(null)
        const isActiveAnswer = ref(null)
        const hasCheckAnswer = ref(false)
        const hasRightAnswer = ref(false)

        const fillStudiedWord = array => {
            unlearnedWords = [...array].filter(item =>  item.successCounter < numberSuccessAnswer)

            if (repeatsCount.value > unlearnedWords.length) {
                repeatsCount.value = unlearnedWords.length
            }

            for(let i = 0; i < repeatsCount.value; i++) {
                wordsInStudies.value.push(unlearnedWords[i])
            }
        }

        onMounted(async () => {
			if (props?.dictionaryId !== undefined) {
				isPracticeTest.value = true
			}

			if (isPracticeTest.value) {
				const { data } = await getDictionaryOne(props.dictionaryId)
                currentDictionary.value = data
			} else {
                currentDictionary.value = testDictionary
			}

            dictionaryName.value = currentDictionary.value.dictionary_name
            tasks = [...currentDictionary.value.words]

			// const { data } = await getDictionaryOne(props.dictionaryId)

			const translateWords = []

			for (let task of tasks) {
				translateWords.push(task.translation)
			}

			tasks = tasks.map(task => {
				const answers = randomIncorrectAnswers(translateWords, task.translation, 5)
				task = {
					...task,
					successCounter: 0,
					answers: answers
				}
				return task
			})
		})

		onUnmounted(() => {
            resetValues()
            currentDictionary.value = null
            dictionaryName.value = ''
            tasks = []
            unlearnedWords = []
            learnedWords = []
            wordsInStudies.value = []
            count.value = 0
		})

		const onNextTask = () => {
            if (count.value === maxCount) {
                onFinishedTask()
			}

            resetValues()
            currentTask.value = wordsInStudies.value.shift()
		}

		const onStartedPractice = () => {
			count.value = 0
			isPractice.value = true
            wordsInStudies.value.length = 0
            fillStudiedWord(tasks)
            onNextTask()
		}

		const onFinishedTask = () => {
            resetValues()

            const results = {
                learnedWords,
                unlearnedWords
            }

            const postData = {
                ...results,
                ...currentDictionary.value
            }

            console.log('postData', postData);

            const idUser = 3

            finishResults.value = results
            isPractice.value = false
            isFinished.value = true

            try {
                updateUserTask(idUser, postData)
            } catch (e) {
                console.log('error', e);
            }
        }

		const onAnswerClick = word => isActiveAnswer.value = word

		const onCheckAnswer = (task) => {
			const answer = isActiveAnswer.value.toLowerCase().trim()
			const translation = currentTask.value.translation.toLowerCase().trim()

			if (answer === translation) {
				task.successCounter++
                successCount.value++
				hasRightAnswer.value = true
			} else {
				task.successCounter = 0
				hasRightAnswer.value = false
			}

			if (task.successCounter < numberSuccessAnswer) {
                wordsInStudies.value.push(task)
			} else {
                learnedWords.push(task)
                unlearnedWords = unlearnedWords.filter(t => t.id !== task.id )
			}
			hasCheckAnswer.value = true
            count.value++
		}

		const resetValues = () => {
			hasRightAnswer.value = false
			hasCheckAnswer.value = false
			isActiveAnswer.value = null
            currentTask.value = null
		}

		provide('task', currentTask)
		provide('isActiveAnswer', isActiveAnswer)
		provide('hasRightAnswer', hasRightAnswer)
		provide('hasCheckAnswer', hasCheckAnswer)
		provide('count', count)
		provide('successCount', successCount)
		provide('finishResults', finishResults)

		return {
			currentTask,
			// isTaskFinished,
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
		}
	},
	components: {
		FinishedTasks,
		VTask,
	},
}
</script>

<style lang="scss">
.btn-outline-info.disabled, .btn-outline-info:disabled {
  color: gray;
  border-color: gray;
}
</style>
