<template>
    <span>
                <header>
                    <nav-bar-vue logo="Jump! Social" url="#/" cor="green darken-1">                        
                        <li v-if="!usuario"><router-link to="/login">Entrar</router-link></li>
                        <li v-if="!usuario"><router-link to="/login/cadastro">Cadastre-se</router-link></li>
                        <li v-if="usuario"><router-link to="/">{{ usuario.name }}</router-link></li>
                        <li v-if="usuario"><a v-on:click="sair()">Sair</a></li>
                    </nav-bar-vue>
                </header>
                <main>
                    <div class="container">
                        <div class="row">
                            <grid-vue tamanho="4">
                            
                            <slot name="menuesquerdo"/>
                            </grid-vue>
                            <grid-vue tamanho="8">
                            
                            <slot name="principal"/>
                            </grid-vue>
                        </div>                  
                    </div>
                    </main>
                    <footer-vue cor="green darken-1" descricao="Jump! a sua rede social">                  
                    <li>
                        <a class="grey-text text-lighten-3" href="#!">Link 1</a>
                    </li>
                    <li>
                        <a class="grey-text text-lighten-3" href="#!">Link 2</a>
                    </li>
                    <li>
                        <a class="grey-text text-lighten-3" href="#!">Link 3</a>
                    </li>
                    <li>
                        <a class="grey-text text-lighten-3" href="#!">Link 4</a>
                    </li>
                    </footer-vue>
                                
            </span>
</template>

<script>
    import NavBarVue from "@/components/layouts/NavBarVue";
    import FooterVue from "@/components/layouts/FooterVue";
    import GridVue from "@/components/layouts/GridVue";
    import CardMenuVue from "@/components/social/CardMenuVue";
    export default {
        name: "LoginTemplateVue",
        data(){
            return {
                usuario: false
            }
        },        
        components: {
            NavBarVue,
            FooterVue,
            GridVue,
            CardMenuVue
        },
        created() {
            //console.log('executei o created()');
            let usuarioAux = this.$store.getters.getUsuario;
            if(usuarioAux){
                //console.log('wow usuario');
                this.usuario =  this.$store.getters.getUsuario;
                //se eu tenho usuário logado mando para o /
                this.$router.push('/');
            }
        },
        methods:{
            sair(){
                this.$store.commit('setUsuario', null)
                sessionStorage.clear();
                this.usuario = false;
            }
        }
    };
</script>

<style>

</style>
