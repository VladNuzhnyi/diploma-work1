<template>
    <div class="item">
        <div class="item-img" :style="{backgroundImage: `url(${url})`}"></div>
        <div class="item-description">
            <div class="price">
                <span><b> {{price}} </b> грн/день</span>
            </div>
            <div class="title-wrapper">
                <span class="title">{{title}}</span>
                <div class="star-wrapper">
                    <img class="star" src="../../assets/favourites_star.svg" alt="">
                </div>
            </div>
            <div class="description">
                {{description}}
            </div>
            <router-link :to="'/item/'+id"  class="button">
                Перегляд
            </router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SearchItem",
        props: [
            'title',
            'price',
            'url',
            'description',
            'id'
        ],
        data() {
            return {
            }
        }
    }
</script>

<style scoped>
    .item {
        width: 270px;
        height: 347px;
        background: #FFFFFF;
        box-shadow: 0 4px 20px rgba(7, 0, 117, 0.14);
        border-radius: 6px;
        display: grid;
        grid-template-rows: 1fr 1fr;
    }

    .item-img {
        width: 100%;
        border-radius: 6px 6px 0 0;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .star {
        width: 20px;
    }

    .star-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .title {
        font-style: normal;
        font-weight: bold;
        font-size: 22px;
        line-height: 30px;
    }

    .price {
        position: absolute;
        padding: 5px 15px 5px 15px;
        top: -12.5px;
        right: 30px;
        font-style: normal;
        font-weight: normal;
        font-size: 14px;
        line-height: 19px;
        text-align: center;
        color: #04004E;
        display: flex;
        justify-content: center;
        align-items: center;
        max-width: 130px;
        height: 25px;
        background: #FFFFFF;
        box-shadow: 0 4px 7px rgba(0, 0, 0, 0.2);
    }

    .description {
        font-style: normal;
        font-weight: normal;
        font-size: 14px;
        line-height: 19px;
        color: var(--secondary-color);
        max-width: 100%;
        overflow: hidden;
        max-height: 76px;
    }

    .description {
        align-items: center;
        justify-content: center;
    }

    .item-description {
        padding: 5px 10px 0 10px;
        display: grid;
        position: relative;
    }

    .button {
        color: white;
        background: #FF695E;
        border-radius: 6px;
        border: none;
        max-width: 236px;
        height: 25px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        justify-self: center;
    }

    .button:active {
        background: #e96257 !important;
    }

    .title-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
