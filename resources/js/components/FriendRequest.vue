<template lang="">
    <div v-if="requestSender">Request from {{ requestSender }}</div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
    Name: "FriendRequest",
    props: ["request"],
    computed: {
        ...mapGetters({
            requestSender: "requestSender",
        }),
    },
};
</script>
<style lang=""></style>
