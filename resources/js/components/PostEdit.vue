<template lang="">
    <div>
        <div
           
            class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex"
        >
            <div class="relative my-6 mx-auto w-1/3">
                <!--content-->
                <div
                    class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none"
                >
                    <!--header-->
                    <div
                        class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t"
                    >
                        <div>
                            <h3 class="text-xl font-semibold">
                                Edit post
                            </h3>
                        </div>

                        <button
                            class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                            v-on:click="toggleModal(false)"
                        >
                            <span
                                class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none"
                            >
                                ×
                            </span>
                        </button>
                    </div>
                    <!--body-->
                    <div class="relative px-2 flex-auto">
                        <div class="bg-white roundedw-2/3overflow-hidden">
                            <div class="flex flex-col px-2 py-3">
                                <div class="flex justify-between">
                                    <div class="flex items-center">
                                        <div class="w-10">
                                            <img
                                                :src="
                                                    post.data.attributes
                                                        .posted_by.data
                                                        .attributes
                                                        .profile_image.data
                                                        .attributes.path
                                                "
                                                alt="profile image for user"
                                                class="w-10 h-10 object-cover rounded-full"
                                            />
                                        </div>
                                        <div class="ml-4">
                                            <div>
                                                <div class="text-sm font-bold">
                                                    {{
                                                        post.data.attributes
                                                            .posted_by.data
                                                            .attributes.name
                                                    }}
                                                </div>
                                                <div
                                                    class="text-sm text-gray-600"
                                                >
                                                    {{
                                                        post.data.attributes
                                                            .posted_at
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <input type="text" v-model="updatedPostMessage" class="w-full pl-4 h-10  focus:outline-none  text-sm"  id="input" >
                                </div>
                            </div>
                            <div
                                class="w-full relative"
                                v-if="post.data.attributes.image"
                                
                            >
                                <!-- <img
                                    :src="post.data.attributes.image"
                                    alt="post image"
                                    class="w-full"
                                /> -->
                                    <div class="" v-if="updatedPostImg">
                                        <button class="absolute  top-0 right-0 p-4 focus:outline-none" @click="removePostImg()">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                width="30" height="30"
                                                viewBox="0 0 24 24"
                                                style=" fill:#000000;"
                                                class="edit-delete-img rounded-full bg-gray-100 hover:bg-gray-400"><path d="M 4.9902344 3.9902344 A 1.0001 1.0001 0 0 0 4.2929688 5.7070312 L 10.585938 12 L 4.2929688 18.292969 A 1.0001 1.0001 0 1 0 5.7070312 19.707031 L 12 13.414062 L 18.292969 19.707031 A 1.0001 1.0001 0 1 0 19.707031 18.292969 L 13.414062 12 L 19.707031 5.7070312 A 1.0001 1.0001 0 0 0 18.980469 3.9902344 A 1.0001 1.0001 0 0 0 18.292969 4.2929688 L 12 10.585938 L 5.7070312 4.2929688 A 1.0001 1.0001 0 0 0 4.9902344 3.9902344 z"></path></svg>
                                            
                                          <!-- <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            x="0px"
                                            y="0px"
                                            width="34"
                                            height="34"
                                            viewBox="0 0 48 48"
                                            style="fill: #000000;"
                                            class="inline-block rounded-full bg-gray-500"
                                            >
                                            <path
                                                d="M 15 4 C 14.476563 4 13.941406 4.183594 13.5625 4.5625 C 13.183594 4.941406 13 5.476563 13 6 L 13 7 L 7 7 L 7 9 L 8 9 L 8 25 C 8 26.644531 9.355469 28 11 28 L 23 28 C 24.644531 28 26 26.644531 26 25 L 26 9 L 27 9 L 27 7 L 21 7 L 21 6 C 21 5.476563 20.816406 4.941406 20.4375 4.5625 C 20.058594 4.183594 19.523438 4 19 4 Z M 15 6 L 19 6 L 19 7 L 15 7 Z M 10 9 L 24 9 L 24 25 C 24 25.554688 23.554688 26 23 26 L 11 26 C 10.445313 26 10 25.554688 10 25 Z M 12 12 L 12 23 L 14 23 L 14 12 Z M 16 12 L 16 23 L 18 23 L 18 12 Z M 20 12 L 20 23 L 22 23 L 22 12 Z"></path>
                                             </svg> -->
                                             </button>
                                    </div>
                                
                                 <cld-image v-if="updatedPostImg" :public-id="post.data.attributes.image"   responsive="width"   class="w-full rounded border-2 border-gray-300" >
                                    <cld-transformation width="500" height="400" crop="fill" />
                                </cld-image>
                            </div>
                        </div>
                    </div>
                    <!--footer-->
                    <div
                        class="flex items-center justify-end p-6 rounded-b"
                    >
                        <button
                            class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button"
                            v-on:click="toggleModal(false)"
                        >
                            Close
                        </button>
                        <button
                            class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button"
                            @click="savePost"
                        >
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</template>
<script>

export default {
    name:"PostEdit",
     props: ["post","postKey"],
    data() {
        return {
            show: false,
            showModal: false,
            updatedPostMessage: this.post.data.attributes.body,
            updatedPostImg:this.post.data.attributes.image,
            postkey:this.postKey
    
        };
    },
    mounted() {
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
        methods: {
        toggleModal: function (value) {
            this.$emit("toggleModal", value);
            this.showModal=!this.showModal;
            this.show = !this.show;
        },
        removePostImg(){
            this.updatedPostImg= '';
            console.log('PostImg deleted')
          
        },
         updatePostHandler() {
       
            if (this.updatedPostImg != '') {
                 this.$store.dispatch("updatePostMessage",{  
                                body: this.updatedPostMessage,
                                postImg: this.updatedPostImg,
                                postId: this.post.data.post_id,
                                postKey: this.postkey,
                                 })
               //  console.log('test'+      postImg);
            } else {     
                      
                this.$store.dispatch("updatePostMessage",{  
                                body: this.updatedPostMessage,
                                postImg: '',
                                postId: this.post.data.post_id,
                                postKey: this.postkey });
            }
        },
        savePost(){
            this.toggleModal(false);
            this.updatePostHandler();
        
        },
        reloadPosts(){
              this.$store.dispatch("fetchNewsPosts");
        }
   
    }
}
</script>
<style lang="">
    
</style>