import Vue from "vue";
import router from "./router";
import App from "./components/App";
import store from "./store";
import Cloudinary from "cloudinary-vue";
require("./bootstrap");


Vue.use(Cloudinary, {
    configuration: { 
      cloudName: "ct-clone",
     }
  });



const app = new Vue({
    el: "#app",

    components: {
        App,
    },
    router,

    store,
});
