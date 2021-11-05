<template lang="">
    <div>
    
        <div v-for="friend_request in this.authUser.data.attributes.friend_requests" >
            <p>{{ friend_request.user_id }}</p>
            <button

                class="mr-2 py-1 px-3 bg-blue-500 rounded"
                @click="
                    $store.dispatch('acceptFriendRequest',friend_request.user_id); reloadRequests()">
                Accept
            </button>

            <button
           
                class="py-1 px-3 bg-gray-400 rounded"
                @click="$store.dispatch('ignoreFriendRequest',friend_request.user_id); reloadRequests()">
                Ignore
            </button>
        </div>
        
    </div>
</template>
<script>
import { mapState,mapGetters } from "vuex";

export default {
  Name: "FriendRequest",
  props: ["friend_request"],
  data() {
    return {
     friend_requests: null
    }
  },
  computed: {
          ...mapState(["user", "setUploadedImageUrl"]),
  
    ...mapGetters({
      authUser: "authUser",
    }),
 },
  mounted() {
    
    this.$store.dispatch("fetchAuthUser");
    this.friend_requests=this.authUser.data.attributes.friend_requests;
   
  },
  methods: {
     reloadRequests(){
       
        this.$store.dispatch("fetchAuthUser");
        this.friend_requests=this.authUser.data.attributes.friend_requests;
     }
    
  },
  watch:{
      setUploadedImageUrl(){
        console.log('setUploadedImageUrl changed', this.authUser)
      },
  },


};
</script>
<style lang=""></style>
