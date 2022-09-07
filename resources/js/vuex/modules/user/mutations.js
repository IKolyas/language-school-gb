export default {
    setCurrentUser(state, payload) {
        state.isAuth = true;
        // state.localStorage = setLocalStorage();
        state.id = payload.id;
        state.name = payload.name;
        state.lastname = payload.lastname;
        state.email = payload.email;
        state.dictionaries = payload.dictionaries;
        state.tasks = payload.tasks;
        state.groups = payload.groups;
    },
    resetUser(state) {
        state.isAuth = false;
        state.id='';
        state.localStorage = {};
        state.name = '';
        state.lastname = '';
        state.email = '';
        state.dictionaries = [];
        state.tasks = {};
        state.groups = [];
    },
    setUserWords(state, payload) {
        state.userWords = payload;
    },
    setAuthenticated(state, value) {
        state.authenticated = value;
    },
    setToken(state, token) {
        state.token = token;
    },
    setUser(state, value) {
        state.user = value;
    },
    updateName(state, value) {
        state.name = value;
    },
    updateLastname(state, value) {
        state.lastname = value;
    },
    updateEmail(state, value) {
        state.email = value;
    },
}
