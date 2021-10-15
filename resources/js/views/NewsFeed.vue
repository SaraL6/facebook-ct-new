<template lang="">
    <div class="flex flex-col py-4">
        <NewPost />
        <p v-if="newsStatus.postsStaus === 'loading'">Loading posts...</p>
        <Post
            v-else
            v-for="(post,postKey) in posts.data"
            :key="postKey"
            :post="post"
        />
    </div>
</template>
<script>
import { mapGetters } from "vuex";
import NewPost from "../components/NewPost";
import Post from "../components/Post";
export default {
    name: "NewsFeed",

    components: {
        NewPost,
        Post
    },

    mounted() {
        this.$store.dispatch("fetchNewsPosts");
    },
    computed: {
        ...mapGetters({
            posts: "posts",
            newsStatus: "newsStatus"
        })
    }
};
</script>
<style lang=""></style>
