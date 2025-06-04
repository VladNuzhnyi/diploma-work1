<template>

    <layout>
        <tiny :current-page="this.$router.currentRoute.name" :path="tinyNavPath"></tiny>

        <div class="container">
            <div class="mt-5 mb-5 grid">
                <div class="block row" v-for="item in items">
                    <div class="img col-5">
                        <img :src="getImgPath(item.images)" alt="">
                    </div>

                    <div class="col-7 p-4">
                        <h5 class="font-weight-bold">{{item.rent_item_title}}</h5>
                        <p class="h6 mb-2 ">Статус: <span :class="status_classes[item.status.id]">{{item.status.status_text}}</span></p>
                        <p class="h6 mb-2 ">Орендодавець: <span class="text-primary" style="text-decoration: underline; cursor:pointer;">{{`${item.item_owner.name} ${item.item_owner.second_name}`}}</span></p>
                        <p class="h6 mb-2 ">{{item.one_day_price}} грн/день</p>
                        <div class="w-100 d-flex justify-content-end">
                            <router-link :to="`my_rent_item/${item.id}`" class="btn btn-prm pl-5 pr-5 font-weight-light">Більше</router-link>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </layout>

</template>

<script>

    import MainLayout from "../common/MainLayout";
    import TinyNavigation from "../common/TinyNavigation";

    export default {
        name: "MyRent",
        components: {
            layout: MainLayout,
            tiny: TinyNavigation
        },
        data: function(){
            return {
                tinyNavPath: [
                    this.$router.currentRoute.name
                ],
                items: [],
                status_classes:{
                    1: 'text-muted',
                    2: 'text-success'
                }
            };
        },
        mounted() {
            this.loadMyRents();
        },
        methods:{
            loadMyRents: function () {
                this.$axios({
                    url: process.env.VUE_APP_API_URL + process.env.VUE_APP_RENT_GET_SELF,
                    withCredentials: true,
                    method: "get"
                })
                    .then(response => {
                        this.items = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            getImgPath: function (img) {
                if(img.length>=1){
                    return process.env.VUE_APP_SERVER_IMAGES_URL+"/"+img[0].img_name_hash;
                }
                return "";
            }
        }
    }
</script>

<style scoped>
    .block {
        background: #FFFFFF;
        box-shadow: 0px 4px 20px rgba(7, 0, 117, 0.14);
        border-radius: 6px;
        height: 200px;
        overflow: hidden;

    }

    .grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-column-gap: 40px;
        grid-row-gap: 40px;
    }

    p{
        margin-bottom: 0;
    }

    .img{
        background-position: center;
        background-repeat: no-repeat;
        overflow: hidden;
        display: flex;
        justify-content: center;
        padding: 0!important;
        height: 100%;
    }

    .img>img{
        height: 100%;
    }

    .btn-prm{
        height: 25px;
        display: flex;
        justify-content: center;
        align-items:center;
        font-size: 14px;
        padding: 0;
    }
</style>
