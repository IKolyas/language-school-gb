<template>
    <div class="d-flex align-items-center">
        <p class="my-0 me-4">Выберите верный вариант</p>
        <span @click="changeVoiceOption">
            <i v-if="!onIsVoice" class="bi bi-volume-up voice-action voice-action__active"></i>
            <i v-else class="bi bi-volume-mute-fill voice-action"></i>
        </span>
    </div>
    <p class="fs-2 current-word" :style="{color: 'green', fontWeight: 'bold'}">{{ task.word }}</p>
	<ul class="d-flex align-items-center ps-0">
		<AnswerItem
			v-for="(answer, index) in task.answers" :key="index"
			:answer="answer"
			@onAnswerClick="onAnswerClick"
            @mouseover="voiceWord(answer)"
            @mouseout="clearTimeoutVoice"
		/>
	</ul>

	<div v-if="hasCheckAnswer">
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
    data() {
        return {
            onIsVoice: false,
            timer: null,
            timeoutVoice: null
        }
    },

    methods: {
        voiceWord: function (word) {
            if (this.onIsVoice) {
                const synth = window.speechSynthesis;
                const voices = synth.getVoices();
                let utterance = new SpeechSynthesisUtterance(word);
                utterance.voice = voices[3]; // US ENGLISH
                this.setTimeoutVoice(utterance);
            }
        },

        setTimeoutVoice: function (utterance) {
            this.timeoutVoice = setTimeout(() => { speechSynthesis.speak(utterance) }, 500);
        },

        clearTimeoutVoice: function () {
            clearTimeout(this.timeoutVoice);
        },

        changeVoiceOption: function () {
            this.onIsVoice = !this.onIsVoice;
        }
    },

    setup (_, {emit}) {

		const onAnswerClick = value => {
			emit('onAnswerClick', value)
		}

		return {
			task: inject('task'),
			hasRightAnswer: inject('hasRightAnswer'),
			hasCheckAnswer: inject('hasCheckAnswer'),
			onAnswerClick,
		}
	},

}

</script>

<style lang="scss" scoped>
.current-word i:hover {
    cursor: pointer;
}

.voice-action {
    color: #1a2226;
    font-size: 2rem;
    &:hover {
        cursor: pointer;
    }
}

.voice-action__active {
    color: green;
}
</style>
