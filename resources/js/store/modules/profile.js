const state = {
    user: null,
    userStatus: null,
};

const getters = {
    //After we set the user in the mutation we're send it to the front end with this
    user: state => {
        return state.user;
    }
};

const actions = {
    //this action is goint to be dispatched in App.vue
    //we get user from the frontend
    fetchUser({commit, state,user}) {
        axios.get('/api/auth-user')
            .then(res => {
                commit('setAuthUser', res.data);
                //res.data is gonna be what we pass to the user in setAuthUser mutation
            })
            .catch(error => {
                console.log('Unable to fetch auth user');
            });
    }
};
//mutations are how u can change the state declared in const state
const mutations = {
    setAuthUser(state, user) {
        state.user = user;
    }
};

export default {
    state, getters, actions, mutations,
}
