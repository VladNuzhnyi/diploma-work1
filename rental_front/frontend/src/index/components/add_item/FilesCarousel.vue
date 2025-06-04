<template>
    <div class="images pt-4 p-4 d-flex row flex-nowrap">
        <div class="col-4 mr-5 square block" v-for="(file,i) in uploaded_files">
            <button class="remove" @click="removeImage(i)">
                <img src="../../assets/close.svg" alt="">
            </button>
            <img v-bind:src="file" alt="">
        </div>
        <div :class="{'no_photos': noPhoto}" class="addBlock col-4 d-flex justify-content-center align-items-center">
            <input type="file" id="newImage" @change="previewFiles">

            <label for="newImage" id="uploadBtn">
                <img src="../../assets/add_3.png" alt="">
            </label>
        </div>
    </div>

</template>

<script>
    export default {
        name: "FilesCarousel",
        data: function () {
            return {
                uploaded_files:[],
            }
        },
        props : [
          'noPhoto'
        ],
        methods:{
            previewFiles: function (event) {
                const reader = new FileReader();
                reader.readAsDataURL(event.target.files[0]);
                reader.onload = () => {
                    this.uploaded_files.push(reader.result);
                };
                reader.onerror = error => {
                    console.log("error during uploading photo")
                };
            },
            removeImage: function(index){
                this.uploaded_files.splice(index, 1);
            },
            noPhotoAdded: function () {
                alert('No photo');
            }
        },
        watch:{
            uploaded_files: function () {
                this.$emit('files_changed', this.uploaded_files)
            }
        }
    }
</script>

<style scoped>
    .block {
        background-color: #FFFFFF;
        box-shadow: 0px 4px 20px rgba(7, 0, 117, 0.14);
        border-radius: 6px;
    }
    .square {
        width: 317px !important;
        height: 317px !important;
        background-repeat: no-repeat;
        background-position: center;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        padding:0!important;
        position: relative;
    }
    .remove{
        position: absolute;
        top:3%;
        right: 2%;
        width:25px;
        height: 25px;
        border-radius: 180px;
        border: 2px solid #b6b6b6;
        display: flex;
        justify-content: center;
        align-items: center;
        background: none;
    }
    .remove>img{
        width: 100%;
    }

    .images {
        overflow: auto;
    }

    .addBlock {
        background: #E7E5E5;
        border-radius: 6px;
        width: 317px;
        height: 317px;
    }

    .images::-webkit-scrollbar {
        height: 10px;
    }


    .images::-webkit-scrollbar-thumb {
        background-color: rgba(77, 110, 197, 0.38);
        border-radius: 17px;
    }

    #newImage {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

    #uploadBtn:hover {
        cursor: pointer;
    }

    .square>img{
        width: 100%;
    }

    .no_photos{
        border: 1px solid #dc3545;
    }

</style>