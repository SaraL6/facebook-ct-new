<template lang="">
    <div>
    
        <div v-for="friend_request in authUser.data.attributes.friend_requests">
            <a
              href="#"
               class="dropdown__menu-link"
               title="Account"
               >
            <div class="dropdown__menu-svg">
              
                  <img
                        :src="
                             'http://127.0.0.1:8000/storage/'+friend_request.user.profile_image.path"
                        alt="profile image for user"
                        class="w-8 h-8 object-cover rounded-full"
                    />
            </div>
            <div class="dropdown__menu-text">

            <p>{{ friend_request.user.name}} sent you a friend request.</p>
            <button

                class="mr-2 py-1 px-3 bg-blue-500 rounded"
                @click="
                    $store.dispatch('acceptFriendRequest',friend_request.user_id); reloadRequests()">
                Accept
            </button>

            <button
           
                class="py-1 px-3 bg-gray-400 rounded"
                @click="$store.dispatch('ignoreFriendRequest',friend_request.user_id);reloadRequests()">
                Ignore
            </button>

                                             
                                            </div>
                                        </a>
         
        </div>
        
    </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  Name: "FriendRequest",
  props: ["friend_request"],
  data() {
    return {
     
    }
  },
  computed: {
    ...mapGetters({
      // requestSender: "requestSender",
      authUser: "authUser",
        user: "user",
        

    }),
  },
  mounted() {
    
     reloadRequests();
   
  },
   methods: {
     reloadRequests(){
       
        this.$store.dispatch("fetchAuthUser");
     }
    
  },
};
</script>
<style lang=""></style>
