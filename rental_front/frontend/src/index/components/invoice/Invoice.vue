<template>
    <layout>
        <div id="invoice_body" class="container p-5 mt-5">
            <div class="row">
                <div class="col-6">
                    <h3 class="font-weight-bold mb-4">Підтвердження оренди</h3>
                    <p class="h5 mb-3">
                        <span class="font-weight-bold">Дата:</span>
                        <span> {{getDateFormated(rentData.created_at)}}</span>
                    </p>
                    <p class="h5">
                        <span class="font-weight-bold">Номер рахунку: </span>
                        <span>{{rentData.invoice_nr}}</span>
                    </p>

                </div>
                <div class="col-3">
                    <p class="font-weight-bold">Дані орендодатора</p>
                    <p>{{rentData.item_owner.name+" "+rentData.item_owner.second_name}}</p>
                    <p>+380501234567</p>
                    <p>{{rentData.item_owner.email}}</p>
                </div>
                <div class="col-3">
                    <p class="font-weight-bold">Дані орендаря</p>
                    <p>{{rentData.item_renter.name+" "+rentData.item_renter.second_name}}</p>
                    <p>+380661234567</p>
                    <p>{{rentData.item_renter.email}}</p>
                </div>
            </div>

            <table class="table mt-5">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Назва товару</th>
                    <th scope="col">Дата (від - до)</th>
                    <th scope="col">Сума</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>{{rentData.rent_item_title}}</td>
                    <td>{{getDateFormated(rentData.date_rent_from)}} - {{getDateFormated(rentData.date_rent_to)}}</td>
                    <td>{{rentData.rent_sum}} грн</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Завдаток</td>
                    <td>-</td>
                    <td>{{rentData.deposit === null ? 0 : rentData.deposit}} грн</td>
                </tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-between pr-5 mt-5">
                <div class="pl-4 col-8">
                    <label>
                        <input type="checkbox" v-model="regulationsChecked">
                        Я ознайомився з правилами та підтверджую
                    </label>
                    <p class="text-secondary">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores consectetur est in ipsa,
                        laudantium magni odit perferendis quod vitae. Dolores excepturi ipsam laudantium, nam odit
                        quibusdam quos sed tenetur veritatis.
                    </p>
                </div>
                <div>
                    <p class="h3">
                        <span class="font-weight-bold">Total: </span>
                        <span>{{rentData.total_sum}} грн</span>
                    </p>
                    <button class="btn btn-prm mt-3" @click="sendInvoice">Підтвердити</button>
                </div>
            </div>

        </div>
    </layout>
</template>

<script>
    import MainLayout from '../common/MainLayout'
    var dateFormat = require('dateformat');

    export default {
        name: "Invoice",
        components: {
            layout: MainLayout,
        },
        data: function(){
            return {
                rentData: {},
                regulationsChecked: false
            }
        },
        mounted() {
            this.loadInvoice();
        },
        methods:{

            loadInvoice:function () {
                this.$axios({
                    url: process.env.VUE_APP_API_URL + process.env.VUE_APP_GET_INVOICE+"/?invoice_nr="+this.$route.query.nr,
                    withCredentials: true,
                    method: "get"
                })
                    .then(response => {
                        this.rentData = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            getDateFormated: function (date) {
                return dateFormat(date, "dd/mm/yyyy");
            },

            sendInvoice: function(){
                if(!this.regulationsChecked){
                    this.$swal({
                        title: 'Musisz potwierdzic regulamin',
                        confirmButtonText: "Tak!",
                        icon: 'error',
                    })
                }else{
                    this.sendApproveRequest();
                }
            },

            sendApproveRequest: function () {
                let data = {
                     "invoice_nr": this.$route.query.nr
                };
                this.$axios({
                    url: process.env.VUE_APP_API_URL + process.env.VUE_APP_APPROVE_RENT,
                    withCredentials: true,
                    method: "patch",
                    data:data
                })
                    .then(response => {
                        this.$toastr.success(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    }
</script>

<style scoped>
    #invoice_body {
        min-height: 100px;
        background: #FFFFFF;
        box-shadow: 0px 4px 20px rgba(7, 0, 117, 0.14);
        border-radius: 6px;
        margin-bottom: 80px;
    }

    .btn {
        height: 43px;
        background: #6C63FF;
        border-radius: 6px;
        color: #fff;
        width: 100%;
        font-size: 20px;
        font-weight: bold;
    }
</style>
