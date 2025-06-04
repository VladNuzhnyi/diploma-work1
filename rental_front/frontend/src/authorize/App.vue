<template>
    <div id="main">
        <transition name="fade" mode="out-in">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>

    export default {
        components: {

        }
    }
</script>

<style scoped>

</style>

<style>
    .btn-prm {
        height: 43px;
        background: #6C63FF;
        border-radius: 6px;
        color: #fff;
        font-size: 20px;
        font-weight: bold;
    }

    #main{
        height: 100%;
    }


</style>
