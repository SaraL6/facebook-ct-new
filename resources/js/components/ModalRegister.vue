<template>
    <div>
        <button
            class="w-full bg-green-400 mt-8 mb-4 text-white p-3 rounded-lg font-semibold text-lg"
            @click.prevent="show"
        >
            <a href="">Create New Account</a>
        </button>

        <modal
            name="modal-register"
            @opened="opened"
            :width="432"
            :height="400"
        >
            <div class="mx-4 flex flex-col my-4">
                <div class="mb-2 text-left">
                    <h3 class="text-lg font-medium">Sign Up</h3>
                    <p>It's quick and easy</p>
                </div>

                <hr />
                <form
                    method="POST"
                    class="w-80 p-4 flex flex-col bg-white rounded-lg"
                >
                    <input
                        id="name"
                        type="text"
                        class="mb-3 py-3 px-4 border border-gray-400 bg-gray-100 focus:outline-none rounded-lg focus:ring-1 ring-cyan-500"
                        name="name"
                        value=""
                        required
                        autocomplete="name"
                        autofocus
                        placeholder="Name"
                        ref="name"
                    />

                    <input
                        id="email"
                        type="email"
                        class="mb-3 py-3 px-4 border border-gray-400 focus:outline-none rounded-lg focus:ring-1 ring-cyan-500"
                        name="email"
                        value=""
                        required
                        autocomplete="email"
                        placeholder="Email adress"
                    />

                    <input
                        id="password"
                        type="password"
                        class="mb-3 py-3 px-4 border border-gray-400 focus:outline-none rounded-lg focus:ring-1 ring-cyan-500"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="Password"
                    />

                    <input
                        id="password-confirm"
                        type="password"
                        class="mb-3 py-3 px-4 border border-gray-400 focus:outline-none rounded-lg focus:ring-1 ring-cyan-500"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Confirm password"
                    />

                    <button
                        type="submit"
                        class="mx-24 bg-fb-green mb-4 text-white p-2 rounded-lg font-semibold text-lg"
                    >
                        Sign Up
                    </button>
                </form>
            </div>
        </modal>
    </div>
</template>

<script>
export default {
    name: "RegisterModal",
    methods: {
        show() {
            this.$modal.show("modal-register");
        },
        opened() {
            this.$refs.name.focus();
        },
        hide() {
            this.$modal.hide("modal-register");
        },
    },
    mount() {
        this.show();
    },
};
</script>
