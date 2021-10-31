<template>

        <a href="#" @click.prevent="logout()">Logout</a>

</template>

<script>
export default {
    name: "Logout",
    methods: {
        logout() {
            axios.post("/logout").catch((error) => {
                window.location.href = "/login";
            });
        },
    },
};
</script>
