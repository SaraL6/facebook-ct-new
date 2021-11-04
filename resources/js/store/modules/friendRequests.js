const state = {
    requests: null,
    requestsStatus: null,
};

const getters = {
    modalrequests: (state) => {
        return state.requests;
    },
    lrequestsStatus: (state) => {
        return {
            requestsStatus: state.requestsStatus,
        };
    },
    requestSender: (state, getters, rootState) => {
        if (state.requests === "No Friend Requests") {
            return "No Friend Requests";
        } else if (
            rootState.User.user.data.user_id ===
            state.requests.data[0].data.attributes.user_id
        ) {
            return "";
        } else if (
            rootState.User.user.data.user_id !==
            state.requests.data[0].data.attributes.user_id
        ) {
            return state.requests.data[0].data.attributes.sent_by.name;
        }
    },

    modalfriendship: (state) => {
        return state.requests.data[0].data.attributes.confirmed_at;
    },
    //we can access user.js with rootState
    modalfriendButtonText: (state, getters, rootState) => {
        // if the auth user == user id we dont show the add friend btn
        if (getters.modalfriendship !== null) {
            return "";
        }
        //the auth user = the friend id and  is the one that receives the friend request
        return "Accept";
    },
};

const actions = {
    fetchFriendRequests({ commit, state }) {
        commit("setRequestsStatus", "loading");
        axios
            .get("/api/friend-request")
            .then((res) => {
                commit("setRequests", res.data);
                console.log(res.data);
                commit("setRequestsStatus", "success");
            })
            .catch((error) => {
                commit("setRequestsStatus", "error");
            });
    },
    acceptFriendRequest({ commit, state }, userId) {
        axios
            .post("/api/friend-request-response", {
                user_id: userId,
                status: 1,
            })
            .then((res) => {
                commit("setUserFriendship", res.data);
            })
            .catch((error) => {});
    },
    ignoreFriendRequest({ commit, state }, userId) {
        axios
            .delete("/api/friend-request-response/delete", {
                data: { user_id: userId },
            })
            .then((res) => {
                commit("setUserFriendship", null);
            })
            .catch((error) => {});
    },
};

const mutations = {
    setRequests(state, modalrequests) {
        state.requests = modalrequests;
    },
    setRequestsStatus(state, status) {
        state.requestsStatus = status;
    },
    setUserFriendship(state, modalfriendship) {
        state.requests.data.attributes.confirmed_at = modalfriendship;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
