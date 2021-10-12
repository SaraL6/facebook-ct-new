//state is data

const state = {
    newsPosts: null,
    newsPostsStatus: null,
    postMessage: ""
};

//getters are computed properties
const getters = {
    //After we set the user in the mutation we're send it to the front end with this
    newsPosts: state => {
        return state.newsPosts;
    },
    newsStatus: state => {
        return {
            newsPostsStatus: state.newsPostsStatus
        };
    },
    postMessage: state => {
        return state.postMessage;
    }
};

const actions = {
    //this action is goint to be dispatched in App.vue
    fetchNewsPosts({ commit, state }) {
        commit("setPostsStatus", "loading");
        axios
            .get("/api/posts")
            .then(res => {
                commit("setPosts", res.data);
                commit("setPostsStatus", "success");
            })
            .catch(error => {
                commit("setPostsStatus", "error");
            });
    },
    postMessage({ commit, state }) {
        commit("setPostsStatus", "loading");
        axios
            .post("/api/posts", { body: state.postMessage })
            .then(res => {
                commit("pushPost", res.data);
                commit("updateMessage", "");
            })
            .catch(error => {});
    }
};
//mutations are how u can change the state declared in const state
const mutations = {
    setPosts(state, posts) {
        state.newsPosts = posts;
    },
    setPostsStatus(state, status) {
        state.newsPostsStatus = status;
    },
    updateMessage(state, message) {
        state.postMessage = message;
    },
    pushPost(state, post) {
        state.newsPosts.data.unshift(post);
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};
