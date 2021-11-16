<template lang="">
    <div class="bg-white rounded shadow w-2/3 p-4">
        <div class="flex justify-between items-center">
            <div>
                <div class="w-10">
                    <img
                        :src="
                            authUser.data.attributes.profile_image.data
                                .attributes.path
                        "
                        alt="profile image for user"
                        class="w-10 h-10 object-cover rounded-full"
                    />
                </div>
            </div>

            <div class="flex-1 flex mx-4">
                <input
                    v-model="postMessage"
                    type="text"
                    name="body"
                    class="w-full pl-4 h-10 rounded-full bg-gray-200 focus:outline-none focus:shadow-outline text-sm"
                    placeholder="What's on your mind, User?"
                />
         
                <transition name="fade">
                    <button
                        @click="postHandler"
                        class="bg-gray-200 ml-2 px-3 py-1 rounded-full focus:outline-none"
                    >
                        Post
                    </button>
                </transition>
               
            </div>
            <div>
                <button id="upload_widget" class="cloudinary-button flex justify-center items-center rounded-full focus:outline-none w-10 h-10 bg-gray-300"> <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        class=" w-10 h-10"
                        ref="postImage"
                    >
                        <path
                            d="M21.8 4H2.2c-.2 0-.3.2-.3.3v15.3c0 .3.1.4.3.4h19.6c.2 0 .3-.1.3-.3V4.3c0-.1-.1-.3-.3-.3zm-1.6 13.4l-4.4-4.6c0-.1-.1-.1-.2 0l-3.1 2.7-3.9-4.8h-.1s-.1 0-.1.1L3.8 17V6h16.4v11.4zm-4.9-6.8c.9 0 1.6-.7 1.6-1.6 0-.9-.7-1.6-1.6-1.6-.9 0-1.6.7-1.6 1.6.1.9.8 1.6 1.6 1.6z"
                        />
                    </svg>
                    </button>

            </div>

           

        </div>
    <div class="mt-4 border-gray-300 flex justify-center" >
        <div class="rounded shadow">
              <cld-image   :public-id="post.urlImg"  height="400" width="600" class="p-2 rounded">  
                <cld-transformation width="500" height="400" crop="fill" />
                 </cld-image>
        </div>
    </div>
        
    </div>
</template>

<script>
import _ from "lodash";
import { mapGetters } from "vuex";
//import Dropzone from "dropzone";
export default {
    name: "NewPost",

    data: () => {
        return {
      //      dropzone: null,
      post:{
          urlImg:null,
      }
        };
    },

    mounted() {
       // this.dropzone = new Dropzone(this.$refs.postImage, this.settings);

     var myWidget = cloudinary.createUploadWidget({
            cloudName: 'ct-clone', 
            uploadPreset: 'fb-clone',
             cropping: true,
              multiple: false,
             folder: 'fb-clone/userPosts',
            }, (error, result) => { 
                if (!error && result && result.event === "success") { 
              
               this.post.urlImg= result.info.public_id; 
               
                }
            }
            )

            document.getElementById("upload_widget").addEventListener("click", function(){
                myWidget.open();
            }, false);
       
    },

    computed: {
        ...mapGetters({
            authUser: "authUser",
        }),
        postMessage: {
            //we get  the getter postMessage in posts.js, then we set it to postMessage that's in the setter
            get() {
                return this.$store.getters.postMessage;
               
            },
            set: _.debounce(function (postMessage) {
                this.$store.commit("updateMessage", postMessage);
            }, 300)
        },
    
    },
    methods: {
  
        postHandler() {
       
            if (this.post.urlImg != null) {
                 this.$store.dispatch("postMessage",{ postImg: this.post.urlImg })
               //  console.log('test'+      postImg);
            } else {
               
                this.$store.dispatch("postMessage",{ postImg: '' });
            }
            this.$store.commit("updateMessage", "");
            this.post.urlImg=null;
        },
    },
   
};
</script>
<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-to {
    opacity: 0;
}
</style>
