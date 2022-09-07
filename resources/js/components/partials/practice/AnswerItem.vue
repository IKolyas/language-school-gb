<template>
	<li
		class="answer-list__answer-item"
		:class="[{'active': isActiveAnswer === answer}]"
		@click="$emit('onAnswerClick', answer)"
	>
		{{ answer }}
	</li>
</template>

<script>
import {inject} from 'vue';

export default {
	props: ['answer'],
	emits: ['onAnswerClick'],

	setup () {
		return {
			isActiveAnswer: inject('isActiveAnswer')
		}
	}
}
</script>

<style lang="scss">

</style>
