<template>
  <button
    v-if="!hidden"
    :style="styleButton"
    :disabled="loading || disabled"
    :class="['btn', { disabled: disabled }]"
	:type="typeBtn"
	@click.stop="$emit('click')"
  >
    <div v-if="loading">
      <div class="lds-ring" :style="preloader">
        <div :style="preloaderChildren"></div>
        <div :style="preloaderChildren"></div>
        <div :style="preloaderChildren"></div>
        <div :style="preloaderChildren"></div>
      </div>
    </div>

    <span v-else :style="styconstextPosition">
      <span v-if="text" class="content_item" :style="styleContentItem">{{ text }}</span>
    </span>
  </button>
</template>

<script>
export default {
  name: 'AppButton',
  props: {
	typeBtn: {
      type: String,
      default: 'button'
    },
    height: {
      type: String,
      default: 'fit-content'
    },
    width: {
      type: String,
      default: 'fit-content'
    },
    text: {
      type: String,
      default: null
    },
    textPosition: {
      type: String,
      default: 'right'
    },
    iconWidth: {
      type: String,
      default: '100%'
    },
    loading: {
      type: Boolean,
      default: false
    },
    hidden: {
      type: Boolean,
      default: false
    },
    disabled: {
      type: Boolean,
      default: false
    },
    dark: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    styleButton () {
      return {
        height: this.height,
        width: this.width
      }
    },
    styconstextPosition () {
      let direction
      switch (this.textPosition) {
        case 'top':
          direction = 'column'
          break
        case 'left':
          direction = 'row'
          break
        case 'right':
          direction = 'row-reverse'
          break
        case 'bottom':
          direction = 'column-reverse'
          break
      }
      return {
        display: 'flex',
        'align-items': 'center',
        'flex-direction': direction,
        'justify-content': 'center',
        height: '100%'
      }
    },
    preloader () {
      const height = this.height.replace(/\D+/g, '')
      const width = this.width.replace(/\D+/g, '')
      const pixel = +height < +width ? height : width
      return `height: ${pixel}px; width: ${pixel}px`
    },
    preloaderChildren () {
      const height = this.height.replace(/\D+/g, '')
      const width = this.width.replace(/\D+/g, '')
      const pixel = +height < +width ? height : width
      const border = +pixel / 16
      return `height: ${pixel - 20}px; width: ${pixel - 20}px; border: ${border}px solid; border-color: ${
        this.dark ? 'black' : 'white'
      } transparent transparent transparent`
    },
    styleContentItem () {
      if (this.icon && this.text) {
        return 'margin: 5px 4px'
      }
      return null
    }
  }
}
</script>

<style scoped lang="scss">
.btn {
	border-width: 3px;
	border-radius: 10px;
	background-color: white;
}

.content_item {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  font-size: inherit;
  width: fit-content;
}

.content_item_name {
  margin: 4px;
}

.lds-ring {
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-ring div {
  box-sizing: border-box;
  display: block;
  position: absolute;
  width: 64px;
  height: 64px;
  //border: 4px solid
  border-radius: 50%;
  animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  //border-color: white transparent transparent transparent
}

.lds-ring div:nth-child(1) {
  animation-delay: -0.45s;
}
.lds-ring div:nth-child(2) {
  animation-delay: -0.3s;
}
.lds-ring div:nth-child(3) {
  animation-delay: -0.15s;
}
@keyframes lds-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
