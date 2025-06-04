<template>
    <div class="title_wrapper">
        <div class="container">
            <div id="title">{{currentPage}}</div>
            <router-link :to="{name: p}" v-for="p in this.fullPath">
                <span class="path">{{p}}</span>
                <span> / </span>
            </router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TinyNavigation",
        computed: {
            fullPath: function () {
                let fullPath = [];
                fullPath.push('Головна');
                return fullPath.concat(this.path);
            }
        },
        props: {
            currentPage: String,
            path: Array,
        }
    }
</script>

<style scoped>
    #title {
        font-family: "Open Sans", sans-serif;
        font-style: normal;
        font-weight: bold;
        font-size: 30px;
        line-height: 41px;
    }

    .path {
        font-family: "Open Sans", sans-serif;
        font-style: normal;
        font-weight: 600;
        font-size: 14px;
        line-height: 19px;
        color: #1E82BA;
    }
    .path:hover{
        color: #21adf8;
    }

    .title_wrapper {
        display: flex;
        justify-content: flex-start;
        flex-direction: column;
        margin-bottom: 20px;
    }

    a {
        text-decoration: none;
        color: #1E82BA;
    }
</style>
