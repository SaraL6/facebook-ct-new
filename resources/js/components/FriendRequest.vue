<template lang="">
    <div>Request from {{ request.data.attributes.sent_by.name }}</div>
</template>
<script>
export default {
    Name: "FriendRequest",
    props: ["request"],
};
</script>
<style lang=""></style>
