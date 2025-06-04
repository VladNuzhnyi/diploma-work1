<template>
    <div class="item_photos">
        <div class="main_photo">
            <img :src="getFullPhotoPath(mainPhotoUrl)" alt="">
        </div>
        <div class="other_photos">
            <div
                    class="other_photo"
                    @click="toMainPhoto(index)"
                    v-for="(photo, index) in otherPhotos"
                    :style="{ backgroundImage: `url(${getFullPhotoPath(photo)})`}"
                    :class="{photo_selected : selected === index}"
            ></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ItemPhotos",
        data: function(){
            return{
                selected: 0,
            }
        },
        props: {
            'mainPhotoUrl': Object,
            'otherPhotos': Array
        },
        methods:{
            toMainPhoto : function (index) {
                  this.mainPhotoUrl = this.otherPhotos[index];
                  this.selected = index;
            },
            getFullPhotoPath: function (photo) {
                return process.env.VUE_APP_SERVER_IMAGES_URL+photo.img_name_hash;
            }
        }
    }
</script>

<style scoped>
    .item_photos{
        max-width: 334px;
        height: 426px;
        background-color: #FFFFFF;
        box-shadow: 0 4px 20px rgba(7, 0, 117, 0.14);
        border-radius: 6px;
        padding-top: 15px;
        padding-bottom: 10px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
    }
    .main_photo{
        height: 292px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .main_photo img{
        max-width: 313px;
        max-height: 300px;
    }
    .other_photo{
        height: 67px;
        width: 67px;
        /*border: #5c50ec solid 1px;*/
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        margin-right: 10px;
    }
    .other_photos{
        padding:10px 0 10px 0;
        width: 100%;
        display: -webkit-box;
        -webkit-box-align: center;
        overflow: scroll;
    }

    .other_photos::-webkit-scrollbar{
        height: 5px;
    }

    .other_photos::-webkit-scrollbar-track{
        background-color: #fff;
    }

    .other_photos::-webkit-scrollbar-thumb{
        background-color: rgba(77, 110, 197, 0.38);
        border-radius: 17px;
    }
    .photo_selected{
        border: 2px solid rgba(84, 73, 255, 0.5);
    }
</style>