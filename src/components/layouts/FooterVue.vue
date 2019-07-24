<template>
  <footer :class="'page-footer ' + (cor || 'green darken-1')">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">          
          <h5 class="white-text">{{ descricao }}</h5>
          <div class="row">
            <p class="grey-text text-lighten-4"><slot name="conteudo"></slot></p>
          </div>
        </div>
        <div class="col l4 offset-l2 s12">
          <h5 class="white-text">Links</h5>
          <ul>
            <slot>

            </slot>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        © 2019 Copyright. Jump!
        <a class="grey-text text-lighten-4 right" href="#!">Mais links</a>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  props: ["logo", "descricao","cor"],
  name: "FooterVue",
  data() {
    return {};
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
