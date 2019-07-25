<template>
  <div :class="'col s' + tamanho || '12'">
    <slot></slot>
  </div>
</template>

<script>
  export default {
    props: ["tamanho"],
    name: "GridVue",
    data() {
      return {};
    }
  };
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
