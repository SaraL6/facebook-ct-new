<template lang="">
    <div class="flex flex-col flex-1 h-screen ">
        <div class="w-3/5 bg-black">     
              <div class=" postImg">
                    <button class="absolute  top-0 left-4 p-0 focus:outline-none" @click="previousPage()">
                         <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                             width="30" height="30"
                             viewBox="0 0 24 24"
                             style=" fill:#ffffff;"
                             class="edit-delete-img rounded-full "><path d="M 4.9902344 3.9902344 A 1.0001 1.0001 0 0 0 4.2929688 5.7070312 L 10.585938 12 L 4.2929688 18.292969 A 1.0001 1.0001 0 1 0 5.7070312 19.707031 L 12 13.414062 L 18.292969 19.707031 A 1.0001 1.0001 0 1 0 19.707031 18.292969 L 13.414062 12 L 19.707031 5.7070312 A 1.0001 1.0001 0 0 0 18.980469 3.9902344 A 1.0001 1.0001 0 0 0 18.292969 4.2929688 L 12 10.585938 L 5.7070312 4.2929688 A 1.0001 1.0001 0 0 0 4.9902344 3.9902344 z"></path></svg>
                            </button>
                     <router-link to="/">
                     <button class="absolute  top-0 left-30 p-4 focus:outline-none">
                        <svg
                        class=" w-10 h-10 "
                         style=" fill:#ffffff;"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M23 12.1c0-6.1-4.9-11-11-11S1 6 1 12.1c0 5.5 4 10.1 9.3 10.9v-7.7H7.5v-3.2h2.8V9.7c0-2.8 1.6-4.3 4.2-4.3 1.2 0 2.5.2 2.5.2v2.7h-1.4c-1.4 0-1.8.8-1.8 1.7v2.1h3.1l-.5 3.2h-2.6V23c5.2-.9 9.2-5.4 9.2-10.9z"
                            fill="#1877f2"
                        /></svg
                >  
                     </button>
                   </router-link>
            <div class="bg-black postImgHead h-full w-full flex justify-center">
            
                         <cld-image :public-id="post.data.attributes.image" loading="lazy"   >
                            <cld-transformation  quality="70"   crop="fit" />
               </cld-image>
                </div>
             
            </div>
        </div>

 
        <div class="w-1/3 flex justify-end">
                
        </div>
            
   
        
    </div>
</template>
<script>
import Post from "../../components/Post.vue";
import { mapGetters } from "vuex";
export default {
    name: "ViewPost",
      props: ["postKey"],
    data() {
        return {
            postId:this.posts
        }
    },
    

    components: {
        Post,
    },

       mounted() {      
       this.$store.dispatch("fetchPost", this.$route.params.postId);

    },
    methods: {
        previousPage(){
            this.$router.back();
        }
    },
        computed: {
        ...mapGetters({
            post:"post",
            posts: "posts",
           // status: "poststatus",
        }),
    },
}
</script>
<style lang="">
    
</style>