<template>
    <MainLayout>
        <div id="wrapper">
            <t-nav :current-page="this.$router.currentRoute.name" :path="tinyNavPath"></t-nav>
            <search @filter="sendFilterRequest"></search>
            <items :items="items"></items>
            <pagination
                    :page-count="pageCount"
                    :click-handler="nextPage"
                    :prev-text="'<'"
                    :next-text="'>'"
                    prev-link-class="page_arrow"
                    next-link-class="page_arrow"
                    :container-class="'pagination_wrapper'"
                    :no-li-surround="true"
                    page-link-class="search_item_paginate_page"
                    :initial-page="currentPage"
                    active-class="page_active"
                    :hide-prev-next="true"
            ></pagination>
        </div>
    </MainLayout>
</template>

<script>
    import MainLayout from '../common/MainLayout'
    import Search from './Search'
    import SearchItem from './SearchItem'
    import TinyNavigation from "../common/TinyNavigation";
    import Items from './Items'
    import Paginate from 'vuejs-paginate'


    export default {
        name: "SearchResultPage",
        components: {
            "MainLayout": MainLayout,
            "search": Search,
            "item": SearchItem,
            "t-nav": TinyNavigation,
            "items": Items,
            "pagination": Paginate
        },
        data: function () {
            return {
                tinyNavPath: [
                    this.$router.currentRoute.name,
                ],
                pageCount : 0,
                items : [],
                currentPage : 1,
                itemsPerPage: 27,
                filters:'',
                category:"",
                keyphrase:""
            };
        },
        methods: {
            getItems: function (
                categoty,
                key_phrase
            ) {

                let url = `${process.env.VUE_APP_API_URL}${process.env.VUE_APP_GET_ADS}?category=${categoty}&from=${this.from}&size=${this.size}`;
                if(key_phrase!== undefined){
                    url+=`&keyphrase=${key_phrase}`;
                }

                this.$store.commit('changeLoading', { isLoading: true });
                this.$axios({
                    method:"get",
                    url: url,
                    withCredentials: true
                }).then( response => {
                    this.pageCount = parseInt(response.data.total / this.size);
                    this.items = response.data.items;
                    this.$store.commit('changeLoading', { isLoading: false });
                }).catch( error => {
                    this.$toastr.error(error.response.message);
                    this.$store.commit('changeLoading', { isLoading: false });
                });
            },
            sendFilterRequest: function (value) {
                this.category = value.category;
                this.keyphrase = value.keyphrase;
                this.getItems(this.category, this.keyphrase);
                this.$router.push({path: '/search', query: value});
            },
            nextPage: function (page) {
                this.currentPage = page;
                this.getItems(this.category, this.keyphrase);
            }
        },
        computed:{
            from: function () {
                return (this.currentPage-1) * this.itemsPerPage;
            },
            size: function () {
                return this.itemsPerPage;
            }
        },
        created() {
            if(this.$route.query.category === undefined){
                this.$toastr.error('no category specified');
            }else {
                this.getItems(this.$route.query.category,this.$route.query.keyphrase);
            }
        }
    }
</script>
<style>
    .search_item_paginate_page , .page_arrow{
        height: 46px;
        width: 46px;
        border-radius: 25px;
        box-shadow: 0 2px 8px rgba(7, 0, 124, 0.2);
        margin: 0 20px 0 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-style: normal;
        font-weight: normal;
        font-size: 24px;
        line-height: 33px;
        font-family: "Open Sans", sans-serif;
        color: #04004E;
        cursor: pointer;
        background-color: #FFFFFF;
        text-decoration: none!important;
        outline: none!important;
    }
    .page_active{
        color: #FF695E;
    }
</style>
<style scoped>
    #wrapper {
        position: relative;
        z-index: 2;
    }

    .bottom_left {
        position: absolute;
        bottom: 0;
        left: 0;
        z-index: 5;
    }

    .pagination_wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: row;
        z-index: 6;
        position: relative;
        padding: 50px 0 50px 0;
    }
</style>
