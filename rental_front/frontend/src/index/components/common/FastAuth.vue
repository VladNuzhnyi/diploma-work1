<template>
    <transition name="fade">
        <div class="overlay" v-if="show" >
            <div class="auth pt-4">
                <img id="rick_morty" src="../../assets/Rick_morty.png" alt="">
                <div class="fieleds">
                    <p class="pb-5">Ви не ввійшли в систему</p>
                    <input v-model="email" type="email" placeholder="Введіть email" class="mb-2 p-3">
                    <input v-model="password" type="password" placeholder="Введіть пароль" class="p-3">
                    <button @click="login" class="login">Увійти</button>
                    <span class="mt-3 text-danger font-weight-bold">{{info}}</span>
                    <div class="social d-flex justify-content-between align-items-center w-100">
                        <button class="btn network google">
                            <img class="social_logo" src="static/google_logo.svg" alt="">
                            <span>Зареєструватись</span>
                        </button>
                        <button class="btn network facebook">
                            <img class="social_logo" src="static/facebook_logo.svg" alt="">
                            <span>Зареєструватись</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        name: "FastAuth.vue",
        data:function () {
            return {
                email:"",
                password:"",
                info:""
            }
        },
        props:[
            "show"
        ],
        methods:{
            login: function () {
                let data = {
                    "email": this.email,
                    "password": this.password,
                };
                this.$axios({
                    method: 'post',
                    url: process.env.VUE_APP_API_URL + process.env.VUE_APP_LOGIN_USER,
                    withCredentials: true,
                    data: data
                })
                    .then(response => {
                        let payload = {
                            loginId: response.data.user_data.id,
                            userName: response.data.user_data.first_name+" "+response.data.user_data.last_name,
                        };
                        this.$store.commit('loginUser', payload);
                        this.$emit('loggedIn');
                    })
                    .catch(error => {
                        if(error.response.status === 500)
                            this.info = "unexpected error";
                        else
                            this.info = error.response.data;
                    });
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
    .hidden{
        display: none!important;
    }

    .overlay {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 99999;
        background-color: rgba(0, 0, 0, 0.2);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .auth {
        width: 430px;
        height: 586px;
        background: #fff;
        border-radius: 7px;
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }
    .auth .fieleds{
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
    }

    .auth button.login{
        background: #B163FF;
        min-width: 268px;
        min-height: 41px;
        border-radius: 3px;
        color:#fff;
        border:none;
        margin-top:25px;
    }
    .social_logo {
        width: 19px;
        margin-right: 10px;
    }


    .network {
        margin-top: 30px;
        background: #EFEFEF;
        border-radius: 3px;
        font-size: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 50px;
        padding: 0 15px;
    }

    .network:active {
        background-color: #d6d6d6;
    }

    #rick_morty {
        position: absolute;
        z-index: 0;
        left: 10px;
        top:20px
    }

    .auth p {
        font-weight: bold;
        font-size: 30px;
    }

    .auth input:first-of-type{
        margin-top: 110px;
    }

    .auth input {
        height: 52px;
        border: 3px solid #3B5998;
        border-radius: 3px;
        min-width: 326px;
        background: #fff!important;
    }
</style>
