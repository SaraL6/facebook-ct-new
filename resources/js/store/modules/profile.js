const state = {
    user: null,
    userStatus: null
};

const getters = {
    //After we set the user in the mutation we send it to the front end with this
    user: state => {
        return state.user;
    },
    //we can access user.js with rootState
    friendButtonText: (state, getters, rootState) => {
        if (getters.friendship === null) {
            return "Add Friend";
            //confirmed_at is set to null when a request is pending
        } else if (getters.friendship.data.attributes.confirmed_at === null) {
            return "Pending Friend Request";
        }
    },
    friendship: state => {
        return state.user.data.attributes.friendship;
    }
};

const actions = {
    //this action is goint to be dispatched in App.vue
    //we get user from the frontend in the dispatch in Show.vue
    fetchUser({ commit, dispatch }, userId) {
        //  we set the initial useeStatus to loading
        commit("setUserStatus", "loading");
        //we use axios to get our user
        axios
            .get("/api/users/" + userId)
            .then(res => {
                //we set our data/state equal to the results of the response
                commit("setUser", res.data);
                //we set the status to success
                commit("setUserStatus", "success");
            })

            .catch(error => {
                commit("setUserStatus", "error");
            });
    },
    sendFriendRequest({ commit, state }, friendId) {
        commit("setButtonText", "Loading");
        axios
            .post("/api/friend-request", { friend_id: friendId })
            .then(res => {
                commit("setUserFriendship", res.data);
            })
            .catch(error => {

            });
    }
};
//mutations are how u can change the state declared in const state to
const mutations = {
    setUser(state, user) {
        //we get user from res.data in the commit setUser
        state.user = user;
    },
    setUserFriendship(state,friendship){
        state.user.data.attributes.friendship =friendship;
    },
    setUserStatus(state, status) {
        state.UserStatus = status;
    },
    setButtonText(state, text) {
        state.friendButtonText = text;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};
