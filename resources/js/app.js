import Vue from "vue";
import router from "./router";
import App from "./components/App";
import store from "./store";
import VModal from "vue-js-modal";
import ModalRegister from "./components/ModalRegister";

Vue.use(VModal, { dynamicDefault: { resizable: true } });

require("./bootstrap");

const app = new Vue({
    el: "#app",

    components: {
        App,
        "modal-register": ModalRegister,
    },
    router,

    store,
});
