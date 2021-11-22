//state is data

const state = {
    posts: null,
    postStatus: null,
    postMessage: "",
};

//getters are computed properties
const getters = {
    //After we set the user in the mutation we send it to the front end with this
    posts: (state) => {
        return state.posts;
    },

    newsStatus: (state) => {
        return {
            postsStatus: state.postsStatus,
        };
    },
    postMessage: (state) => {
        return state.postMessage;
    },
};

const actions = {
    //this action is goint to be dispatched in App.vue
    fetchNewsPosts({ commit, state }) {
        commit("setPostsStatus", "loading");
        axios
            .get("/api/posts")
            .then((res) => {
                commit("setPosts", res.data);
               // console.log(res.data);
                commit("setPostsStatus", "success");
            })
            .catch((error) => {
                commit("setPostsStatus", "error");
            });
    },
    fetchUserPosts({ commit, dispatch }, userId) {
        commit("setPostsStatus", "loading");
        axios
            .get("/api/users/" + userId + "/posts")
            .then((res) => {
                commit("setPosts", res.data);
                commit("setPostsStatus", "success");
                
            })
            .catch((error) => {
                commit("setPostsStatus", "error");
            });
    },
    deletePost({ commit, state }, postId) {
       // console.log(postId);
        axios
            .delete("/api/posts/delete", {
                data: {id: postId },
            })
            .then((res) => {
             //  commit("deletePost", res.data);
              //  console.log(res);
                commit("setPostsStatus", "success");
          
            })
            .catch((error) => {});
    },
    updatePostMessage({ commit, state },emittedData) {
      
        axios
            .put("/api/posts/" + emittedData.postId, {             
                  id: emittedData.postId,
                  body:emittedData.body,
                  image:emittedData.postImg

                })               
                .then((res) => {
                  //  console.log('postkey'+emittedData.postKey);
                    commit("setPost", {posts:res.data, postKey: emittedData.postKey});
                  
                })
                .catch((error) => {});
        },
       
    //this action will post to the db
    postMessage({ commit, state },data) {
    
        commit("setPostsStatus", "loading");
        axios
            .post("/api/posts", {
                 body: state.postMessage , image: data.postImg})
                 
            .then((res) => {
                commit("pushPost", res.data);  
                commit("setPostsStatus", "success");
                commit("updateMessage", "");
            })
            .catch((error) => {});
    },

    likePost({ commit, state }, data) {
       // console.log(data);
        axios
            .post("/api/posts/" + data.postId + "/like")
            .then((res) => {
              
                commit("pushLikes", { likes: res.data, postKey: data.postKey });
            

            })
            .catch((error) => {});
    },
    commentPost({ commit, state }, data) {
        axios
            .post("/api/posts/" + data.postId + "/comment", { body: data.body })
            .then((res) => {
                commit("pushComments", {
                    comments: res.data,
                    postKey: data.postKey,
                });
            })
            .catch((error) => {});
    },
};
//mutations are how u can change the state declared in const state
const mutations = {
    setPosts(state, posts) {
        state.posts = posts;
    },
    setPost(state, data) {
        // console.log(state);
         //console.log(state.posts.data[data.postKey].data.attributes);
        state.posts.data[data.postKey].data.attributes.body = data.posts.body;
        state.posts.data[data.postKey].data.attributes.image = data.posts.image;
      // console.log(data.posts);
    },
    setPostsStatus(state, status) {
        state.postsStatus = status;
    },
    setPostStatus(state, status) {
        state.postStatus = status;
    },
    //message = postMessage in the get computed property in NewPost.vue
    updateMessage(state, message) {
        state.postMessage = message;
    },
    pushPost(state, post) {
        state.posts.data.unshift(post);
    },
    deletePost(state, post) {
        state.posts.data.shift(post);
       

    },
    pushLikes(state, data) {       
        state.posts.data[data.postKey].data.attributes.likes = data.likes;       
    },
    pushComments(state, data) {
        state.posts.data[data.postKey].data.attributes.comments = data.comments;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
