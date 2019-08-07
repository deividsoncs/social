<template>
  <site-template-vue>
    <span slot="menuesquerdo">            
        <card-menu-vue :src="usuario.imagem || 'https://bit.ly/2LE4kp5'" :nome="usuario.name" detalhe="fazer essas msg"></card-menu-vue>
    </span>
    <span slot="pagina">
        <publicar-conteudo-vue/>
        <card-conteudo-vue v-for='item in listaConteudos' :key="item.id" :srcperfil="item.user.imagem || 'https://bit.ly/2LE4kp5'" 
          :nome="item.user.name" :data="item.data">
          <card-detalhe-vue :srcconteudo="item.imagem" :texto="item.titulo" 
            :titulo="item.texto"  />
        </card-conteudo-vue>
      </span>
  </site-template-vue>
</template>

<script>
  import SiteTemplateVue from "@/templates/SiteTemplateVue";
  import CardMenuVue from "@/components/social/CardMenuVue";
  import CardConteudoVue from "@/components/social/CardConteudoVue";
  import CardDetalheVue from "@/components/social/CardDetalheVue";
  import PublicarConteudoVue from "@/components/social/PublicarConteudoVue";
  export default {
    name: 'Home',
    components: {
      SiteTemplateVue,
      CardMenuVue,
      CardConteudoVue,
      CardDetalheVue,
      PublicarConteudoVue
    },
    data() {
      return {
        usuario: {
          name: '',
          email: '',
          password: '',
          password_confirmation: '',
          imagem: ''
          },
      }
    },
    created(){
      let usuarioAux = sessionStorage.getItem('usuario');
      if (usuarioAux) {          
        this.usuario = JSON.parse(usuarioAux);

        this.$http.get(this.$urlAPI + 'conteudo/lista', 
            {"headers":{"authorization":"Bearer " + this.usuario.token}})
            .then((response) => {
              if (response.data.status){
                //this.conteudos = response.data.conteudos.data;
                this.$store.commit('setConteudosLinhaTempo', response.data.conteudos.data);
                
              }
                
            })
            .catch(function(error) {
              console.log(error);
              alert('Tente novamente mais tarde! Servidor off-line!')
            });
      }
    },
    computed:{
      listaConteudos(){
        return this.$store.getters.getConteudosLinhaTempo;
      }
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
