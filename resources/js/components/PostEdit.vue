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
                                class="w-full"
                                v-if="post.data.attributes.image.length > 29"
                                :load="log(post.data.attributes.image.length)"
                            >
                                <img
                                    :src="post.data.attributes.image"
                                    alt="post image"
                                    class="w-full"
                                />
                            </div>
                        </div>
                    </div>
                    <!--footer-->
                    <div
                        class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b"
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
                            v-on:click="toggleModal(false) ;
                            $store.dispatch('updatePostMessage', {
                                body: updatedPostMessage,
                                postId: post.data.post_id,
                                postKey: postkey} ); "
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
import { mapGetters } from "vuex";
export default {
    name:"PostEdit",
     props: ["post","postKey"],
    data() {
        return {
            show: false,
            showModal: false,
            updatedPostMessage: this.post.data.attributes.body,
            postkey:this.postKey
    
        };
    },
        methods: {
        toggleModal: function (value) {
            this.$emit("toggleModal", value);
            this.showModal=!this.showModal;
            this.show = !this.show;
        },
        reloadPosts(){
              this.$store.dispatch("fetchNewsPosts");
        }
   
    }
}
</script>
<style lang="">
    
</style>