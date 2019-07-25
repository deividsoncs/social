<template>
  <span id="app">
                <header>
                  <nav-bar-vue logo="Jump! Social" cor="green darken-1" />
                </header>
                <main>
                  <div class="container">
                    <div class="row">
                      <grid-vue tamanho="3">
                        <card-menu-vue src="https://bit.ly/2LE4kp5" nome="Deividson Calixto" detalhe="Yeap! Let's code!!"></card-menu-vue>
                      </grid-vue>
                      <grid-vue tamanho="9">
                        
                        <router-view />
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
  import CardMenuVue from "@/components/layouts/CardMenuVue";  
  export default {
    name: "App",
    components: {
      NavBarVue,
      FooterVue,
      GridVue,
      CardMenuVue      
    }
  };
</script>

<style>

</style>
