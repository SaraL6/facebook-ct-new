<template lang="">
    <div
        class="flex flex-col flex-1 h-screen overflow-y-hidden"
        v-if="authUser"
    >
        <Nav />

        <div class="flex overflow-y-hidden flex-1">
            <Sidebar v-if="showSidebar" />
            <div class="overflow-x-hidden w-full">
                <router-view :key="$route.fullPath">
                    
                </router-view>
            </div>
           
           
         
        </div>
        
    </div>
</template>

<script>
import Nav from "./Nav";
import Sidebar from "./Sidebar";

import { mapGetters } from "vuex";

export default {
    name: "App",
    components: {
        Nav,
        Sidebar,
    },
    data() {
        return {
            showSidebar:true,
        }
    },
    mounted() {
        this.$store.dispatch("fetchAuthUser");

      
    },
    created() {
        this.$store.dispatch("setPageTitle", this.$route.meta.title);
    },
    computed: {
        ...mapGetters({
            authUser: "authUser",
        }),
    },
    methods: {
        sidebarStatus(){
      
        }
    },
    watch: {
        $route(to, from) {
            this.$store.dispatch("setPageTitle", to.meta.title)
                    if (this.$route.meta.title === "Post" ){
                        this.showSidebar=false;
                       
        }else{
            this.showSidebar=true;
        }
            
        },
      
    
    },
};
</script>
<style lang=""></style>
