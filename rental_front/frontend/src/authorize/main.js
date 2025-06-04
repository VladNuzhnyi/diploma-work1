import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex';
import {store} from "../store"
import App from './App.vue'

import axios from 'axios';
import toastr from "toastr"
import LoginPage from "./LoginPage";
import RegistrationPage from "./RegistrationPage";


Vue.config.productionTip = false;
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.prototype.$axios = axios;
Vue.prototype.$toastr = toastr;

const router = new VueRouter({
    routes: [
          {
              path: '/login',
              component: LoginPage
          },
        {
            path : '/registration',
            component: RegistrationPage
        }
    ],
    scrollBehavior (to, from, savedPosition) {
        return new Promise((resolve, reject) => {
                setTimeout(() => {
                    resolve({x: 0, y: 0})
                }, 500)
            }
        );
    }
});

new Vue({
    router: router,
    render: h => h(App),
    store:store,
}).$mount('#app');

