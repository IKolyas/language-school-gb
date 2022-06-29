export default {
    setCurrentUser(state, payload) {
        state.isAuth = true;
        // state.localStorage = setLocalStorage();
        state.name = payload.name;
        state.lastname = payload.lastname;
        state.email = payload.email;
        state.dictionaries = payload.dictionaries;
        state.tasks = payload.tasks;
        state.groups = payload.groups;
    },
    resetUser() {
        state.isAuth = false;
        state.localStorage = {};
        state.name = '';
        state.lastname = '';
        state.email = '';
        state.dictionaries = [];
        state.tasks = {};
        state.groups = [];
    }
}
