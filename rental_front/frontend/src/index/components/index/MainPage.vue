<template>
    <div class="pb-5">
        <div class="container">
            <div class="d-flex justify-content-center">
                <search @filter="filter"></search>
            </div>

            <div class="categories">
                <router-link to="/search?category=Mieszkania">
                    <div class="category">
                        <img src="../../assets/home.svg" alt="">
                        <p>Квартири</p>
                    </div>
                </router-link>
                <router-link to="/search?category=Samochody">
                    <div class="category">
                        <img src="../../assets/car.svg" alt="">
                        <p>Автомобілі</p>
                    </div>
                </router-link>
                <router-link to="/search?category=Odzież">
                    <div class="category">
                        <img src="../../assets/fashion.svg" alt="">
                        <p>Одяг</p>
                    </div>
                </router-link>
                <router-link to="/search?category=Sprzęt">
                    <div class="category">
                            <img src="../../assets/tools.svg" alt="">
                            <p>Інструменти</p>
                    </div>
                </router-link>
                <router-link to="/search?category=Turyzm">
                    <div class="category">
                        <img src="../../assets/travel.svg" alt="">
                        <p>Туризм</p>
                    </div>
                </router-link>
                <router-link to="/search?category=Sport">
                    <div class="category">
                        <img src="../../assets/flat.svg" alt="">
                        <p>Спорт</p>
                    </div>
                </router-link>
                <router-link to="/search?category=Meble">
                    <div class="category">
                        <img src="../../assets/sofa.svg" alt="">
                        <p>Меблі</p>
                    </div>
                </router-link>
                <router-link to="/search?category=Elektronika">
                    <div class="category">
                        <img src="../../assets/electronic.svg" alt="">
                        <p>Електроніка</p>
                    </div>
                </router-link>
                <router-link to="/search?category=Sprzęt domowy">
                    <div class="category">
                        <img src="../../assets/blender.svg" alt="">
                        <p>Побутова техніка</p>
                    </div>
                </router-link>
                <router-link to="/search?category=Sprzęt imprezowy">
                    <div class="category">
                        <img src="../../assets/mic.svg" alt="">
                        <p>Cвята та вечірки</p>
                    </div>
                </router-link>
            </div>

            <div class="promoted mt-5 mb-4">
                <h2 class="font-weight-bolder">Рекламні пропозиції</h2>
                <div class="prom_ads">
                    <div class="row">
                        <div class="col-7 for_ads">
                            <div class="item">
                                <div class="bottom_info">
                                    <span class="font-weight-bold h5 mb-0">Камера професійна</span>
                                    <span class="font-weight-normal">500грн / день</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="bottom_info">
                                    <span class="font-weight-bold h5 mb-0">Камера професійна</span>
                                    <span class="font-weight-normal">500грн / день</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="bottom_info">
                                    <span class="font-weight-bold h5 mb-0">Камера професійна</span>
                                    <span class="font-weight-normal ">500грн / день</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="bottom_info">
                                    <span class="font-weight-bold h5 mb-0">Камера професійна</span>
                                    <span class="font-weight-normal ">500грн / день</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="item">
                                <div class="bottom_info d-flex justify-content-center flex-row">
                                    <div class="d-flex flex-column w-50">
                                        <span class="font-weight-bold h4">Камера професійна</span>
                                        <span class="font-weight-normal h5">500грн / день</span>
                                    </div>
                                    <div class="w-50 d-flex align-items-center justify-content-end">
                                        <button class="btn actionBtn">
                                            Перегляд
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="electronic mt-5 pt-5">
                <h2 class="font-weight-bolder">Популярна електроніка</h2>
                <div class="prom_ads">
                    <div class="row">
                        <div class="col-5 h-100">
                            <div class="item">
                                <div class="bottom_info d-flex justify-content-center flex-row">
                                    <div class="d-flex flex-column w-50">
                                        <span class="font-weight-bold h4">Камера професійна</span>
                                        <span class="font-weight-normal h5">500грн / день</span>
                                    </div>
                                    <div class="w-50 d-flex align-items-center justify-content-end">
                                        <button class="btn actionBtn">
                                            Перегляд
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-7 for_ads">
                            <div class="item">
                                <div class="bottom_info">
                                    <span class="font-weight-bold h5 mb-0">Камера професійна</span>
                                    <span class="font-weight-normal">500грн / день</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="bottom_info">
                                    <span class="font-weight-bold h5 mb-0">Камера професійна</span>
                                    <span class="font-weight-normal">500грн / день</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

    import search from "../search/Search_pane";

    export default {
        name: "MainPage",
        components:{
            "search":search
        },
        data: function(){
            return{
            }
        },
        methods:{
            filter: function (f) {
                this.$router.push({path: '/search',query:f});
                //console.log(f);
            }
        }
    }
</script>

<style scoped>
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

    .bottom_info {
        min-height: 59px;
        background-color: rgba(88, 134, 253, 0.8);
        width: 100%;
        position: absolute;
        bottom: 0;
        color: #fff;
        padding: 15px;
        display: flex;
        flex-direction: column;
    }

    .container {
        padding-top: 150px;
        position: relative;
        z-index: 1;
    }

    input {
        background: #fff;
        height: 39px;
    }

    #searchBar {
        background: rgba(88, 134, 253, 0.7);
        border-radius: 4px;
        padding: 30px 30px 0 30px;
        /*max-width: 992px;*/
        width: 100%;
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
        flex-direction: column;
        align-items: center;
        color: #000;
        font-size: 18px;
    }

    .category img {
        width: 70px;
        height: 70px;
    }

    .category p {
        margin-top: 5px;
        text-align: center;
    }
</style>
