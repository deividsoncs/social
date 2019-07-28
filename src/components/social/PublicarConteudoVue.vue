<template>
    <div class="row">
        <grid-vue class="input-field" tamanho="12">
            <textarea v-model="conteudo" class="materialize-textarea"></textarea>
            <label>O que está acontecendo?</label>
        </grid-vue>
        <p>
            <button v-if="conteudo" class="btn col s2 offset-s10 waves-effect waves-light">Publicar</button>
        </p>
    </div>
</template>

<script>
    import GridVue from "@/components/layouts/GridVue"
    export default {
        props: [""],
        name: "PublicarConteudoVue",
        data() {            
            return {
                conteudo: ''
            };
        },
        components: {
            GridVue
        }
    };    
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
