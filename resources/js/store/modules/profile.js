const state = {
    user: null,
    userStatus: null,
    posts: null,
    postsStatus: null
};

const getters = {
    //After we set the user in the mutation we send it to the front end with this
    user: state => {
        return state.user;
    },
    posts: state => {
        return state.posts;
    },
    status: state => {
        return {
            user: state.userStatus,
            posts: state.postsStatus
        };
    },
    //we can access user.js with rootState
    friendButtonText: (state, getters, rootState) => {
       // if the auth user == user id we dont show the add friend btn
        if (rootState.User.user.data.user_id === state.user.data.user_id) {
            return "";
        } else if (getters.friendship === null) {
            return "Add Friend";
            //confirmed_at is set to null when a request is pending
        } else if (
            getters.friendship.data.attributes.confirmed_at === null &&
            //and if the friend request belongs to the authenticated user, and the friend id != auth user id
            //if the below condition were the opposite, tnat would mean the friend request belongs to the authenticated use
            //rootstate.user.user accesses the user data inside the user.js module
            getters.friendship.data.attributes.friend_id !==
                rootState.User.user.data.user_id
        ) {
            return "Pending Friend Request";
        } else if (getters.friendship.data.attributes.confirmed_at !== null) {
            return "";
        }
        //the auth user = the friend id and  is the one that receives the friend request
        return "Accept";
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
    fetchUserPosts({ commit, dispatch }, userId) {
        commit("setPostsStatus", "loading");
        axios
            .get("/api/users/" + userId + "/posts")
            .then(res => {
                commit("setPosts", res.data);
                commit("setPostsStatus", "success");
            })
            .catch(error => {
                commit("setPostsStatus", "error");
            });
    },
    sendFriendRequest({ commit, getters }, friendId) {
        if (getters.friendButtonText !== "Add Friend") {
            return;
        }

        axios
            .post("/api/friend-request", { friend_id: friendId })
            .then(res => {
                commit("setUserFriendship", res.data);
            })
            .catch(error => {});
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
//mutations are how u can change the state declared in const state to
const mutations = {
    setUser(state, user) {
        //we get user from res.data in the commit setUser
        state.user = user;
    },
    setPosts(state, posts) {
        //we get user from res.data in the commit setUser
        state.posts = posts;
    },
    setUserFriendship(state, friendship) {
        state.user.data.attributes.friendship = friendship;
    },
    setUserStatus(state, status) {
        state.userStatus = status;
    },
    setPostsStatus(state, status) {
        state.postsStatus = status;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};
