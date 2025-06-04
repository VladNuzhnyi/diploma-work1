<template>
    <div class="item_info d-flex flex-column flex-nowrap">
        <div class="header d-flex">
            <div class="tab" :class="{tab_active: description }" @click="tabs">
                Опис
            </div>
            <div class="tab" :class="{ tab_active: properties }" @click="tabs">
                Параметри
            </div>
        </div>
        <div class="content">
            <div v-if="description" class="description">
                {{descriptionText}}
            </div>
            <div v-if="properties" class="props">
                <item-prop
                        name="Rozmiar"
                        value="38, 39, 40"
                />
                <item-prop
                        name="Wiek"
                        value="14-20"
                />
                <item-prop
                        name="Waga"
                        value="50-90"
                />
                <item-prop
                        name="Rozmiar"
                        value="38, 39, 40"
                />
                <item-prop
                        name="Wiek"
                        value="14-20"
                />
                <item-prop
                        name="Waga"
                        value="50-90"
                />
                <item-prop
                        name="Rozmiar"
                        value="38, 39, 40"
                />
                <item-prop
                        name="Wiek"
                        value="14-20"
                />
                <item-prop
                        name="Waga"
                        value="50-90"
                />
                <item-prop
                        name="Rozmiar"
                        value="38, 39, 40"
                />
                <item-prop
                        name="Wiek"
                        value="14-20"
                />
                <item-prop
                        name="Waga"
                        value="50-90"
                />
                <item-prop
                        name="Rozmiar"
                        value="38, 39, 40"
                />
                <item-prop
                        name="Wiek"
                        value="14-20"
                />
                <item-prop
                        name="Waga"
                        value="50-90"
                />
            </div>
        </div>
    </div>
</template>

<script>
    import ItemProp from "./ItemProp";

    export default {
        name: "ItemInfo",
        data: function () {
            return {
                description: true,
                properties: false
            };
        },
        props:[
            "descriptionText"
        ],
        components: {
            "itemProp": ItemProp
        },
        methods: {
            tabs: function () {
                if (this.description) {
                    this.description = false;
                    this.properties = true;
                } else {
                    this.description = true;
                    this.properties = false;
                }
            }
        },
    }
</script>

<style scoped>
    .item_info {
        background: #FFFFFF;
        box-shadow: 0 4px 20px rgba(7, 0, 117, 0.14);
        border-radius: 6px;
        padding-left: 37px;
        padding-bottom: 22px;
    }

    .tab {
        padding: 12px 9px;
        border-radius: 0 0 6px 6px;
        cursor: pointer;
    }

    .content {
        width: 100%;
        margin-top: 22px;
    }
    .description{
        font-size: 15px;
        line-height: 20px;
        padding-right: 37px;
        color:var(--secondary-color);
    }
    .props{
        width: 100%;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        grid-template-rows: repeat(3, 1fr);
        grid-row-gap: 6px;
    }

    .tab_active {
        background: rgba(0, 48, 172, 0.7);
        color: #FFFFFF;
    }

    .tab_active:hover{
        background: rgba(0, 61, 172, 0.7);
    }
</style>
