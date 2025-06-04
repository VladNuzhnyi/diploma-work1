<template>
    <div class="dropdown">
        <div id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div id="notifications">
                <img style="width: 24px;" src="../../assets/bell.svg" alt="">
                <div id="notification_number">99+</div>
            </div>
            <div id="username">
                {{userName}}
            </div>
            <div id="user_photo">
                <img src="../../assets/user.svg" alt="">
            </div>
        </div>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <router-link class="dropdown-item" to="/my_rent">
                <img class="dropdown_item_img" src="../../assets/rents.svg" alt="">
                <span class="dropdown_item_text">Мої оренди</span>
            </router-link>
            <router-link class="dropdown-item" to="/my_ads">
                <img class="dropdown_item_img" src="../../assets/ads.svg" alt="">
                <span class="dropdown_item_text">Мої оголошення</span>
            </router-link>
            <router-link class="dropdown-item" to="/add_item">
                <img class="dropdown_item_img" src="../../assets/new_ad.svg" alt="">
                <span class="dropdown_item_text">Додати оголошення</span>
            </router-link>
            <router-link class="dropdown-item" to="/">
                <img class="dropdown_item_img" src="../../assets/home.756c2a86.svg" alt="">
                <span class="dropdown_item_text">Головну</span>
            </router-link>
            <a class="dropdown-item" href="#">
                <img class="dropdown_item_img" src="../../assets/help.svg" alt="">
                <span class="dropdown_item_text">Допомога</span>
            </a>
            <a @click="logout" class="dropdown-item">
                <img class="dropdown_item_img" src="../../assets/exit.svg" alt="">
                <span class="dropdown_item_text">Вийти</span>
            </a>
        </div>
    </div>
</template>

<script>
    import Cookies from 'js-cookie'

    export default {
        name: "userFastSettings",
        data: function () {
            return {
                userName : this.$store.getters.userName
            }
        },
        methods: {
            logout : function () {
                Cookies.remove('jwt');
                localStorage.isLoggedIn = false;
                localStorage.userName = null;
                localStorage.loginId = null;
                this.$store.commit('logoutUser');
            }
        }
    }
</script>

<style scoped>
    .dropdown_item_img{
        margin-right: 10px;
        width: 20px;
    }
    .dropdown_item_text{
        font-family: "Open Sans", sans-serif;
        font-style: normal;
        font-weight: 600;
        font-size: 15px;
        line-height: 20px;
    }
    #notification_number {
        font-family: "Open Sans", sans-serif;
        font-style: normal;
        font-weight: 600;
        font-size: 10px;
        line-height: 14px;
        background-color: #FD7474;
        border-radius: 20px;
        height: 20px;
        width: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #FFFFFF;
        position: absolute;
        top: -5px;
        left: 14px;
    }

    #notifications {
        position: relative;
    }
    #dropdownMenuButton{
        border-radius: 6px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-direction: row;
        background-color: #FFFFFF;
        padding: 7px 10px 7px 10px;
        height: 55px;
        min-width:200px;
    }
    #dropdownMenuButton:hover{
        cursor: pointer;
    }
    .dropdown-menu{
        z-index: 999;
        width: 100%;
        transform: translate3d(0px, 53px, 0px)!important;
    }
    .dropdown-item:active{
        background-color: #6359FF;
    }
    #username{
        margin: 0 13px 0 13px;
    }
</style>
