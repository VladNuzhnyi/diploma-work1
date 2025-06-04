<template>

    <layout>
        <FastAuth :show="!$store.getters.isLoggedIn"></FastAuth>
        <tiny :current-page="this.$router.currentRoute.name" :path="tinyNavPath"></tiny>

        <div class="block container p-5 mb-5">
            <h3 class="font-weight-bold ">Фото</h3>
            <span class="text-muted small mb-5">Завантаж мінімум 2 фото</span>
            <carousel @files_changed="updateFiles" :no-photo="noPhoto"></carousel>
            <form class="mt-5" @submit.prevent="validate">
                <div class="row">
                    <div class="col">
                        <span class="text-muted small">Назва</span>
                        <input v-model="title" type="text" class="form-control" :class="{'is-invalid' : !title && submit}" placeholder="Введи назву оголошення">
                    </div>
                    <div class="col">
                        <span class="text-muted small">Мінімальний термін оренди (дні)</span>
                        <input v-model="minDayCount" type="number" class="form-control" :class="{'is-invalid' : (minDayCount < 1) && submit}" placeholder="3">
                    </div>
                    <div class="col">
                        <span class="text-muted small">Ціна за день (грн)</span>
                        <input v-model="dailyPrice" :class="{'is-invalid' : (dailyPrice < 0 || !dailyPrice) && submit}"type="text" class="form-control" placeholder="300">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <span class="text-muted small">Регіон оренди</span>
                        <select v-model="region" :class="{'is-invalid': !region && submit}" class="form-control">
                            <option v-for="reg in regions" :value="reg.id">{{reg.region_name}}</option>
                        </select>
                    </div>
                    <div class="col">
                        <span class="text-muted small">Висилка до других міст</span>
                        <select v-model="allow_sending_to_other_city" class="form-control">
                            <option value="true">Так</option>
                            <option value="false">Ні</option>
                        </select>
                    </div>
                    <div class="col">

                        <span class="text-muted small">Застава</span><br>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" v-model="requiredDeposit" class="d-inline mr-2"> <span class="mr-4">Обов'язкова</span>
                            <input :disabled="!requiredDeposit" v-model="deposit" type="number" class="form-control"
                                   placeholder="1000 грн">
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col d-flex flex-column justify-content-end">
                        <span class="text-muted small">Категорія</span>
                        <select v-model="category" :class="{'is-invalid': !category && submit}" class="form-control">
                            <option v-for="cat in categories" :value="cat.id">{{cat.category_name}}</option>
                        </select>
                    </div>
                    <div class="col">
                        <div class="text-muted small">Адреса отримання</div>
                        <div class="d-flex align-items-center">
                            <input v-model="address" type="text" class="form-control" :class="{'is-invalid': !address && submit}" placeholder="бульвар Лесі Українки 9">
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="text-muted small">Опис оголошення</div>
                    <textarea v-model="description" class="form-control" :class="{'is-invalid': !description && submit}" rows="5" placeholder="Введи тут опис оголошення"></textarea>
                </div>
                <div class="w-100 d-flex justify-content-end mt-5 mb-4">
                    <input type="submit" value="Зберегти" class="pl-4 pr-4 btn btn-prm">
                </div>

            </form>
        </div>

    </layout>

</template>

<script>
    import TinyNavigation from "../common/TinyNavigation";
    import MainLayout from "../common/MainLayout";
    import FilesCarousel from "./FilesCarousel";
    import FastAuth from "../common/FastAuth";

    export default {
        name: "AddItem",
        components: {
            FastAuth,
            tiny: TinyNavigation,
            layout: MainLayout,
            carousel: FilesCarousel
        },
        data: function () {
            return {

                regions: [],
                categories:[],


                files: [],
                tinyNavPath: [
                    this.$router.currentRoute.name
                ],
                title: "",
                minDayCount: 1,
                dailyPrice: "",
                allow_sending_to_other_city: false,
                category: "",
                address: "",
                description: "",
                region: "",
                additional_parameters: {},
                deposit: null,
                requiredDeposit: false,
                isValid: {
                    title : true,
                },
                submit : false,
            };
        },
        mounted() {
            this.loadRegions();
            this.loadCategories();
        },
        computed : {
            noPhoto: function () {
                 return !this.files.length && this.submit;
            }
        },
        methods: {

            loadRegions: function(){
                this.$axios({
                    url: process.env.VUE_APP_API_URL+ process.env.VUE_APP_GET_REGIONS,
                    withCredentials: true,
                    method: "get"
                })
                    .then(response => {
                        this.regions = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },

            loadCategories: function(){
                this.$axios({
                    url: process.env.VUE_APP_API_URL+ process.env.VUE_APP_GET_CATEGORIES,
                    withCredentials: true,
                    method: "get"
                })
                    .then(response => {
                        this.categories = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },

            createAd: function () {
                let data = {
                    "images": this.files,
                    "title": this.title,
                    "min_day_count": this.minDayCount,
                    "daily_price": this.dailyPrice,
                    "allow_sending_to_other_city": (this.allow_sending_to_other_city === "true"),
                    "category": this.category,
                    "address": this.address,
                    "description": this.description,
                    "region": this.region,
                    "deposit": parseFloat(this.deposit),
                    "additional_parameters": [
                        "param1", "param2"
                    ]
                };

                this.$axios({
                    url: process.env.VUE_APP_API_URL + process.env.VUE_APP_CREATE_AD,
                    method: 'post',
                    withCredentials: true,
                    data: data
                })
                    .then(response => {
                        this.$toastr.success(response.data);
                    })
                    .catch(error => {
                        console.log(error.response);
                    })
            },

            updateFiles: function (files) {
                this.files = files;
            },

            validate : function () {
                this.submit = true;
                if(!this.title || this.minDayCount < 1 || !this.category || !this.region || !this.address || !this.description || this.noPhoto || (this.dailyPrice < 0 || !this.dailyPrice)){
                    return;
                }
                this.createAd();
            }
        }
    }
</script>

<style scoped>
    .block {
        background-color: #FFFFFF;
        box-shadow: 0 4px 20px rgba(7, 0, 117, 0.14);
        border-radius: 6px;
        margin-bottom: 67px;
    }

</style>
