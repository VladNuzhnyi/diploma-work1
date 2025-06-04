import Vue from "vue";
import VueRouter from "vue-router";
import Vuex from "vuex";
import { store } from "../store";
import App from "./App.vue";
import MainPage from "./components/index/MainPage";
import SearchResultPage from "./components/search/SearchResultPage";
import ItemPage from "./components/item_page/ItemPage";
import Invoice from "./components/invoice/Invoice";
import AddItem from "./components/add_item/AddItem";
import MyRent from "./components/my_rent/MyRent";
import MyAD from "./components/my_ads/MyAD";
import MyRentItem from "./components/my_rent_item/MyRentItem";
import axios from "axios";
import toastr from "toastr";
import { loadProgressBar } from "axios-progress-bar";
import "axios-progress-bar/dist/nprogress.css";
import VueSweetalert2 from "vue-sweetalert2";
// If you don't need the styles, do not connect
import "sweetalert2/dist/sweetalert2.min.css";

Vue.use(VueSweetalert2);

axios.interceptors.response.use(
    function(response) {
        return response;
    },
    function(error) {
        console.log(error);
        let exceptions = [422, 403];
        if (exceptions.includes(error.response.status)) {
            for (let i in error.response.data.errors) {
                toastr.error(error.response.data.errors[i]);
            }
        }
        return Promise.reject(error);
    }
);

Vue.config.productionTip = false;
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.prototype.$axios = axios;
Vue.prototype.$toastr = toastr;
loadProgressBar();

const router = new VueRouter({
    routes: [
        { path: "/", component: MainPage, name: "Головна" },
        {
            path: "/authorize",
            // component: LoginPage ,
            beforeEnter: (to, from, next) => {
                if (localStorage.isLoggedIn) {
                    next(from);
                } else {
                    next();
                }
            }
        },
        { path: "/search", component: SearchResultPage, name: "Пошук" },
        { path: "/item/:id", component: ItemPage, name: "Оголошення" },
        { path: "/invoice", component: Invoice },
        { path: "/add_item", component: AddItem, name: "Додати оголошення" },
        { path: "/my_rent", component: MyRent, name: "Мої оренди" },
        { path: "/my_ads", component: MyAD, name: "Мої оголошення" },
        {
            path: "/my_rent_item/:id",
            component: MyRentItem,
            name: "Орендований товар"
        }
    ],
    scrollBehavior(to, from, savedPosition) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                resolve({ x: 0, y: 0 });
            }, 500);
        });
    }
});

new Vue({
    router: router,
    render: h => h(App),
    store: store
}).$mount("#app");
