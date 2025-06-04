<template>
    <div class="search-wrapper">
        <div class="container">
            <search @filter="filter"></search>
        </div>
    </div>
</template>

<script>

    import Search_pane from "./Search_pane";

    export default {
        name: "Search",
        components: {
            'search': Search_pane
        },
        methods: {
            filter: function (filters) {
                this.$emit('filter', filters);
            }
        }
    }
</script>

<style>
    .v-select {
        width: 100% !important;
        height: 100%;
    }

    .v-select > div {
        background: #fff;
        height: 100%;
    }
</style>

<style scoped>

    .sort {
        webkit-box-shadow: 0 16px 30px rgba(108, 99, 255, .25);
        box-shadow: 0 16px 30px rgba(108, 99, 255, .25);
        border-radius: 0 0 4px 4px;
        z-index: 4;
        position: relative;
        padding-left: 30px;
        background: #fff;
    }
    .sort span{
        font-style: normal;
        font-weight: 600;
        font-size: 12px;
        line-height: 16px;
        color: #595959;
        background: #fff;
        position: relative;
    }
    .prom_ads .for_ads {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-column-gap: 15px;
        grid-row-gap: 15px;
    }

    .electronic .for_ads {
        display: grid;
        grid-template-columns: 1fr;
        grid-column-gap: 15px;
        grid-row-gap: 15px;
    }

    .electronic .item {
        height: 385px;
    }

    .electronic .for_ads .item .bottom_info {
        min-height: 43px !important;
    }

    .for_ads .item .bottom_info {
        height: 55px;
        padding: 7px;
    }

    .for_ads .item {
        height: 184px;
    }

    .item {
        overflow: hidden;
        border-radius: 4px;
        height: 383px;
        background-image: url('../../assets/RF_24-240mm_on_cruise_209865953695097.jpg');
        background-position: center;
        background-size: cover;
        position: relative;
        background-repeat: no-repeat;
    }

    .search-wrapper {
    }

    .bottom_info {
        min-height: 59px;
        width: 100%;
        position: absolute;
        bottom: 0;
        color: #fff;
        padding: 15px;
        display: flex;
        flex-direction: column;
    }

    .container {
        position: relative;
        z-index: 1;

    }

    input {
        background: #fff;
        height: 39px;
    }

    #searchBar {
        border-radius: 4px;
        padding: 30px 30px 7px 30px;
        /*max-width: 992px;*/
        width: 100%;
        background-color: rgba(88, 134, 253, 0.8);

    }


    .search_button:focus {
        color: #fff !important;
    }

    .categories {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        margin-top: 70px;
        grid-row-gap: 15px;
    }

    .category {
        display: flex;
        justify-content: center;
        align-items: flex-end;
    }

    .category a {
        display: flex;
        flex-direction: column;
        color: #000;
        font-size: 18px;
    }

    .category p {
        margin-top: 5px;
        text-align: center;
    }
</style>
