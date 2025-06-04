 <template>
    <router-link :to="'/item/'+id" class="item_card d-flex justify-content-between align-items-center flex-column">
        <img :src="getFullPhotoPath(imgUrl)" alt="">
        <div>
            <div class="item_name">{{name}}</div>
            <div class="item_price">{{price}} грн/день</div>
        </div>
    </router-link>
</template>

<script>
    export default {
        name: "SimilaritemCard",
        props: ['name', 'price', 'imgUrl','id'],
        methods:{
            getFullPhotoPath: function (photo) {
                return process.env.VUE_APP_SERVER_IMAGES_URL+photo.img_name_hash;
            },
            goTo: function(uri){
                // this.$router.replace('/');
                window.location = uri;
                // this.$router.go(uri);
            }
        }
    }
</script>

<style scoped>
    .item_card {
        width: 300px;
        /*max-width: 187px;*/
        box-sizing: content-box;
        font-weight: bold;
        font-size: 18px;
        line-height: 25px;
        cursor: pointer;
    }

    .item_card img {
        width: 100%;
        margin-bottom: 20px;
    }

    .item_price {
        font-weight: 400;
        font-size: 14px;
        line-height: 25px;
        color: var(--secondary-color);
    }

    .item_card::-webkit-scrollbar{
        background-color: rgba(77, 110, 197, 0.38);
    }
</style>
