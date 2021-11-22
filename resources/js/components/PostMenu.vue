<template lang="">
    <div>
        <div class="header__post__menu">
            <div class="header__nav">
                <ul class="header__navbar">
                    <li class="header__item__post__menu">
                        <a href="#" class="header__link">
                            <transition>
                                <!-- Header Navigation Menu Icons -->
                                <button
                                    class="header--button"
                                    v-if="show"
                                    key="on"
                                    @click="show = false"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        width="1.5em"
                                        height="1.5em"
                                        class="header--iconn hover:bg-gray-400 rounded-full"
                                    >
                                        <g
                                            fill-rule="evenodd"
                                            transform="translate(-446 -350)"
                                        >
                                            <path
                                                d="M458 360a2 2 0 1 1-4 0 2 2 0 0 1 4 0m6 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0m-12 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0"
                                            ></path>
                                        </g>
                                        <title>Close</title>
                                    </svg>
                                </button>
                                <button
                                    class="header--button"
                                    v-else
                                    key="off"
                                    @click="show = true"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        width="1.5em"
                                        height="1.5em"
                                        class="header--iconn hover:bg-gray-400 rounded-full"
                                    >
                                        <g
                                            fill-rule="evenodd"
                                            transform="translate(-446 -350)"
                                        >
                                            <path
                                                d="M458 360a2 2 0 1 1-4 0 2 2 0 0 1 4 0m6 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0m-12 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0"
                                            ></path>
                                        </g>
                                        <title>Navigation Menu</title>
                                    </svg>

                                    <!-- <svg viewBox="0 0 24 24" class="header--icon">
                  <title>Navigation Menu</title>
                  <path fill="currentColor" d="M6,8c1.1,0 2,-0.9 2,-2s-0.9,-2 -2,-2 -2,0.9 -2,2 0.9,2 2,2zM12,20c1.1,0 2,-0.9 2,-2s-0.9,-2 -2,-2 -2,0.9 -2,2 0.9,2 2,2zM6,20c1.1,0 2,-0.9 2,-2s-0.9,-2 -2,-2 -2,0.9 -2,2 0.9,2 2,2zM6,14c1.1,0 2,-0.9 2,-2s-0.9,-2 -2,-2 -2,0.9 -2,2 0.9,2 2,2zM12,14c1.1,0 2,-0.9 2,-2s-0.9,-2 -2,-2 -2,0.9 -2,2 0.9,2 2,2zM16,6c0,1.1 0.9,2 2,2s2,-0.9 2,-2 -0.9,-2 -2,-2 -2,0.9 -2,2zM12,8c1.1,0 2,-0.9 2,-2s-0.9,-2 -2,-2 -2,0.9 -2,2 0.9,2 2,2zM18,14c1.1,0 2,-0.9 2,-2s-0.9,-2 -2,-2 -2,0.9 -2,2 0.9,2 2,2zM18,20c1.1,0 2,-0.9 2,-2s-0.9,-2 -2,-2 -2,0.9 -2,2 0.9,2 2,2z" />
                </svg> -->
                                </button>
                            </transition>
                        </a>
                        <!-- Dropdown Menu -->
                        <transition name="dropdown">
                            <div
                                class="dropdown__menu__post shadow-md"
                                v-bind:class="{ active: show }"
                                v-if="show"
                            >
                                <ul class="dropdown__menu__post-nav">
                                    <li class="dropdown__menu__post-item">
                                        <a
                                            href="#"
                                            class="dropdown__menu__post-link"
                                            title="Account"
                                        >
                                            <div
                                                class="flex dropdown__menu__post-action"
                                            >
                                                <div
                                                    class="dropdown__menu__post-svg"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        x="0px"
                                                        y="0px"
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 48 48"
                                                        style="fill: #000000;"
                                                    >
                                                        <path
                                                            d="M 36 5.0097656 C 34.205301 5.0097656 32.410791 5.6901377 31.050781 7.0507812 L 8.9160156 29.183594 C 8.4960384 29.603571 8.1884588 30.12585 8.0253906 30.699219 L 5.0585938 41.087891 A 1.50015 1.50015 0 0 0 6.9121094 42.941406 L 17.302734 39.974609 A 1.50015 1.50015 0 0 0 17.304688 39.972656 C 17.874212 39.808939 18.39521 39.50518 18.816406 39.083984 L 40.949219 16.949219 C 43.670344 14.228094 43.670344 9.7719064 40.949219 7.0507812 C 39.589209 5.6901377 37.794699 5.0097656 36 5.0097656 z M 36 7.9921875 C 37.020801 7.9921875 38.040182 8.3855186 38.826172 9.171875 A 1.50015 1.50015 0 0 0 38.828125 9.171875 C 40.403 10.74675 40.403 13.25325 38.828125 14.828125 L 36.888672 16.767578 L 31.232422 11.111328 L 33.171875 9.171875 C 33.957865 8.3855186 34.979199 7.9921875 36 7.9921875 z M 29.111328 13.232422 L 34.767578 18.888672 L 16.693359 36.962891 C 16.634729 37.021121 16.560472 37.065723 16.476562 37.089844 L 8.6835938 39.316406 L 10.910156 31.521484 A 1.50015 1.50015 0 0 0 10.910156 31.519531 C 10.933086 31.438901 10.975086 31.366709 11.037109 31.304688 L 29.111328 13.232422 z"
                                                        ></path>
                                                    </svg>
                                                </div>
                                                <div
                                                    class="dropdown__menu__post-text"
                                                >
                                                    <button
                                                        class="focus:outline-none"
                                                        v-on:click="
                                                            toggleModal()">
                                                        Edit post
                                                    </button>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <!-- Dropdown Menu Separator -->
                                    <hr />
                                    <li class="dropdown__menu-item">
                                        <a
                                            href="#"
                                            class="dropdown__menu__post-link"
                                            title="Help"
                                        >
                                            <div
                                                class="flex dropdown__menu__post-action"
                                            >
                                                <div
                                                    class="dropdown__menu__post-svg"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        x="0px"
                                                        y="0px"
                                                        width="34"
                                                        height="34"
                                                        viewBox="0 0 48 48"
                                                        style="fill: #000000;"
                                                    >
                                                        <path
                                                            d="M 15 4 C 14.476563 4 13.941406 4.183594 13.5625 4.5625 C 13.183594 4.941406 13 5.476563 13 6 L 13 7 L 7 7 L 7 9 L 8 9 L 8 25 C 8 26.644531 9.355469 28 11 28 L 23 28 C 24.644531 28 26 26.644531 26 25 L 26 9 L 27 9 L 27 7 L 21 7 L 21 6 C 21 5.476563 20.816406 4.941406 20.4375 4.5625 C 20.058594 4.183594 19.523438 4 19 4 Z M 15 6 L 19 6 L 19 7 L 15 7 Z M 10 9 L 24 9 L 24 25 C 24 25.554688 23.554688 26 23 26 L 11 26 C 10.445313 26 10 25.554688 10 25 Z M 12 12 L 12 23 L 14 23 L 14 12 Z M 16 12 L 16 23 L 18 23 L 18 12 Z M 20 12 L 20 23 L 22 23 L 22 12 Z"
                                                        ></path>
                                                    </svg>
                                                </div>
                                                <div
                                                    class="dropdown__menu__post-text"
                                                >
                                                    <button
                                                        class="focus:outline-none"
                                                        @click="$store.dispatch('deletePost',post.data.post_id);toggleMenu()">
                                                        Delete post
                                                    </button>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </transition>
                    </li>
                </ul>
            </div>
        </div>
      <PostEdit v-if="showModal" :post="post" :postKey="postKey"
       @toggleModal="toggleModal($event)"/>
          <div
            v-if="showModal"
            class="opacity-75 fixed inset-0 z-40 bg-gray-100"
        ></div>
    </div>
</template>
<script>
import PostEdit from "./PostEdit.vue"
import { mapGetters } from "vuex";
import Dropzone from "dropzone";
export default {
    Name: "PostMenu",
    props: ["post","postKey"],
    components:{
        PostEdit
    },
    data() {
        return {
            show: false,
            showModal: false,
           
    
        };
    },
    
    methods: {
        toggleModal: function (value) {
            this.showModal = !this.showModal;
            this.show = false;
        },
        toggleMenu(){
            this.$store.dispatch("fetchNewsPosts");
             this.show = false;
        }
      
       
    }
    
};
</script>
<style lang=""></style>
