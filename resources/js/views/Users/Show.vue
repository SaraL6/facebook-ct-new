<template lang="">
    <div class="flex flex-col items-center">
        <div class="relative mb-8">
            <div class="w-100 h-64 overflow-hidden z-10">
                <img
                    src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
                    alt="user background image"
                    class="object-cover w-full"
                />
            </div>
            <div
                class="absolute flex items-center bottom-0 left-100 -mb-8 ml-12 z-20"
            >
                <div class="w-32">
                    <img
                        src="https://images.unsplash.com/photo-1491349174775-aaafddd81942?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=387&q=80"
                        alt="user profile image"
                        class="object-cover  w-32 h-32 border-4 border-gray-200 rounded-full shadow-lg"
                    />
                </div>
                <p class="text-2xl text-gray-100 ml-4">
                    {{ user.data.attributes.name }}
                </p>
            </div>
            <div class="absolute  flex items-center bottom-0 right-0 mb-4 mr-12 z-20">
                <button v-if="friendButtonText && friendButtonText!== 'Accept'"
                    class="py-1 px-3 bg-gray-400 rounded"
                    @click="$store.dispatch('sendFriendRequest', $route.params.userId)">
                {{ friendButtonText }}
                </button>
                <button v-if="friendButtonText && friendButtonText == 'Accept'"
                    class="mr-2 py-1 px-3 bg-blue-500 rounded "
                    @click="$store.dispatch('acceptFriendRequest', $route.params.userId)">
                Accept
                </button>
                <button v-if="friendButtonText && friendButtonText == 'Accept'"
                    class=" py-1 px-3 bg-gray-400 rounded "
                    @click="$store.dispatch('ignoreFriendRequest', $route.params.userId)">
                Ignore
                </button>

            </div>
        </div>
        <p v-if="postLoading">Loading posts...</p>
        <Post
            v-else
            v-for="post in posts.data"
            :key="post.data.post_id"
            :post="post"
        />
        <p v-if="!postLoading && posts.data.length < 1">
            No posts found. Get started...
        </p>
    </div>
</template>
<script>
import Post from "../../components/Post.vue";
import {mapGetters} from 'vuex';

export default {
    name: "Show",

    components: {
        Post
    },
    data: () => {
        return {

            posts: null,
            postLoading: true
        };
    },

    mounted() {
        this.$store.dispatch('fetchUser',this.$route.params.userId );
        axios
            .get("/api/users/" + this.$route.params.userId + "/posts")
            .then(res => {
                this.posts = res.data;
                this.postLoading = false;
            })
            .catch(error => {
                this.postLoading = false;
                console.log("Unable to fetch posts");
            });
    },
    computed:{
        ...mapGetters({
            user:'user',
            friendButtonText:'friendButtonText',
        })
    }
};
</script>
<style lang=""></style>
