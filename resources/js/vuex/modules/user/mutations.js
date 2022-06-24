export default {
    setCurrentUser(state, payload) {
        state.isAuth = true;
        state.localStorage = setLocalStorage();
        state.name = payload.name;
        state.lastname = payload.lastname;
        state.email = payload.email;
        state.token = payload.token;
        state.tasks = payload.tasks;
        state.photo = payload.photo;
        state.statistics = payload.statistics;
    },
    resetUser() {
        state.isAuth = false;
        state.localStorage = {};
        state.name = '';
        state.lastname = '';
        state.email = '';
        state.token = '';
        state.tasks = {};
        state.photo = '';
        state.statistics = {};
    }
}
