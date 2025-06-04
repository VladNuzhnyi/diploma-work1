import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);


export const store = new Vuex.Store({
    state: {
        isLoggedIn: localStorage.isLoggedIn,
        loginId: localStorage.loginId,
        userName: localStorage.userName,
        isLoading : false
    },
    mutations: {
        loginUser(state, payload) {
            localStorage.isLoggedIn = true;
            localStorage.loginId = payload.loginId;
            localStorage.userName = payload.userName;
            state.isLoggedIn = true;
            state.loginId = payload.loginId;
            state.userName = payload.userName;
        },
        logoutUser(state){
            state.isLoggedIn = false;
            state.loginId = null;
            state.userName = null;
        },
        changeLoading(state, payload){
            state.isLoading = payload.isLoading;
        }
    },
    getters: {
        isLoggedIn (state) {
            return state.isLoggedIn
        },
        loginId (state) {
            return state.loginId
        },
        userName(state){
            return state.userName;
        },
        getLoading(state){
            return state.isLoading;
        }
    }
});

