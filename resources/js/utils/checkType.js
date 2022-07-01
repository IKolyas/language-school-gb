export function isArray(array) {
	return array instanceof Array && array.length
}

export function isObject(obj) {
	return obj instanceof Object && obj.constructor === Object;
}

export function isString(val) {
	return (typeof val === "string" || val instanceof String);
}