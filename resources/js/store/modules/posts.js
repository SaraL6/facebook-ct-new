//state is data

const state = {
    newsPosts: null,
    newsPostsStatus: null,
    postMessage: ""
};

//getters are computed properties
const getters = {
    //After we set the user in the mutation we send it to the front end with this
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
    //this action will post to the db
    postMessage({ commit, state }) {
        commit("setPostsStatus", "loading");
        axios
            .post("/api/posts", { body: state.postMessage })
            .then(res => {
                commit("pushPost", res.data);
                commit("updateMessage", "");
            })
            .catch(error => {});
    },
    likePost({ commit, state }, data) {
        axios
            .post("/api/posts/" + data.postId + "/like")
            .then(res => {
                commit("pushLikes", { likes: res.data, postKey: data.postKey });
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
    //message = postMessage in the get computed property in NewPost.vue
    updateMessage(state, message) {
        state.postMessage = message;
    },
    pushPost(state, post) {
        state.newsPosts.data.unshift(post);
    },
    pushLikes(state, data) {
        state.newsPosts.data[data.postKey].data.attributes.likes = data.likes;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};
