<template>
    <div class="pricing">
        <h1 class="title">
            {{item_title}}
        </h1>
        <div class="content">
            <div class="price">
                {{amount}} грн / день
            </div>
            <div class="user">
                <span>Від</span>
                <span class="username">{{user}}</span>
                <img class="savety " src="/static/savety.svg" alt="">
            </div>
            <div class="location d-flex align-items-center">
                <img src="static/location.svg" alt="">
                <span class="city">{{city}}</span>
            </div>
            <div class="ranking">
                <span class="ranking_text">Рейтинг користувача: {{rating}}/5</span>
                <star-rating
                        :read-only="true"
                        :star-size="20"
                        inactive-color="#769bba"
                        active-color="#efce4a"
                        :increment="0.1"
                        :rating="rating"
                        :show-rating="false"
                />
            </div>
            <div class="kategory">
                <span>Категорія:</span>
                <a href="">{{category}}</a>
            </div>
        </div>
        <div class="main_info row">
            <div class="deposit col-lg-3 main_info_category">
                <div class="main_info_name">Завдаток</div>
                <div class="main_info_value">{{ deposit==null? 0 : deposit }} грн</div>
            </div>
            <div class="minimal_period col-lg-4 main_info_category">
                <div class="main_info_name">Мін. період оренди</div>
                <div class="main_info_value">{{min_rent_time}} дні</div>
            </div>
            <div class="delivery col-lg-5 main_info_category">
                <div class="main_info_name">Висилка до других міст</div>
                <div class="main_info_value">{{sending_to_other_cities}}</div>
            </div>
        </div>
    </div>
</template>

<script>
    import StarRating from 'vue-star-rating'

    export default {
        name: "Pricing",
        props: [
            'item_title',
            'amount',
            'user',
            'city',
            'ranking',
            'category',
            'deposit',
            'min_rent_time',
            'sending_to_other_cities',
            'category',
            'rating',
        ],
        components : {
            StarRating,
        },
        data: function () {
            return {
                title: "Narty",
                starStyle: {
                    fullStarColor: '#efce4a',
                    emptyStarColor: '#769bba',
                    starWidth: 20,
                    starHeight: 20
                }
            }
        },
    }
</script>

<style scoped>

    .pricing {
        max-width: 466px;
        min-height: 426px;
        background-color: #FFFFFF;
        box-shadow: 0 4px 20px rgba(7, 0, 117, 0.14);
        border-radius: 6px;
        display: grid;
        grid-template-rows: 1fr 5fr 1fr;
    }

    .content {
        padding-left: 10%;
    }

    .title {
        font-style: normal;
        font-weight: bold;
        font-size: 28px;
        line-height: 38px;
        text-align: center;
        border:none;
    }

    .price {
        font-style: normal;
        font-size: 24px;
        line-height: 33px;
    }

    .user {
        font-size: 12px;
        margin: 3px 0 10px 0;
    }

    .username {
        color: #3474BF;
        font-style: normal;
        font-weight: 600;
        line-height: 16px;
        text-decoration-line: underline;
        margin: 0 3px 0 3px;

    }

    .savety {
        width: 16px;
    }

    .location{
        margin: 10px 0 22px 0;
    }

    .city {
        font-style: normal;
        font-weight: 600;
        font-size: 18px;
        line-height: 25px;
    }

    .ranking_text {
        font-size: 12px;
        line-height: 16px;
        color: var(--secondary-color);
        font-weight: lighter;
    }


    .main_info_category {
        min-height: 60px;
        display: grid;
        grid-template-rows: repeat(2, 1fr);
        justify-items: center;
        align-items: center;
        padding-bottom: 5px;
    }

    .main_info_category:nth-child(1) {
        border-right: 1px solid #c4c4c4;
        border-top: 1px solid #c4c4c4;
    }

    .main_info_category:nth-child(2) {
        border-right: 1px solid #c4c4c4;
        border-top: 1px solid #c4c4c4;
    }

    .main_info_category:nth-child(3) {
        border-top: 1px solid #c4c4c4;
    }

    .main_info_name {
        font-weight: 600;
        font-size: 0.6em;
        line-height: 19px;
        color: #8A8A8A;
    }

    .main_info_value {
        font-weight: 600;
        font-size: 20px;
        line-height: 27px;
        color: #0030AC;
        align-self: start;
    }

    .statistics {
        font-weight: light;
        font-size: 12px;
        line-height: 14px;
        color: #6E7DA2;
        margin: 6px 0 5px 0;
    }

    .kategory {
        font-weight: bold;
        font-size: 12px;
        line-height: 16px;
        color: #000000;
        margin-top: 6px;
    }

    .kategory a {
        font-weight: bold;
        font-size: 12px;
        line-height: 16px;
        text-decoration-line: underline;
        color: #3474BF;
        margin-left: 2px;
    }
    .main_info{

    }
</style>
