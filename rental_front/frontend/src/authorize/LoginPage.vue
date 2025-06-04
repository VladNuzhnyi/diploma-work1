<template>
    <div class="login d-flex justify-content-center align-items-center flex-column">
        <div class="fields d-flex align-items-center flex-column justify-content-between">
            <span class="title">Вхід</span>
            <input v-model="email" type="email" placeholder="Введіть email">
            <input v-model="password" type="password" placeholder="Введіть пароль">
            <div @click="login" class="button" :class="{ loading_button : isLoading }">{{ loginButtonText }}</div>
            <span class="registration">Або <router-link style="color: #FF695E;"
                                                        to="/registration">Зареєструватись</router-link></span>
            <div class="social d-flex justify-content-between align-items-center w-100">
                <div class="network google">
                    <img class="social_logo" src="static/google_logo.svg" alt="">
                    <span>Зареєструватись</span>
                </div>
                <div class="network facebook">
                    <img class="social_logo" src="static/facebook_logo.svg" alt="">
                    <span>Зареєструватись</span>
                </div>
            </div>
        </div>
        <div v-if="this.info" class="info">{{info}}</div>
    </div>
</template>

<script>
    export default {
        name: "LoginPage",
        data: function () {
            return {
                email: "",
                password: "",
                info: "",
                email_not_valid: true,
                isLoading : false,
                loginButtonText : 'Зареєструватись'
            }
        },
        methods: {
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
                        //redirect to main page after login
                        //use this here instead of router.push()
                        window.location.replace("/");
                    })
                    .catch(error => {
                        this.loadingButton(false);
                        if(error.response.status === 500)
                            this.info = "unexpected error";
                        else
                            this.info = error.response.data;
                    });
                this.loadingButton(true);
            },
            loadingButton: function (activate) {
                if(activate){
                    this.isLoading = true;
                    this.loginButtonText = 'Вхід...';
                }else{
                    this.isLoading = false;
                    this.loginButtonText = 'Увійти';
                }
            },
        }
    }
</script>

<style scoped>
    .login {
        background: radial-gradient(50% 50% at 50% 50%, #6C63FF 0%, rgba(68, 57, 252, 0.8) 100%);
        box-shadow: inset 0 100px 70px rgba(108, 99, 255, 0.1);
        width: 100%;
        height: 100%;
        font-family: "Roboto", sans-serif;
    }

    .title {
        font-size: 48px;
        line-height: 56px;
        color: #FFFFFF;
        margin-bottom: 22px;
    }

    .fields {

    }

    .fields input {
        padding: 10px;
        border: none;
        outline: 0;
        background: #FFFFFF;
        border-radius: 3px;
        width: 268px;
        height: 35px;
        font-size: 18px;
        box-sizing: border-box;
    }

    .fields input[type="email"] {
        margin-bottom: 13px;
    }

    .fields input[type="password"] {
        margin-bottom: 20px;
    }
    .loading_button{
        opacity: 0.5;
    }
    .button {
        color: white;
        background: #FF695E;
        border-radius: 6px;
        border: none;
        max-width: 268px;
        min-height: 41px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        justify-self: center;
        cursor: pointer;
        margin-bottom: 18px;
    }

    .button:active {
        background: #e96257;
    }

    .registration {
        color: #fff;
        margin-bottom: 20px;
    }

    .network {
        width: 130px;
        height: 35px;
        background: #FFFFFF;
        border-radius: 3px;
        font-size: 12px;
        line-height: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .network:active {
        background-color: #d6d6d6;
    }

    .social_logo {
        width: 19px;
        margin-right: 10px;
    }

    .info {
        font-size: 20px;
        margin-top: 20px;
        color: #e96257;
    }
</style>
