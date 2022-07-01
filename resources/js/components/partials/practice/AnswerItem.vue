<template>
	<li
		class="btn btn-outline-info me-3"
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
.btn-outline-info.active {
	color: white;
}
.btn-outline-info:hover {
	color: white;
}
</style>
