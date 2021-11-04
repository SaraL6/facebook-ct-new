<template lang="">
    <div v-if="requestSender " >
        Request from {{ requestSender }}

        <div
            v-if="requestSender !== '' && requestSender !== 'No Friend Requests'">
            <button
                v-if="requestSender"
                class="mr-2 py-1 px-3 bg-blue-500 rounded">
                Accept
            </button>

            <button v-if="requestSender" class="py-1 px-3 bg-gray-400 rounded">
                Ignore
            </button>
        </div>
    </div>
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
