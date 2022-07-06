<template>
  	<p>Выберите верный вариант</p>
	<p class="fs-2" :style="{color: 'green', fontWeight: 'bold'}">{{ task.word }}</p>

	<ul class="d-flex align-items-center ps-0">
		<AnswerItem
			v-for="(answer, index) in task.answers" :key="index"
			:answer="answer"
			@onAnswerClick="onAnswerClick"
		/>
	</ul>

	<div
		v-if="hasCheckAnswer"
	>
		<p v-if="hasRightAnswer" style="color: green">Вы ответили правильно!</p>
		<p v-else style="color: red">Правильный ответ: {{ task.translation }}</p>
	</div>
</template>

<script>
import AnswerItem from './AnswerItem';
import {inject} from 'vue';

export default {
	name: 'VTask',
	components: {AnswerItem},
	emits: ['onAnswerClick'],

	setup (_, {emit}) {
		const onAnswerClick = value => {
			emit('onAnswerClick', value)
		}

		return {
			task: inject('task'),
			hasRightAnswer: inject('hasRightAnswer'),
			hasCheckAnswer: inject('hasCheckAnswer'),
			onAnswerClick
		}
	}
}

</script>

<style lang="scss" scoped>

</style>
