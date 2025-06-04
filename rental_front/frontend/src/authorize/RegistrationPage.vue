<template>
    <div class="registration d-flex justify-content-center align-items-center flex-column">
        <form class="form-group fields d-flex align-items-center flex-column justify-content-between">
            <span class="title">Реєстрація</span>
            <div class="input_wrapper">
                <input v-model="email" class="form-control" :class="{'is-invalid': !email && submit}" type="email" placeholder="Введіть email">
            </div>
            <div class="input_wrapper">
                <input v-model="name" class="form-control" :class="{'is-invalid': !name && submit}" type="text" placeholder="Введіть ім'я">
            </div>
            <div class="input_wrapper">
                <input v-model="surname" class="form-control" :class="{'is-invalid': !surname && submit}" type="text" placeholder="Введіть прізвище">
            </div>
            <div class="input_wrapper">
                <input v-model="password" class="form-control" :class="{'is-invalid': !password && submit}" type="password" placeholder="Введіть пароль">
            </div>
            <div class="input_wrapper">
                <input v-model="repeatPassword" class="form-control" type="password" :class="{'is-invalid': (!repeatPassword && submit) || differentPasswords}" placeholder="Введіть пароль повторно">
                <span class="invalid-feedback d-block" v-if="differentPasswords">Паролі не збігаються</span>
            </div>
            <div @click="validate" class="button">Зареєструватись</div>
            <div class="d-flex justify-content-between align-items-center w-100">
                <div class="network">
                    <img class="social_logo" src="static/google_logo.svg" alt="">
                    <span>Зареєструватись</span>
                </div>
                <div class="network">
                    <img class="social_logo" src="static/facebook_logo.svg" alt="">
                    <span>Зареєструватись</span>
                </div>
            </div>
        </form>
        <div v-if="this.info" class="info">{{info}}</div>
    </div>
</template>

<script>
    export default {
        name: "RegistrationPage",
        data : function () {
            return {
                name : "",
                surname : "",
                email: "",
                password: "",
                repeatPassword: "",
                info: "",
                submit : false,
                differentPasswords: false,
            };
        },
        methods: {
            validate : function () {
                this.submit = true;
                if(!this.name || !this.surname || !this.email || !this.password || !this.repeatPassword){
                    return;
                }
                if(this.password !== this.repeatPassword){
                    this.differentPasswords = true;
                    return;
                }
                this.register();
            },
            register : function () {
                let data = {
                    "name": this.name,
                    "second_name": this.surname,
                    "email": this.email,
                    "password": this.password
                };
                this.$axios({
                    method: 'post',
                    url: process.env.VUE_APP_API_URL + process.env.VUE_APP_REGISTER_USER,
                    withCredentials: true,
                    data: data
                })
                    .then(response => {
                        this.$router.push('/login');
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
    .registration {
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
    .input_wrapper{
        margin-bottom: 13px;
        width: 100%;
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
    .network:nth-of-type(1){
        margin-right: 4px;
    }
    .network:nth-of-type(2){
        margin-left: 4px;
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
