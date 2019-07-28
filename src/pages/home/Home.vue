<template>
  <site-template-vue>
    <span slot="menuesquerdo">            
        <card-menu-vue src="https://bit.ly/2LE4kp5" nome="Deividson Calixto" detalhe="Yeap! Let's code!!"></card-menu-vue>
    </span>
    <span slot="pagina">
        <publicar-conteudo-vue/>
        <card-conteudo-vue srcperfil="https://bit.ly/2LE4kp5" nome="Deividson Calixto" data="24/07/2019 20:28">
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
      return {}
    }    
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
