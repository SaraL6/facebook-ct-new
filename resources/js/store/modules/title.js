const state = {
    title: "Welcome",
};
const getters = {
    pageTitle: state => {
        return state.title;
    }
};
const actions = {
    setPageTitle({ commit, state }, title) {
        commit("setTitle", title);
    }
};
const mutations = {
    setPageTitle(state, title) {
        state.title = title + " | Facebook";

        document.title = state.title;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};
