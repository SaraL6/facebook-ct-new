<template lang="">
    <div>
        <div class="header">
            <div class="header__nav">
                <ul class="header__navbar">
                    <li class="header__item">
                        <a href="#" class="header__link">
                            <transition name="slide-fade">
                                <!-- Header Navigation Menu Icons -->
                                <button
                                    class="header--button"
                                    v-if="showFriends"
                                    key="on"
                                    @click="showHide(false)"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        class="header--icon"
                                    >
                                        <title>Close</title>
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path
                                            fill="currentColor"
                                            d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z"
                                        />
                                    </svg>
                                </button>
                                <button
                                    class="header--button"
                                    v-else
                                    key="off"
                                    @click="showHide(true)"
                                    :load="log(showFriends)"
                                >
                                    <svg
                                        viewBox="0 0 28 28"
                                        class="header--icon"
                                    >
                                        <path
                                            fill="currentColor"
                                            d="M10.5 4.5c-2.272 0-2.75 1.768-2.75 3.25C7.75 9.542 8.983 11 10.5 11s2.75-1.458 2.75-3.25c0-1.482-.478-3.25-2.75-3.25zm0 8c-2.344 0-4.25-2.131-4.25-4.75C6.25 4.776 7.839 3 10.5 3s4.25 1.776 4.25 4.75c0 2.619-1.906 4.75-4.25 4.75zm9.5-6c-1.41 0-2.125.841-2.125 2.5 0 1.378.953 2.5 2.125 2.5 1.172 0 2.125-1.122 2.125-2.5 0-1.659-.715-2.5-2.125-2.5zm0 6.5c-1.999 0-3.625-1.794-3.625-4 0-2.467 1.389-4 3.625-4 2.236 0 3.625 1.533 3.625 4 0 2.206-1.626 4-3.625 4zm4.622 8a.887.887 0 00.878-.894c0-2.54-2.043-4.606-4.555-4.606h-1.86c-.643 0-1.265.148-1.844.413a6.226 6.226 0 011.76 4.336V21h5.621zm-7.122.562v-1.313a4.755 4.755 0 00-4.749-4.749H8.25A4.755 4.755 0 003.5 20.249v1.313c0 .518.421.938.937.938h12.125c.517 0 .938-.42.938-.938zM20.945 14C24.285 14 27 16.739 27 20.106a2.388 2.388 0 01-2.378 2.394h-5.81a2.44 2.44 0 01-2.25 1.5H4.437A2.44 2.44 0 012 21.562v-1.313A6.256 6.256 0 018.25 14h4.501a6.2 6.2 0 013.218.902A5.932 5.932 0 0119.084 14h1.861z"
                                        ></path>
                                    </svg>
                                </button>
                            </transition>
                        </a>
                        <!-- Dropdown Menu -->
                        <transition name="dropdown">
                            <div
                                class="dropdown__menu shadow-md"
                                v-bind:class="{ active: showFriends }"
                                v-if="showFriends"
                                :load="log(showFriends)"
                            >
                                <div
                                    class="dropdown__title px-4 text-lg font-medium"
                                >
                                    Friend Requests
                                </div>
                                <ul class="dropdown__menu-nav">
                                    <li class="dropdown__menu-item">
                                    <li class="dropdown__menu-item">

                                                <FriendRequest/>
                                      
                                    </li>
                                    <!-- <li class="dropdown__menu-item">
                                        <a
                                            href="#"
                                            class="dropdown__menu-link"
                                            title="Personal info"
                                        >
                                            <div class="dropdown__menu-svg">
                                                <svg viewBox="0 0 576 512">
                                                    <path
                                                        fill="currentColor"
                                                        d="M512 32H64C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64zm32 384c0 17.6-14.4 32-32 32H64c-17.6 0-32-14.4-32-32V96c0-17.6 14.4-32 32-32h448c17.6 0 32 14.4 32 32v320zm-72-128H360c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zm0-64H360c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zm0-64H360c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zM208 288c44.2 0 80-35.8 80-80s-35.8-80-80-80-80 35.8-80 80 35.8 80 80 80zm0-128c26.5 0 48 21.5 48 48s-21.5 48-48 48-48-21.5-48-48 21.5-48 48-48zm46.8 144c-19.5 0-24.4 7-46.8 7s-27.3-7-46.8-7c-21.2 0-41.8 9.4-53.8 27.4C100.2 342.1 96 355 96 368.9V392c0 4.4 3.6 8 8 8h16c4.4 0 8-3.6 8-8v-23.1c0-7 2.1-13.8 6-19.6 5.6-8.3 15.8-13.2 27.3-13.2 12.4 0 20.8 7 46.8 7 25.9 0 34.3-7 46.8-7 11.5 0 21.7 5 27.3 13.2 3.9 5.8 6 12.6 6 19.6V392c0 4.4 3.6 8 8 8h16c4.4 0 8-3.6 8-8v-23.1c0-13.9-4.2-26.8-11.4-37.5-12.3-18-32.9-27.4-54-27.4z"
                                                    />
                                                </svg>
                                            </div>
                                            <div class="dropdown__menu-text">
                                                Personal info
                                            </div>
                                        </a>
                                    </li> -->

                                </ul>
                            </div>
                        </transition>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
import FriendRequest from "../components/FriendRequest";

export default {
    Name: "Friends",
    components: {
        FriendRequest,
    },
    props: ["showFriends"],

    methods: {
        log(item) {
            //   console.log("Friends" + item);
        },
        showHide(value) {
            this.$emit("showHide", value);
        },
    },
    mounted() {
   
    },
    computed: {
        ...mapGetters({
           
    
        }),
    },
};
</script>
<style lang=""></style>
