<template>
    <div>
        <div id="no_items" v-if="items.length === 0 && !this.$store.getters.getLoading">
            <img src="../../assets/RickAndMorty_MortySad1500_V2.gif" alt="">
            <span class="text-center">Уууупс..<br>Нічого не знайдено</span>
        </div>


        <div v-if="this.$store.getters.getLoading" class="preloader w-100 d-flex justify-content-center align-items-center">
            <div class="loadingio-spinner-pulse-a62m1uxuyg5"><div class="ldio-nt05sib3ab">
                <div></div><div></div><div></div>
            </div></div>
        </div>

        <div v-else class="container items">
            <div v-for="item in items">
                <item :title="item.item_title" :price="item.one_day_price"
                      :url="addPrefixToImageName(item)"
                      :description="item.description"
                      :id = "item.id"
                />
            </div>
        </div>
    </div>
</template>

<script>
    import SearchItem from './SearchItem'

    export default {
        name: "SearchItems",
        props: [
            "items"
        ],
        components: {
            "item": SearchItem
        },
        data: function () {
            return {
            };
        },
        methods: {
            addPrefixToImageName: function (imageName) {
                let data = imageName.images.length ? imageName.images[0].img_name_hash:"";
                return process.env.VUE_APP_SERVER_IMAGES_URL + data;
            },
        },
    }
</script>

<style scoped>
    @keyframes ldio-nt05sib3ab-1 {
        0% { top: 36px; height: 128px }
        50% { top: 60px; height: 80px }
        100% { top: 60px; height: 80px }
    }
    @keyframes ldio-nt05sib3ab-2 {
        0% { top: 41.99999999999999px; height: 116.00000000000001px }
        50% { top: 60px; height: 80px }
        100% { top: 60px; height: 80px }
    }
    @keyframes ldio-nt05sib3ab-3 {
        0% { top: 48px; height: 104px }
        50% { top: 60px; height: 80px }
        100% { top: 60px; height: 80px }
    }
    .ldio-nt05sib3ab div { position: absolute; width: 30px }.ldio-nt05sib3ab div:nth-child(1) {
        left: 35px;
        background: #6c63ff;
        animation: ldio-nt05sib3ab-1 1s cubic-bezier(0,0.5,0.5,1) infinite;
        animation-delay: -0.2s
    }
    .ldio-nt05sib3ab div:nth-child(2) {
        left: 85px;
        background: #8e87fc;
        animation: ldio-nt05sib3ab-2 1s cubic-bezier(0,0.5,0.5,1) infinite;
        animation-delay: -0.1s
    }
    .ldio-nt05sib3ab div:nth-child(3) {
        left: 135px;
        background: #ba63ff;
        animation: ldio-nt05sib3ab-3 1s cubic-bezier(0,0.5,0.5,1) infinite;
        animation-delay: undefineds
    }

    .loadingio-spinner-pulse-a62m1uxuyg5 {
        width: 200px;
        height: 200px;
        display: inline-block;
        overflow: hidden;
    }
    .ldio-nt05sib3ab {
        width: 100%;
        height: 100%;
        position: relative;
        transform: translateZ(0) scale(1);
        backface-visibility: hidden;
        transform-origin: 0 0; /* see note above */
        background: none;
    }
    .ldio-nt05sib3ab div { box-sizing: content-box; }

    .preloader{
        min-height: 467px;
    }
    .items {
        padding: 60px;
        display: grid;
        grid-template-columns: repeat(3,1fr);
        grid-column-gap: 100px;
        justify-items: center;
        align-items: center;
        grid-row-gap: 100px;
    }
    #no_items{
        margin-top:80px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    #no_items img{
        width: 200px;
    }

    #no_items span{
        font-weight: bold;
        font-size: 20px;
    }
</style>
