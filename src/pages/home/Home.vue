<template>
  <site-template-vue>
    <span slot="menuesquerdo">            
        <card-menu-vue :src="usuario.imagem || 'https://bit.ly/2LE4kp5'" nome="Deividson Calixto" detalhe="Yeap! Let's code!!"></card-menu-vue>
    </span>
    <span slot="pagina">
        <publicar-conteudo-vue/>
        <card-conteudo-vue :srcperfil="usuario.imagem || 'https://bit.ly/2LE4kp5'" nome="Deividson Calixto" data="24/07/2019 20:28">
          <card-detalhe-vue srcconteudo="https://bit.ly/32QQxk3" texto="Divisa de Pernambuco com Alagoas." 
            titulo="Entre Divisas..."  />
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
          }
      }
    },
    created(){
      let usuarioAux = sessionStorage.getItem('usuario');
        if (usuarioAux) {
          //console.log('wow usuario');
          this.usuario = JSON.parse(usuarioAux);
        }
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
