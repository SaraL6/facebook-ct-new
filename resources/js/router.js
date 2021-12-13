import Vue from "vue";
import VueRouter from "vue-router";
import NewsFeed from "./views/NewsFeed";
import UserShow from "./views/Users/Show";
import PostShow from "./views/Posts/ViewPost.vue";

Vue.use(VueRouter);

export default new VueRouter({
    mode: "history",

    routes: [
        {
            path: "/",
            name: "home",
            component: NewsFeed,
            meta: { title: "News Feed" }
        },
        {
            path: "/users/:userId",
            name: "user.show",
            component: UserShow,
            meta: { title: "Profile" }
        },
        {
            path: "/posts/:postId",
            name: "post.show",
            component: PostShow,
            meta: { title: "Post" }
        }
    ]
});
