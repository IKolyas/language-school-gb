<template>
  <div>
	  Вы ответили на {{ successCount }} правильно из {{ count }}
  </div>
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
