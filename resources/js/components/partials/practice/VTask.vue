<template>
  	<p>Выберите верный вариант для {{ task.id }} задания</p>
	<p class="fs-2" :style="{color: 'green', fontWeight: 'bold'}">{{ task.wordBeingStudied }}</p>

	<ul class="d-flex align-items-center ps-0">
		<AnswerItem
			v-for="(answer, index) in task.answers" :key="index"
			:answer="answer"
			:isActiveAnswerId="isActiveAnswerId"
			@onAnswerClick="onAnswerClick"
		/>
	</ul>

	<div
		v-if="hasCheckAnswer"
	>
		<p v-if="hasRightAnswer" style="color: green">Вы ответили правильно!</p>
		<p v-else style="color: red">Правильный ответ: {{ task.rightAnswer }}</p>
	</div>
</template>

<script>
import AnswerItem from './AnswerItem';

export default {
	name: 'VTask',
	components: {AnswerItem},
	props: {
		task: {
			type: Object,
			required: true
		},
		isActiveAnswerId: {
			type: [Number, String, null],
			required: true
		},
		hasRightAnswer: {
			required: true
		},
		hasCheckAnswer: {
			required: true
		}
	},
	emits: ['onAnswerClick'],

	setup (props, {emit}) {
		const onAnswerClick = value => {
			emit('onAnswerClick', value)
		}

		return {
			onAnswerClick
		}
	}
}

</script>

<style lang="scss" scoped>

</style>
