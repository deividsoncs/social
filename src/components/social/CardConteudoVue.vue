<template>
    <div class="row">
        <div class="card">
            <div class="card-content">
                <div class="row valign-wrapper">
                    <grid-vue tamanho="1">
                        <img :src="srcperfil" alt="" class="circle responsive-img">
                    </grid-vue>
                    <grid-vue tamanho="11">
                        <span class="black-text">
                            <strong>{{ nome }}</strong> - <small>24/07/2019 20:34</small>
                        </span>
                    </grid-vue>
                </div>
                <slot>
                
                </slot>
                
            </div>
            <div class="card-action">
                <i class="material-icons">favorite_border</i>
                <i class="material-icons">insert_comment</i>
            </div>
        </div>
    </div>
</template>

<script>
    import GridVue from "@/components/layouts/GridVue"
    export default {
        props: ["srcperfil", "nome", "data",],
        name: "CardConteudoVue",
        data() {
            return {};
        },
        components: {
            GridVue
        }
    };
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
