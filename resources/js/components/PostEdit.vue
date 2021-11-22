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
                                        <div class="ml-2">
                                            <div>
                                                <div class="text-sm font-bold">
                                                    {{
                                                        post.data.attributes
                                                            .posted_by.data
                                                            .attributes.name
                                                    }}
                                                </div>
                                                <div
                                                    class="text-xs text-gray-600"
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
                                <div class="pl-1 my-2">
                                    <input type="text" v-model="updatedPostMessage" class="w-full pl-1 h-10  focus:outline-none  text-sm"  id="input" >
                                </div>
                            </div>
                            <div
                                class="w-full relative"
                                v-if="post.data.attributes.image"
                                
                            >
                               
                                    <div class="" v-if="imgExists">
                                        <button class="absolute  top-0 right-0 p-4 focus:outline-none" @click="removePostImg()">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                width="30" height="30"
                                                viewBox="0 0 24 24"
                                                style=" fill:#000000;"
                                                class="edit-delete-img rounded-full bg-gray-100 hover:bg-gray-400"><path d="M 4.9902344 3.9902344 A 1.0001 1.0001 0 0 0 4.2929688 5.7070312 L 10.585938 12 L 4.2929688 18.292969 A 1.0001 1.0001 0 1 0 5.7070312 19.707031 L 12 13.414062 L 18.292969 19.707031 A 1.0001 1.0001 0 1 0 19.707031 18.292969 L 13.414062 12 L 19.707031 5.7070312 A 1.0001 1.0001 0 0 0 18.980469 3.9902344 A 1.0001 1.0001 0 0 0 18.292969 4.2929688 L 12 10.585938 L 5.7070312 4.2929688 A 1.0001 1.0001 0 0 0 4.9902344 3.9902344 z"></path></svg>
                                            
                                         
                                             </button>
                                    </div>
                                
                                 <cld-image v-if="imgExists" :public-id="imgPath"   responsive="width"   class="w-full rounded border-2 border-gray-300" >
                                    <cld-transformation width="500" height="400" crop="fill" />
                                </cld-image>
                            </div>
                            <div v-if="!imgExists" class="edit_add_post_img flex justify-between items-center rounded px-3 py-2">
                                <div>
                                     Add to your post 
                                </div>
                                <div>
                                      <button id="upload_widget_edit" class="cloudinary-button flex justify-center items-center rounded-full focus:outline-none w-10 h-10 bg-gray-300"> <svg
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
                        </div>
                    </div>
                    <!--footer-->
                    <div
                        class="flex items-center justify-center p-6 rounded-b"
                    >
                        <button
                            class="bg-fb-blue hover:bg-fb-blue text-white font-bold py-2 px-4 w-full rounded utline-none focus:outline-none"
                            type="button"
                            @click="savePost"
                        >
                            Save 
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
            imgExists:false,
            postkey:this.postKey,
            imgPath:this.post.data.attributes.image,
            publicId:null,

              
    
        };
    },
    mounted() {
       
         if(this.imgPath)
         this.imgExists=true;
        
       
        this.editUploadImg();

    },
        methods: {
        toggleModal: function (value) {
            this.$emit("toggleModal", value);
            this.showModal=!this.showModal;
            this.show = false;
        },

        editUploadImg(){
         
         
                console.log('before '  +   this.publicId);
                var myEditWidget = cloudinary.createUploadWidget({
                        cloudName: 'ct-clone', 
                        uploadPreset: 'fb-clone',
                        cropping: true,
                        multiple: false,
                    
                        folder: 'fb-clone/userPosts',
                    }, (error, result) => { 
                      
                        if (!error && result && result.event === "success") {        
                            this.imgPath= result.info.public_id;         
                            this.imgExists= true; 
                        }
                    }
            );

                 var el = document.getElementById('upload_widget_edit');
                    if(el){
                        el.addEventListener("click", function(){
                
                            myEditWidget.open();
                         }, false);
                    }
        },
        removePostImg(){
       
         
             this.imgExists=false;
            setTimeout(() => {

                  
                 this.editUploadImg();
            }, 1000);
          
        },
        deleteImg(){

        },
         updatePostHandler() {
             let imagePath="";
             if (this.imgExists) {
                imagePath= this.imgPath;
                 
             }
            this.$store.dispatch("updatePostMessage",{  
                body: this.updatedPostMessage,
                postImg: imagePath,
                postId: this.post.data.post_id,
                postKey: this.postkey,
            })
               
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