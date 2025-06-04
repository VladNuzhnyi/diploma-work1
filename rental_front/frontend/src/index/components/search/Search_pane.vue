<template>
    <div id="searchBar">
        <div class="form-row">
            <div class="form-group col-10">
                <input class="form-control " type="text" placeholder="Що шукаєш?" v-model="keyphrase">
            </div>
            <div class="form-group col-2">
                <button class="form-control btn btn-primary search_button" @click="filter">Пошук</button>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-3">
                    <v-select
                            v-model="category"
                            :options="categories"
                            label="category_name"
                            placeholder="Категорія"
                    ></v-select>
                </div>
                <div class="form-group col-3">
                    <v-select
                            v-model="city"
                            :options="cities"
                            label="region_name"
                            placeholder="Місто"
                    ></v-select>
                </div>
                <div class="form-group col-3">
                    <v-datepicker
                            v-model="date"
                            mode='range'>
                        <input type="text" class="form-control"
                               placeholder="Обери дати"
                               style="width: 100%"
                               v-model="date_string">
                    </v-datepicker>
                </div>
                <div class="form-group col">
                    <v-select
                            v-model="price.from"
                            :options="prices.from"
                            label=""
                            placeholder="Ціна від"
                    ></v-select>
                </div>
                <div class="form-group col">
                    <v-select
                            v-model="price.to"
                            :options="prices.to"
                            label=""
                            placeholder="Ціна до"
                    ></v-select>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import DatePicker from "v-calendar/lib/components/date-picker.umd";
    import dateformatter from "dateformatter";
    import vSelect from 'vue-select'
    import 'vue-select/dist/vue-select.css';

    export default {
        name: "Search_pane",
        components:{
            "v-datepicker": DatePicker,
            "v-select": vSelect
        },
        data: function() {
            return {

                city:"",
                category: "",
                keyphrase: '',
                date: {},
                price: {
                    from: "",
                    to: ""
                },

                categories: [],
                date_string: "",
                cities: [],

                prices: {
                    from: [
                        "100 UAH",
                        "200 UAH",
                        "300 UAH",
                        "400 UAH",
                        "500 UAH",
                        "600 UAH",
                        "700 UAH",
                        "800 UAH",
                        "900 UAH",
                        "1000 UAH",
                        "2000 UAH",
                        "3000 UAH",
                        "4000 UAH",
                        "5000 UAH",
                        "6000 UAH",
                        "7000 UAH",
                        "8000 UAH",
                        "9000 UAH",
                    ],
                    to: [
                        "100 UAH",
                        "200 UAH",
                        "300 UAH",
                        "400 UAH",
                        "500 UAH",
                        "600 UAH",
                        "700 UAH",
                        "800 UAH",
                        "900 UAH",
                        "1000 UAH",
                        "2000 UAH",
                        "3000 UAH",
                        "4000 UAH",
                        "5000 UAH",
                        "6000 UAH",
                        "7000 UAH",
                        "8000 UAH",
                        "9000 UAH",
                    ]
                }
            }
        },
        mounted() {
            this.loadCategories();
            this.loadCities();
        },
        methods:{
            filter: function () {
                let filters = {
                    keyphrase: this.keyphrase,
                    date_from: new Date(this.date.start).getTime(),
                    date_to: new Date(this.date.end).getTime(),
                    price_from:this.price.from,
                    price_to:this.price.to,
                    city:this.city
                };

                if(this.category === null || this.category === ""){
                    filters["category"] ="";
                }else{
                    filters["category"]= this.category.category_name;
                }
                this.$emit('filter', filters);
            },
            loadCategories: function() {
                this.$axios({
                    url: process.env.VUE_APP_API_URL + process.env.VUE_APP_GET_CATEGORIES,
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
            loadCities: function () {
                this.$axios({
                    url: process.env.VUE_APP_API_URL + process.env.VUE_APP_GET_REGIONS,
                    withCredentials: true,
                    method: "get"
                })
                    .then(response => {
                        this.cities = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
        watch:{
            date: function () {
                this.date_string = dateformatter.format('Y.m.d',new Date(this.date.start).getTime())
                    +" - "+
                    dateformatter.format('Y.m.d',new Date(this.date.end).getTime());
            }
        }
    }
</script>

<style scoped>
    .actionBtn{
        padding: 4px 20px;
        background-color: #fff;
        font-weight: bold;
    }
    .search_button {
        background: #FF695E;
        border-radius: 6px;
        border: none;
        max-width: 236px;
        width: 100%;
    }

    .search_button:active {
        background: #e96257 !important;
        color: #fff !important;
    }

</style>
