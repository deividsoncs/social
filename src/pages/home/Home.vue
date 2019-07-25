<template>
  <div>
    <div class="row">
      <card-conteudo-vue srcperfil="https://bit.ly/2LE4kp5" nome="Deividson Calixto" data="24/07/2019 20:28">
        <card-detalhe-vue srcconteudo="https://bit.ly/32QQxk3" texto="Divisa de Pernambuco com Alagoas." titulo="Entre Divisas..."  />
      </card-conteudo-vue>
    </div>
  </div>
</template>

<script>
  import CardConteudoVue from "@/components/social/CardConteudoVue";
  import CardDetalheVue from "@/components/social/CardDetalheVue";
  export default {
    name: 'Home',
    components: {
      CardConteudoVue,
      CardDetalheVue
    },
    data() {
      return {}
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
