<template>
  <span id="app">
    <header>
      <nav-bar logo="Social" cor="green darken-1" />
    </header>
    <main>
      <div class="container">
        <router-view />
      </div>
      <footer-vue cor="green darken-1" descricao="Minha rede social">        
          <span name="conteudo">AAA</span>  
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
    </main>
  </span>
</template>

<script>
import NavBar from "@/components/layouts/NavBar";
import FooterVue from "@/components/layouts/FooterVue";

export default {
  name: "App",
  components: {
    NavBar,
    FooterVue
  }
};
</script>

<style>
</style>
