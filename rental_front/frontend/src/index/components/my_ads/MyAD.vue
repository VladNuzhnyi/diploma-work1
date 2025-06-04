<template>

    <layout>
        <tiny :current-page="this.$router.currentRoute.name" :path="tinyNavPath"></tiny>

        <div class="container">
            <div class="mt-5 grid">
                <div class="block row">
                    <div class="img col-5">
                        <img src="../../assets/1ac5c1d84cc6b84a940113b6e47c.png" alt="">
                    </div>

                    <div class="col-7 p-4">
                        <h5 class="font-weight-bold text-center">Лижі</h5>
                        <p class="h6 mb-2 font-weight-bolder">Статус: <span class="text-success">Активний</span></p>
                        <p class="h6 mb-2 font-weight-bolder">Орендар: <span class="text-primary" style="text-decoration: underline">Maxwell Lockman Lakin</span></p>
                        <p class="h6 mb-2 font-weight-bolder">300 грн/день</p>
                        <div class="w-100 d-flex justify-content-end">
                            <router-link to="/my_item" class="btn btn-prm pl-5 pr-5 font-weight-light">Більше</router-link>
                        </div>
                    </div>

                </div>
                <div class="block row">
                    <div class="img col-5">
                        <img src="../../assets/1ac5c1d84cc6b84a940113b6e47c.png" alt="">
                    </div>

                    <div class="col-7 p-4">
                        <h5 class="font-weight-bold text-center">Велосипед smith</h5>
                        <p class="h6 mb-2 font-weight-bolder">Статус: <span class="text-success">Активний</span></p>
                        <p class="h6 mb-2 font-weight-bolder">Орендар: <span class="text-primary" style="text-decoration: underline">Mason Monahan Rogahn</span></p>
                        <p class="h6 mb-2 font-weight-bolder">500 грн/день</p>
                        <div class="w-100 d-flex justify-content-end">
                            <router-link to="/my_item" class="btn btn-prm pl-5 pr-5 font-weight-light">Більше</router-link>
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
        data: function () {
            return {
                tinyNavPath: [
                    this.$router.currentRoute.name
                ]
            };
        }
    }
</script>

<style scoped>
    .block {
        background: #FFFFFF;
        box-shadow: 0px 4px 20px rgba(7, 0, 117, 0.14);
        border-radius: 6px;
        min-height: 200px;
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
