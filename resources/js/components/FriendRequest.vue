<template lang="">
    <div>
      <div v-if="authUser.data.attributes.friend_requests.data.length < 1" class="mx-4 mt-4">
        No friend Requests found. Expand your network !
      </div>
      
      <div v-else v-for="friend_request in authUser.data.attributes.friend_requests.data">
            <a
              href="#"
               class="dropdown__menu__friends-link"
               title="Account"
               >
              
                <div>
                  <div class="flex">
                    <div class="dropdown__menu__friends-profileImg mr-2">              
                      <img
                            :src="
                                'http://127.0.0.1:8000/storage/'+friend_request.data.attributes.user.profile_image.path"
                            alt="profile image for user"
                            class="object-cover rounded-full"
                        />
                    </div>
                    <div class="dropdown__menu__friends-text">
                     <strong>{{ friend_request.data.attributes.user.name}}</strong>  sent you a friend request.
                     <div>
                       <p class="text-xs pb-2">{{friend_request.data.attributes.sent_at}}</p>
                     </div>
                     
                    </div>
                  
                  </div>
                <div class="mx-2 flex justify-center accept__friend">
                     <button

                        class="mr-2 py-1 px-4 bg-fb-blue rounded text-white text-base"
                        @click="
                            $store.dispatch('acceptFriendRequest',friend_request.data.attributes.user_id); reloadRequests()">
                        Accept
                    </button>

                    <button
                  
                        class="py-1 px-4 bg-gray-400 rounded text-black text-base"
                        @click="$store.dispatch('ignoreFriendRequest',friend_request.data.attributes.user_id);reloadRequests()">
                        Ignore
                    </button>  
                </div>
                                                     
                </div>
            </a>
         
      </div>
        
    </div>
</template>
<script>
import { mapGetters } from "vuex";
import moment from 'moment';
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
     this.reloadRequests();
   
  },
   methods: {
     reloadRequests(){
       
        this.$store.dispatch("fetchAuthUser");
     }
    
  },
};
</script>
<style lang=""></style>
