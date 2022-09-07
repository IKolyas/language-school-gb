import {
    getStatistics, saveStatistics
} from "../../../services/statistics.service";

const state = () => ({
    statistics: {},
})

const mutations = {
    setStatistics(state, statistics) {
        state.statistics = statistics.data;
    }
}

const actions = {
    async fetchStatistics({commit}, payload) {
        try {
            const data = await getStatistics(payload.user_id);
            const lastTrainingDay = data.data.updated_at;
            const daysDiff = Math.floor((new Date().getTime() - new Date(lastTrainingDay).getTime()) / (1000 * 3600 * 24));
            data.data.daysDiff = daysDiff;
            if (daysDiff > 1) {
                data.data.training_days_strike = 0;
            }
            commit("setStatistics", data);
        } catch (e) {
            console.error('fetchStatistics', e);
        }
    },
    async saveStatistics({commit, dispatch, state}, payload) {
        let trainingDays = state.statistics.training_days;
        let trainingDaysStrike = state.statistics.training_days_strike;
        let maxTrainingDaysStrike = state.statistics.max_training_days_strike;
        if (state.statistics.daysDiff > 0) {
            trainingDays++;
            trainingDaysStrike++;
            if (trainingDaysStrike > maxTrainingDaysStrike) {
                maxTrainingDaysStrike++
            }
        }
        const data = {training_days: trainingDays, training_days_strike: trainingDaysStrike, max_training_days_strike: maxTrainingDaysStrike};
        try {
            await saveStatistics(payload.user_id, data);
        } catch (e) {
            console.error('saveStatistics', e);
        }
        dispatch('fetchStatistics', {user_id: payload.user_id})
    },
}

const getters = {}

const statisticsModule = {
    namespaced: true,
    state,
    actions,
    mutations,
    getters,
}

export default statisticsModule;
