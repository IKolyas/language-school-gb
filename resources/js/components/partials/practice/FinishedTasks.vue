<template>
  <div>
	  Вы ответили на {{ count }} правильно из {{ tasks.length }}
  </div>
</template>

<script>
export default {
	props: ['count', 'tasks']
}
</script>

<style lang="scss" scoped>

</style>
