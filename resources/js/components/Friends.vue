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
                                class="dropdown__menu"
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
                                        <a
                                            href="#"
                                            class="dropdown__menu-link"
                                            title="Account"
                                        >
                                            <div class="dropdown__menu-svg">
                                                <svg viewBox="0 0 496 512">
                                                    <path
                                                        fill="currentColor"
                                                        d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm128 421.6c-35.9 26.5-80.1 42.4-128 42.4s-92.1-15.9-128-42.4V416c0-35.3 28.7-64 64-64 11.1 0 27.5 11.4 64 11.4 36.6 0 52.8-11.4 64-11.4 35.3 0 64 28.7 64 64v13.6zm30.6-27.5c-6.8-46.4-46.3-82.1-94.6-82.1-20.5 0-30.4 11.4-64 11.4S204.6 320 184 320c-48.3 0-87.8 35.7-94.6 82.1C53.9 363.6 32 312.4 32 256c0-119.1 96.9-216 216-216s216 96.9 216 216c0 56.4-21.9 107.6-57.4 146.1zM248 120c-48.6 0-88 39.4-88 88s39.4 88 88 88 88-39.4 88-88-39.4-88-88-88zm0 144c-30.9 0-56-25.1-56-56s25.1-56 56-56 56 25.1 56 56-25.1 56-56 56z"
                                                    />
                                                </svg>
                                            </div>
                                            <div class="dropdown__menu-text">
                                                <p
                                                    v-if="
                                                        requestsStatus.requestsStatus ===
                                                        'loading'
                                                    "
                                                ></p>

                                                <div
                                                    v-else-if="
                                                        requests.length < 1
                                                    "
                                                >
                                                    No requests found. Add new
                                                    friends!
                                                </div>
                                                <FriendRequest
                                                    v-else
                                                    v-for="(request,
                                                    requestKey) in requests.data"
                                                    :key="requestKey"
                                                    :request="request"
                                                />
                                            </div>
                                        </a>
                                    </li>
                                    <li class="dropdown__menu-item">
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
                                    </li>

                                    <!-- Dropdown Menu Separator -->
                                    <hr />
                                    <li class="dropdown__menu-item">
                                        <a
                                            href="#"
                                            class="dropdown__menu-link"
                                            title="Help"
                                        >
                                            <div class="dropdown__menu-svg">
                                                <svg viewBox="0 0 512 512">
                                                    <path
                                                        fill="currentColor"
                                                        d="M256 340c-15.464 0-28 12.536-28 28s12.536 28 28 28 28-12.536 28-28-12.536-28-28-28zm7.67-24h-16c-6.627 0-12-5.373-12-12v-.381c0-70.343 77.44-63.619 77.44-107.408 0-20.016-17.761-40.211-57.44-40.211-29.144 0-44.265 9.649-59.211 28.692-3.908 4.98-11.054 5.995-16.248 2.376l-13.134-9.15c-5.625-3.919-6.86-11.771-2.645-17.177C185.658 133.514 210.842 116 255.67 116c52.32 0 97.44 29.751 97.44 80.211 0 67.414-77.44 63.849-77.44 107.408V304c0 6.627-5.373 12-12 12zM256 40c118.621 0 216 96.075 216 216 0 119.291-96.61 216-216 216-119.244 0-216-96.562-216-216 0-119.203 96.602-216 216-216m0-32C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8z"
                                                    />
                                                </svg>
                                            </div>
                                            <div
                                                class="dropdown__menu-text"
                                            ></div>
                                        </a>
                                    </li>
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
        //   this.$store.dispatch("fetchFriendRequests", 2);
    },
    computed: {
        ...mapGetters({
            authUser: "authUser",
            friendship: "modalfriendship",
            requests: "modalrequests",
            requestsStatus: "lrequestsStatus",
            friendButtonText: "modalfriendButtonText",
            requestSender: "requestSender",
        }),
    },
};
</script>
<style lang=""></style>
