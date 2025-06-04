<template>

    <layout>
        <tiny :current-page="this.$router.currentRoute.name" :path="tinyNavPath"></tiny>

        <div class="container block p-5 mb-5">
            <h3 class="font-weight-bold">Дані про оренду</h3>

            <div class="row">
                <div class="col-4 d-flex flex-column justify-content-center align-items-center pt-5">
                    <h5 class=" mb-4">
                        Період оренди
                    </h5>

                    <v-datepicker
                            mode="range"
                            is-inline
                            color="purple"
                            :attributes='attrs'
                            :disabled-dates='{}'
                    />

                </div>
                <div class="col-4 d-flex flex-column justify-content-start pt-5">
                    <h5 class="font-weight-bold mb-4 text-center">
                        Опис оренди
                    </h5>
                    <p class="pl-5"><span class="text-muted">Орендуєш: </span><br><span class="font-weight-bold ">{{this.item.rent_item_title}}</span></p>
                    <p class="pl-5"><span class="text-muted ">Ціна в день: </span><br><span class="font-weight-bold ">{{`${this.item.one_day_price} грн`}}</span></p>
                    <p class="pl-5"><span class="text-muted">Завдаток: </span><br><span class="font-weight-bold ">{{this.item.deposit ? `${this.item.deposit} грн` : '-' }}</span></p>
                    <p class="pl-5"><span
                            class="text-muted ">День повернення: </span><br><span class="font-weight-bold ">{{this.returnDate}}</span></p>
                    <p class="pl-5"><span class="text-muted ">Адреса:</span> <br><span class="font-weight-bold ">{{`${this.item.ad.region.region_name}, ${this.item.ad.address}`}}</span>
                    </p>
                </div>
                <div class="col-4 d-flex flex-column justify-content-start align-items-center pt-5">
                    <h5 class="font-weight-bold mb-4">
                        Дані орендодавця
                    </h5>
                    <div class="d-flex">
                        <div id="userImg" class="mr-3">
                            <img src="../../assets/user.svg" alt="">
                        </div>
                        <div class="data">
                            <div class="">{{`${this.item.item_owner.name} ${this.item.item_owner.second_name}`}}</div>
                            <div class="font-weight-bolder">{{this.item.item_owner.phone}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5 pl-4 pr-4">
                <div class="col-6">
                </div>
                <div class="col-6 d-flex justify-content-end align-items-end">
                    <button class="btn red-btn">Повернути товар</button>
                </div>
            </div>
        </div>
    </layout>

</template>

<script>

    import MainLayout from "../common/MainLayout";
    import TinyNavigation from "../common/TinyNavigation";
    import DatePicker from 'v-calendar/lib/components/date-picker.umd'

    export default {
        name: "MyRentItem",
        components: {
            layout: MainLayout,
            tiny: TinyNavigation,
            "v-datepicker": DatePicker
        },
        data: function () {
            return {
                tinyNavPath: [
                    "Мої оренди",
                    this.$router.currentRoute.name
                ],
                item: null,
                attrs: [
                    {
                        key: 'today',
                        highlight: 'purple',
                        dates: [],
                    },
                ],
            };
        },
        computed: {
          returnDate : function () {
                let date = new Date(this.item.date_rent_to);
                let month;
                if(date.getMonth() < 9){
                    month = `0${date.getMonth() + 1}`
                }else{
                    month = `${date.getMonth() + 1}`
                }
                return `${date.getFullYear()}-${month}-${date.getDate()}`;
          }
        },
        methods: {
            getInfo: function () {
                console.log('Getting info...');
                this.$axios({
                    method: "get",
                    url: `${process.env.VUE_APP_API_URL}${process.env.VUE_APP_RENT_GET_SELF}/${this.$route.params.id}`,
                    withCredentials: true
                }).then(response => {
                    this.item = response.data[0];
                    this.attrs[0].dates.push({
                      start : new Date(this.item.date_rent_from),
                      end : new Date(this.item.date_rent_to)
                    });
                }).catch(error => {
                    console.log(error);
                });
            }
        },
        created() {
            this.getInfo();
        }
    }
</script>

<style scoped>

    .text-muted{
        font-size: 12px;
    }
    p{
        margin-bottom: 5px!important;
    }

    .block {
        background: #FFFFFF;
        box-shadow: 0px 4px 20px rgba(7, 0, 117, 0.14);
        border-radius: 6px;
    }

    #userImg {
        width: 52px;
        height: 52px;
        overflow: hidden;
    }

    #userImg > img {
        width: 100%;
    }

    .red-btn {
        background: #FF695E;
        border-radius: 6px;
        color: #fff;
        padding: 6px 25px;
    }

</style>
