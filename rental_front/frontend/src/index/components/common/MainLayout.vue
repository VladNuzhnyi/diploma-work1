<template>
    <div id="body">

        <div id="content">
            <slot></slot>
        </div>

    </div>
</template>

<script>

    export default {
        name: "MainLayout",
        components: {
        }
    }
</script>

<style scoped>
    * {
        font-family: 'Open Sans', sans-serif;
    }

    #body {
        width: 100%;
        height: 100%;
        z-index: 1;
        padding-top:120px;
    }
    #content {
        position: relative;
        z-index: 2;
    }

</style>