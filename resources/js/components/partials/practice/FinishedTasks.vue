<template>
  <p class="practice-result">
	  Вы ответили на {{ successCount }} правильно из {{ count }}
  </p>
</template>

<script>
import { inject } from 'vue';

export default {
	setup() {
		return {
            finishResults: inject('finishResults'),
			count: inject('count'),
            successCount: inject('successCount'),
		}
	}
}
</script>

<style lang="scss" scoped>

</style>
