<template>
    <div class="row">
        <grid-vue class="input-field" tamanho="12">
            <input type="text" v-model="conteudo.titulo">
            <textarea v-if="conteudo.titulo" v-model="conteudo.texto" class="materialize-textarea" placeHolder="Seu texto."></textarea>
            <label>O que está acontecendo?</label>
            <input v-if="conteudo.titulo && conteudo.texto" type="text" v-model="conteudo.link" placeHolder="Link">
            <input v-if="conteudo.titulo && conteudo.texto" type="text" v-model="conteudo.imagem" placeHolder="Imagem">
        </grid-vue>
        <p>
            <button v-if="conteudo.titulo && conteudo.texto" class="btn col s2 offset-s10 waves-effect waves-light" v-on:click="addConteudo()">Publicar</button>
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
                conteudo: {
                    titulo: '',
                    texto: '',
                    link: '',
                    imagem: ''
                }
            };
        },
        components: {
            GridVue
        },
        methods: {
            addConteudo() {
                console.log(this.conteudo);
                this.$http.post(this.$urlAPI + 'conteudo/adicionar', {
                    titulo: this.conteudo.titulo,
                    texto: this.conteudo.texto,
                    link: this.conteudo.link,
                    imagem: this.conteudo.imagem
                }, {
                    'headers': {
                        'authorization': 'Bearer ' + this.$store.getters.getToken
                    }
                }).then(response => {
                    if (response.data.status){                        
                        //console.log(response.data);
                        this.conteudo =  {titulo: '', texto: '', link: '', imagem: ''};
                        this.$store.commit('setConteudosLinhaTempo', response.data.conteudos.data);
                        
                    }                    
                }).catch(e => {
                    console.log(e);
                    alert('Erro! tente mais tarde');
                });
            }
        }
    };
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
