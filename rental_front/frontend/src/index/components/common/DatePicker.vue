<template>
    <input :value="selectedDate" type="text" class="date form-control" readonly>
</template>

<script>
    export default {
        name: "DatePicker",
        props: ['selectedDate'],
        methods : {

        }
    }
</script>

<style scoped>
    .date{
        width: 100%;
        max-width: 130px;
        min-height: 36px;
        background-color: white;
    }
</style>