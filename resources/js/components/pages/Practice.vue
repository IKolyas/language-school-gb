<template>
	<h2 class="h2 mb-3">Практика!</h2>

	<button
		v-if="!isPractice || isTaskFinished"
		class="btn btn-outline-info mb-3"
		@click="onStartedPractice"
	>Начать тренировку
	</button>

	<div class="border p-3 mb-3">
		<VTask
			v-if="isPractice && !isTaskFinished"
			:task="currentTask"
			:isActiveAnswerId="isActiveAnswerId"
			:hasRightAnswer="hasRightAnswer"
			:hasCheckAnswer="hasCheckAnswer"
			@onAnswerClick="onAnswerClick"
		/>
		<FinishedTasks
			:tasks="tasks"
			:count="count"
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
			:class="{'disabled': !isActiveAnswerId}"
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
import VTask from '../partials/practice/VTask'
import {computed, ref} from 'vue'
import FinishedTasks from '../partials/practice/FinishedTasks'

export default {
    name: 'Practice',
	setup () {
		const results = ref([])
		const tasks = [
			{
				id: 1,
				wordBeingStudied: 'слово',
				rightAnswerId: 1,
				rightAnswer: 'word',
				answers: [{text: 'word', id: 1}, {text: 'words', id: 2}, {text: 'would', id: 3}, {text: 'write', id: 4}]
			},
			{
				id: 2,
				wordBeingStudied: 'символ',
				rightAnswerId: 2,
				rightAnswer: 'symbol',
				answers: [{text: 'word', id: 1}, {text: 'symbol', id: 2}, {text: 'would', id: 3}, {text: 'write', id: 4}]
			},
			{
				id: 3,
				wordBeingStudied: 'число',
				rightAnswerId: 4,
				rightAnswer: 'number',
				answers: [{text: 'word', id: 1}, {text: 'words', id: 2}, {text: 'would', id: 3}, {text: 'number', id: 4}]
			}
		]
		const count = ref(0)

		const currentIndex = ref(0)
		const currentTask = ref({})
		const isFinished = ref(false)
		const isPractice = ref(false)

		const isActiveAnswerId = ref(null)
		const hasCheckAnswer = ref(false)
		const hasRightAnswer = ref(false)

		const isTaskFinished = computed(() => {
			return currentIndex.value === tasks.length
		})

		const onNextTask = () => {
			if (isTaskFinished) {
				currentIndex.value += 1
				currentTask.value = tasks[currentIndex.value]
			} else {
				isFinished.value = true
				isPractice.value = false
			}

			resetValues()
		}

		const onStartedPractice = () => {
			currentIndex.value = 0
			isPractice.value = true
			currentTask.value = tasks[0]
			isFinished.value = !isFinished.value
		}

		const onAnswerClick = id => {
			isActiveAnswerId.value = id
		}

		const onCheckAnswer = () => {
			if (isActiveAnswerId.value === currentTask.value.rightAnswerId) {
				results.value.push(
					{
						id: isActiveAnswerId.value,
						hasRightAnswer: true
					}
				)
				hasRightAnswer.value = true
				count.value++
				console.log('Ответ правильный');
			} else {
				results.value.push(
					{
						id: isActiveAnswerId.value,
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
			isActiveAnswerId.value = null
		}

		return {
			tasks,
			currentTask,
			isTaskFinished,
			currentIndex,
			isPractice,
			isFinished,
			isActiveAnswerId,
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
	}
}
</script>

<style lang="scss">
.btn-outline-info.disabled, .btn-outline-info:disabled {
  color: gray;
  border-color: gray;
}
</style>
