<template>
    <div class="position-relative wrapper">
        <layout>
            <div class="container">
                <t-nav :current-page="this.$router.currentRoute.name" :path="tinyNavPath"></t-nav>
                <div class="row item_info d-flex justify-content-between">
                    <photos :mainPhotoUrl="item.images[0]" :other-photos="item.images" class="col-lg"></photos>
                    <pricing
                        :item_title="item.item_title"
                        :amount="item.one_day_price"
                        :user="item.user.name+' '+item.user.second_name"
                        :city="item.region.region_name"
                        :deposit="item.deposit"
                        :min_rent_time="item.min_rent_days"
                        :sending_to_other_cities="'так'"
                        :category="item.category.category_name"
                        :rating="item.user.rating"
                        class="col-lg"></pricing>
                    <calendar :dates="item.rents" class="col-lg"></calendar>
                </div>
                <div class="similar_offer row">
                    <div class="similar_offer_text">
                        Подібні пропозиції
                    </div>
                    <div class="similar_offer_cards_wrapper d-flex align-items-center flex-nowrap overflow-auto">
                        <similar-item
                                v-for="item in item.similar"
                                :name="item.item_title"
                                :price="item.one_day_price"
                                :img-url="item.images[0]"
                                :id="item.id"
                                class="offer_elem"
                        />
                    </div>
                </div>
                <item-info :descriptionText="item.description" class="item_description row"></item-info>
            </div>
        </layout>
    </div>
</template>

<script>
    import MainLayout from '../common/MainLayout'
    import TinyNavigation from '../common/TinyNavigation'
    import ItemPhotos from './ItemPhotos'
    import Paginate from 'vuejs-paginate'
    import Pricing from './Pricing'
    import Calendar from './Calendar'
    import SimilarItemCard from './SimilarItemCard'
    import ItemInfo from "./ItemInfo";

    export default {
        name: "ItemPage",
        components: {
            "layout": MainLayout,
            "t-nav": TinyNavigation,
            "photos": ItemPhotos,
            "paginate": Paginate,
            "pricing": Pricing,
            "calendar": Calendar,
            "similar-item": SimilarItemCard,
            "item-info": ItemInfo,
        },
        data: function () {
            return {
                item: {
                    user:{
                        name:"",
                    },
                    images:[],
                    rents:[]
                },
                tinyNavPath: [
                    'Пошук',
                    this.$router.currentRoute.name,
                ],
            };
        },
        mounted: function(){
            this.loadData();
        },
        methods: {
            loadData: function () {
                this.$axios({
                    url: process.env.VUE_APP_API_URL+ process.env.VUE_APP_GET_ADS+"/"+this.$route.params.id,
                    withCredentials: true,
                    method: "get"
                })
                    .then(response => {
                        this.item = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
        watch: {
            $route(to, from) {
                this.loadData();
            }
        }
    }
</script>

<style scoped>
    .similar_offer {
        height: 297px;
        background: #FFFFFF;
        box-shadow: 0 4px 20px rgba(7, 0, 117, 0.14);
        border-radius: 6px;
        padding: 10px;
    }

    .item_info {
        margin-bottom: 16px;
    }

    .offer_elem {
        margin: 0 25px 0 25px;
    }

    .item_description {
        min-height: 217px;
        margin-top: 21px;
        /*margin-bottom: 82px;*/
    }

    .similar_offer_text {
        font-weight: bold;
        font-size: 22px;
        line-height: 30px;
    }

    .similar_offer_cards_wrapper::-webkit-scrollbar {
        height: 5px;
    }

    .similar_offer_cards_wrapper::-webkit-scrollbar-track {
        background-color: #fff;
    }

    .similar_offer_cards_wrapper::-webkit-scrollbar-thumb {
        background-color: rgba(77, 110, 197, 0.38);
        border-radius: 17px;
    }

    .wave {
        position: absolute;
        left: 0;
        bottom: 0;
    }
    .wrapper{
        padding-bottom: 65px;
    }
    .background_circle{
        position: absolute;
        bottom: 0;
        right: 0;
    }
</style>
