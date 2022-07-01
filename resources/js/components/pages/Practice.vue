<template>
   	<h2 class="h2 mb-3" v-if="!dictionaryId">Практика!</h2>
    <h2 class="h2 mb-3" v-else>Время практиковаться со словарём {{dictionaryId}}!</h2>

	<button
		v-if="!isPractice || isTaskFinished"
		class="btn btn-outline-info mb-3"
		@click="onStartedPractice"
	>Начать тренировку
	</button>

	<div
		v-if="isPractice"
		class="border p-3 mb-3"
	>
		<VTask
			v-if="isPractice && !isTaskFinished"
			@onAnswerClick="onAnswerClick"
		/>
		<FinishedTasks
			v-else-if="isTaskFinished"
		/>
	</div>

	<div
		v-if="isPractice && !isTaskFinished"
		class="d-flex justify-content-center"
	>
		<button
			v-if="!hasCheckAnswer"
			class="btn btn-outline-info"
			:class="{'disabled': !isActiveAnswer}"
			@click="onCheckAnswer"
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
	</div>
</template>

<script>
import VTask from '../partials/practice/VTask';
import {computed, onMounted, provide, ref} from 'vue';
import FinishedTasks from '../partials/practice/FinishedTasks';
import {getDictionaryOne} from '../../services/dictionary.service';
import {randomIncorrectAnswers} from '../../use/practice/useCollectAnswers';

export default {
    name: 'Practice',
	props: ['dictionaryId', 'dictionaries'],

	setup (props) {
		const isPracticeTest = ref(false)
		let tasks = ref([
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
		])
		// const wordsFromDictionaries = [
		// 	'word',
		// 	'base',
		// 	'please',
		// 	'friend',
		// 	'table',
		// 	'lamp',
		// 	'hand',
		// ]

		onMounted(async () => {
			if (props?.dictionaryId !== undefined) {
				isPracticeTest.value = true
			}

			if (isPracticeTest.value) {
				const { data } = await getDictionaryOne(props.dictionaryId)
				tasks.value = data.words
			}

			const translateWords = ref([])

			for (let task of tasks.value) {
				translateWords.value.push(task.translation)
			}

			tasks.value = tasks.value.map(task => {
				const answers = randomIncorrectAnswers(translateWords.value, task.translation, 5)
				task.value = {...task, answers: answers.value}
				return task.value
			})

			console.log('tasks.value', tasks.value);
		})

		const results = ref([])
		const count = ref(0)

		const currentIndex = ref(0)
		const currentTask = ref({})
		const isFinished = ref(false)
		const isPractice = ref(false)

		const isActiveAnswer = ref(null)
		const hasCheckAnswer = ref(false)
		const hasRightAnswer = ref(false)

		const isTaskFinished = computed(() => {
			return currentIndex.value === tasks.value.length
		})

		const onNextTask = () => {
			if (isTaskFinished) {
				currentIndex.value += 1
				currentTask.value = tasks.value[currentIndex.value]
			} else {
				isFinished.value = true
				isPractice.value = false
			}

			resetValues()
		}

		const onStartedPractice = () => {
			count.value = 0
			currentIndex.value = 0
			isPractice.value = true
			currentTask.value = tasks.value[0]
			isFinished.value = !isFinished.value
		}

		const onAnswerClick = word => {
			isActiveAnswer.value = word
		}

		const onCheckAnswer = () => {
			const answer = isActiveAnswer.value.toLowerCase().trim()
			const translation = currentTask.value.translation.toLowerCase().trim()

			if (answer === translation) {
				results.value.push(
					{
						word: answer,
						hasRightAnswer: true
					}
				)
				hasRightAnswer.value = true
				count.value++
				console.log('Ответ правильный');
			} else {
				results.value.push(
					{
						word: answer,
						hasRightAnswer: false
					}
				)
				hasRightAnswer.value = false
				console.log('Неверный');
			}

			hasCheckAnswer.value = true
		}

		const resetValues = () => {
			hasRightAnswer.value = false
			hasCheckAnswer.value = false
			isActiveAnswer.value = null
		}

		provide('task', currentTask)
		provide('tasks', tasks)
		provide('isActiveAnswer', isActiveAnswer)
		provide('hasRightAnswer', hasRightAnswer)
		provide('hasCheckAnswer', hasCheckAnswer)
		provide('hasCheckAnswer', hasCheckAnswer)
		provide('count', count)

		return {
			tasks,
			currentTask,
			isTaskFinished,
			currentIndex,
			isPractice,
			isFinished,
			isActiveAnswer,
			hasCheckAnswer,
			hasRightAnswer,
			count,
			onNextTask,
			onStartedPractice,
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
