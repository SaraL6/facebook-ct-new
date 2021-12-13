<template lang="">
<div class="flex">
      <div class="flex flex-col items-center py-4 w-4/5">
        <NewPost />
        
        <p v-if="newsStatus.postsStaus === 'loading'">Loading posts...</p>
        <Post
            v-else
            v-for="(post, postKey) in posts.data"
            :key="postKey"
            :post="post"
        />
    </div>
    <div class="">
         <Rightbar />
    </div>
</div>
  
</template>
<script>
import { mapGetters } from "vuex";
import NewPost from "../components/NewPost";
import Post from "../components/Post";
import Rightbar from "../components/Rightbar";
export default {
    name: "NewsFeed",
    props:["postKey"],

    components: {
        NewPost,
        Post,
        Rightbar
    },

    mounted() {
        this.$store.dispatch("fetchNewsPosts");
    },
    computed: {
        ...mapGetters({
            posts: "posts",
            newsStatus: "newsStatus",
        }),
    },
};
</script>
<style lang=""></style>
