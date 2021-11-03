const state = {
    requests: null,
    requestsStatus: null,
};

const getters = {
    requests: (state) => {
        return state.requests;
    },
    requestsStatus: (state) => {
        return {
            requestsStatus: state.requestsStatus,
        };
    },
};

const actions = {
    fetchFriendRequests({ commit, state }) {
        commit("setrequestsStatus", "loading");
        axios
            .get("/api/friend-request")
            .then((res) => {
                commit("setRequests", res.data);
                console.log(res.data);
               commit("setrequestsStatus", "success");
            })
            .catch((error) => {
                commit("setrequestsStatus", "error");
            });
    },
    acceptFriendRequest({ commit, state }, userId) {
        axios
            .post("/api/friend-request-response", {
                user_id: userId,
                status: 1
            })
            .then(res => {
                commit("setUserFriendship", res.data);
            })
            .catch(error => {});
    },
    ignoreFriendRequest({ commit, state }, userId) {
        axios
            .delete("/api/friend-request-response/delete", {
                data: { user_id: userId }
            })
            .then(res => {
                commit("setUserFriendship", null);
            })
            .catch(error => {});
    }
};

const mutations = {
    setRequests(state, requests) {
        state.requests = requests;
    },
    setRequestsStatus(state, status) {
        state.requestsStatus = status;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
