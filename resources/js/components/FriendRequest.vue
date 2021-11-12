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
              
                <div class="flex-col dropdown__menu__friends-request">
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
                          <p class="text-xs pb-2 text-gray-700">{{friend_request.data.attributes.sent_at}}</p>
                        </div>
                     
                    </div>                 
                  </div>
                  <div class="mx-2 flex justify-center accept__friend" v-if="any">
                      <button
                          class="mr-2 py-1 px-4 bg-fb-blue rounded text-white text-base focus:outline-none"
                          @click="
                              $store.dispatch('acceptFriendRequest',friend_request.data.attributes.user_id); reloadRequests();showAccepted=true">
                          Confirm
                      </button>
                      <button                    
                          class="py-1 px-4 bg-gray-400 rounded text-black text-base focus:outline-none"
                          @click="$store.dispatch('ignoreFriendRequest',friend_request.data.attributes.user_id);reloadRequests();showIgnored=true">
                          Delete
                      </button>  
                  </div>
                  <div v-if="showAccepted" class=" flex justify-center accept__friend">
                      <p class="text-gray-500 mr-2 py-1 ">Request Accepted</p>
                  </div>
                  <div v-if="showIgnored" class=" flex justify-center accept__friend">
                      <p class="text-gray-500 mr-2 py-1 ">Request Ignored</p>
                  </div>
                                                     
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
      showAccepted:false,
       showIgnored:false,
       
    }
  },
  computed: {
    
    ...mapGetters({
 
      authUser: "authUser",
        user: "user",
        

    }),
     any() {
       return !this.showAccepted && !this.showIgnored 
     
   }
  },
  mounted() {  
     this.reloadRequests();
   
   
  },
   methods: {

   
     reloadRequests(){
        setTimeout(() => this.$store.dispatch("fetchAuthUser"), 5000);
        
     }
    
  },
};
</script>
<style lang=""></style>
