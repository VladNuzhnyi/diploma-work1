<template>
    <div class="dates">
        <FastAuth @loggedIn="rentAfterLogin" :show="showFastAuth"></FastAuth>
        <div class="calendar">
            <v-datepicker
                    mode="range"
                    v-model="date"
                    is-inline
                    color="purple"
                    :min-date="new Date()"
                    locale="ua"
                    :attributes="attrs"
            />
        </div>
        <div class="selected_dates">
            <datepicker :selectedDate="date_start"></datepicker>
            <datepicker :selectedDate="date_end"></datepicker>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <button @click="create_invoice" class="button">Зарезервуй</button>
        </div>
    </div>
</template>

<script>
    import MyDatePicker from '../common/DatePicker'
    import Calendar from 'v-calendar/lib/components/calendar.umd'
    import DatePicker from 'v-calendar/lib/components/date-picker.umd'
    import FastAuth from "../common/FastAuth";

    export default {
        name: "Calendar",
        props: [
            'dates'
        ],
        mounted() {
            this.loadCalendar();
        },
        data: function () {
            return {
                disabled_date: [],
                date: {
                    start: new Date(),
                    end: new Date()
                },
                attrs: [
                    {
                        key: 'today',
                        highlight: 'red',
                        popover: {
                            label: 'Цей день недоступний',
                        },
                        dates:
                            []
                    },
                ],
                showFastAuth: false
            }
        },

        //getMonth*() + 1 because months start from 0
        computed: {
            date_start: function () {
                let date = (this.date.start.getDate() < 9) ? `0${this.date.start.getDate()}` : `${this.date.start.getDate()}`;
                let month = (this.date.start.getMonth() < 9) ? `0${this.date.start.getMonth() + 1}` : `${this.date.start.getMonth()}`;
                return `${date}-${month}-${this.date.start.getFullYear()}`;
            },
            date_end: function () {
                let date = (this.date.end.getDate() < 9) ? `0${this.date.end.getDate()}` : `${this.date.end.getDate()}`;
                let month = (this.date.end.getMonth() < 9) ? `0${this.date.end.getMonth() + 1}` : `${this.date.end.getMonth()}`;
                return `${date}-${month}-${this.date.end.getFullYear()}`;
            }
        },
        methods: {
            loadCalendar: function () {
                let newDates = [];
                this.dates.forEach(el => {
                    newDates.push(
                        {
                            'start': new Date(el.date_rent_from).getTime(),
                            'end': new Date(el.date_rent_to).getTime()
                        });
                });
                this.disabled_date = newDates;
                this.attrs = [{
                    key: 'today',
                    highlight: 'red',
                    popover: {
                        label: 'Цей день недоступний',
                    },
                    dates: newDates
                }];
            },

            rentAfterLogin: function () {
                this.showFastAuth = false;
                this.create_invoice();
            },

            create_invoice: function () {
                if (!this.$store.getters.isLoggedIn) {
                    this.showFastAuth = true;
                    return;
                }

                this.$swal({
                    title: 'Резервуєш товар',
                    html: 'Товар буде зарезервовано на <b>20</b> хвилин. Після отримання товару, ви зобов\'язуєтесь повернути його протягом встановленого терміну.',
                    confirmButtonText: "Так!",
                    icon: 'info',
                }).then(res => {
                    if (res.value)
                        this.sendRequestCreateInvoice();
                });

            },

            sendRequestCreateInvoice: function () {

                let data = {
                    date_from: this.date_start,
                    date_to: this.date_end,
                    ad_id: this.$route.params.id
                };

                this.$axios({
                    url: process.env.VUE_APP_API_URL + process.env.VUE_APP_CREATE_INVOICE,
                    data: data,
                    withCredentials: true,
                    method: "post"
                })
                    .then(response => {
                        this.$router.push('/invoice?nr=' + response.data.invoice_nr);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
        watch: {
            dates() {
                this.loadCalendar();
            }
        },
        components: {
            "datepicker": MyDatePicker,
            "v-calendar": Calendar,
            "v-datepicker": DatePicker,
            FastAuth
        }
    }
</script>

<style>

</style>

<style scoped>
    .dates {
        max-width: 312px;
        height: 426px;
        border-radius: 5px;
        background-color: #FFFFFF;
        box-shadow: 0 4px 20px rgba(7, 0, 117, 0.14);
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
    }

    .button {
        color: white;
        background: #FF695E;
        border-radius: 6px;
        border: none;
        max-width: 170px;
        min-height: 37px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        justify-self: center;
        cursor: pointer;
    }

    .selected_dates {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 279px;
        height: 36px;
    }

    .calendar {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
