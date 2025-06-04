<template>
    <div class="item_prop">
        {{name}} - {{value}}
    </div>
</template>

<script>
    export default {
        name: "ItemProp",
        props: [
            "name",
            "value",
        ]
    }
</script>

<style scoped>
    .item_prop{
        font-size: 14px;
        line-height: 20px;
        color:var(--secondary-color);
    }
</style>