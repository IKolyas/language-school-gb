import {ref} from 'vue';
import {isArray, isString} from '../../utils/checkType';

const randArray = array => {
	const randNum = Math.random() * array.length | 0
	return array[randNum]
}

export function randomIncorrectAnswers (dictionaries, basic, count = 5) {
	if (!isArray(dictionaries)) {
		throw new Error('dictionaries are not on Array')
	}
	if (!isString(basic)) {
		throw new Error('basic is not on String')
	}
	if (!Number.isInteger(count) && count === 0)  {
		throw new Error('count is not correct')
	}
	if (count >= dictionaries.length) {
		count = dictionaries.length
	}

	const array = ref([])
	array.value.push(basic)

	while (array.value.length < count) {
		let word = randArray(dictionaries)
		if (!array.value.includes(word)) {
			array.value.push(word)
		}
	}

	return array
}