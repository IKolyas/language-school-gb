<template>
  <div>
	  Вы ответили на {{ count }} правильно из {{ tasks.length }}
  </div>
</template>

<script>
import { inject } from 'vue';

export default {
	setup() {
		return {
			tasks: inject('tasks'),
			count: inject('count'),
		}
	}
}
</script>

<style lang="scss" scoped>

</style>
