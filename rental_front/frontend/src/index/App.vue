<template>
    <div id="main">

        <div class="container">
            <header class="d-flex justify-content-between align-items-center">
                <ul id="main_menu">
                    <li>
                        <router-link class="main-menu-link" to="/">Головна</router-link>
                    </li>
                    <li>
                        <router-link class="main-menu-link" to="/add_item">Створити оголошення</router-link>
                    </li>
                    <li>
                        <router-link class="main-menu-link" to="/add_item">Чат</router-link>
                    </li>
                    <li>
                        <router-link class="main-menu-link" to="/add_item">Допомога</router-link>
                    </li>
                </ul>
                <userFastSettings v-if="$store.getters.isLoggedIn"></userFastSettings>
                <a v-if="!$store.getters.isLoggedIn" href="/authorize#/login">
                    <input value="Увійти" type="submit" class="btn btn-primary login_button"/>
                </a>
            </header>

        </div>
        <img src="./assets/right_top.svg" id="right_top" alt="">
        <img src="./assets/left_top.svg" id="left_top" alt="">
        <transition name="fade" mode="out-in">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>

    import userFastSettings from "./components/common/UserFastSettings"
    import Cookies from 'js-cookie'

    export default {
        components: {
            'userFastSettings': userFastSettings,
        },
        mounted() {
            let jwt = Cookies.get('jwt');
            if (jwt === undefined) {
                this.$store.commit('logoutUser');
            }
        }
    }
</script>

<style scoped>


    .fade-enter-active, .fade-leave-active {
        transition: opacity .3s;
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */
    {
        opacity: 0;
    }

    #main {
        box-shadow: inset 0px 100px 70px rgba(108, 99, 255, 0.1);

    }

    .container {
        position: relative;
        z-index: 3;
    }

    header {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
    }

    header ul > li {
        display: inline;
        margin-right: 31px;
        font-size: 19px;
        font-weight: bold;
    }

    header ul {
        padding-left: 20px;
        list-style-type: none;
        margin-top: 41px;
        border-bottom: 2px solid #6359FF;
        padding-bottom: 11px;
    }

    header ul a {
        position: relative;
        top: 1px;
        color: #000;
        padding-bottom: 13px;
    }

    .main-menu-link{
        color:var(--main-color);
        font-weight: 500;
    }
    .main-menu-link:first-child:hover {
        border-bottom: 2px solid var(--highlight-color);
        color: var(--highlight-color);
        text-decoration: none;
    }

    .login_button {
        font-family: "Rubik", sans-serif;
        font-weight: bold;
        font-size: 19px;
        line-height: 26px;
        padding: 8px 28px;
        background: #6C63FF;
        border-radius: 6px;
        border-color: #6C63FF;
    }

    .login_button:hover {
        color: #000000;
    }

    .login_button:active {
        background: #6C63FF !important;
        border-color: #6C63FF !important;
        color: #000000 !important;
    }

    #left_top {
        position: absolute;
        left: 0;
        top: 0;
        z-index: 1;
    }

    #right_top {
        position: absolute;
        top: 0;
        right: 0;
        z-index: 1;
    }

    header ul > li {
        display: inline;
        margin-right: 31px;
        font-size: 19px;
        font-weight: bold;
    }


    .main-menu-link:first-child:hover {
        text-decoration: none;
    }

    .login_button {
        font-family: "Rubik", sans-serif;
        font-weight: bold;
        font-size: 19px;
        line-height: 26px;
        padding: 8px 28px;
        background: #6C63FF;
        border-radius: 6px;
        border-color: #6C63FF;
    }

    .login_button:hover {
        color: #000000;
    }

    .login_button:active {
        background: #6C63FF !important;
        border-color: #6C63FF !important;
        color: #000000 !important;
    }
</style>

<style>


    * {
        --main-color:#273D75 ;
        --secondary-color:#6E7DA2;
        --highlight-color:#5886FD;
        font-family: 'Rubik', sans-serif;
        color:var(--main-color);
    }

    .text-muted{
        color: var(--secondary-color)!important;
    }

    h1,h2,h3,h4{
        border-left: 4px solid var(--highlight-color);
        padding-left: 3px;
    }

    #swal2-title{
        border-left: none;
    }

    .toast-message{
        color:#fff!important;
    }

    .btn-prm {
        height: 43px;
        background: var(--highlight-color);
        border-radius: 4px;
        color: #fff;
        font-weight: normal!important;
    }


    .btn-prm:hover {
        color: #fff!important;
        background: #466bca !important;
    }


</style>
