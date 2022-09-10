<template>
    <section class="task-area">
        <div class="task-area__current-word current-word">
			<div>
				<span class="current-word__word">{{ task.word }}</span>
				<span @click="voiceWord(task.word)" @mouseover="voiceWord(task.word)" @mouseout="clearTimeoutVoice"><i class="bi bi-volume-up voice-action voice-action__active"></i></span>
			</div>
        </div>
        <ul class="task-area__answers-list answers-list">
            <AnswerItem
                v-for="(answer, index) in task.answers" :key="index"
                :answer="answer"
                @onAnswerClick="onAnswerClick"
				@mouseover="voiceWord(answer)"
				@mouseout="clearTimeoutVoice"
            />
        </ul>
        <div class="task-area__result">
            <p v-if="hasRightAnswer & hasCheckAnswer" class="task-area__success">Вы ответили правильно!</p>
            <p v-else-if="hasCheckAnswer" class="task-area__mistake">Правильный ответ: {{ task.translation }}</p>
        </div>
    </section>
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
            onIsVoice: true,
            timer: null,
            timeoutVoice: null
        }
    },

    methods: {
        voiceWord (word) {
			const synth = window.speechSynthesis;
			const voices = synth.getVoices();
			let utterance = new SpeechSynthesisUtterance(word);
			utterance.voice = voices[3]; // US ENGLISH
			this.setTimeoutVoice(utterance);
        },

        setTimeoutVoice (utterance) {
            this.timeoutVoice = setTimeout(() => {
                speechSynthesis.speak(utterance)
            }, 200);
        },

        clearTimeoutVoice () {
            clearTimeout(this.timeoutVoice);
        },

        changeVoiceOption () {
            this.onIsVoice = !this.onIsVoice;
        }
    },

    setup(_, {emit}) {

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

		&:before {
			transition: .3s;
			transform: scale(1.05);
		}
    }
    &:active {
		&:before {
			transition: .3s;
			transform: scale(1);
		}
    }
}

.voice-action__active {
    color: green;
}
</style>
