const state = {
    user: null
};

const getters = {
    authUser: state => {
        return state.user;
    }
};

const actions = {
    fetchAuthUser({commit, state}) {
        axios.get('/api/auth-user')
            .then((res) => {
                commit('setAuthUser', res.data);
            })
            .catch((err) => {
                console.log('Unable to fetch auth-user.\n' + err);
            });
    }
};

const mutations = {
    setAuthUser(state, user) {
        state.user = user;
    }
};

export default {
    state, getters, actions, mutations
}
