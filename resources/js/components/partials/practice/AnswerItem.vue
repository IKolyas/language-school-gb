<template>
	<li
		class="btn btn-outline-info me-3"
		:class="[{'active': isActiveAnswerId === answer.id}]"
		@click="$emit('onAnswerClick', answer.id)"
	>
		{{ answer.text }}
	</li>
</template>

<script>
export default {
	props: ['answer', 'isActiveAnswerId'],
	emits: ['onAnswerClick']
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
