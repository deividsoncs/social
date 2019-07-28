<template>
  <span>
      <div v-if="srcconteudo" class="card-image">
        <img :src="srcconteudo" class="responsive-img">
        <span class="card-title"><strong>{{ titulo || '' }}</strong></span>
      </div>
      <div v-if="texto" class="card-content">
        <p>{{ texto }}</p>
      </div>
  </span>
</template>

<script>
  export default {
    props: ["titulo", "texto", "srcconteudo"],
    name: "CardDetalheVue",
    data() {
      return {};    
    }
  };
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
