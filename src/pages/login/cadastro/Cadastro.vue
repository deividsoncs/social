<template>
  <login-template-vue>          
    <span slot="menuesquerdo">        
        <img src="/static/img/social_login.jpg" alt="" class="responsive-img"/>
    </span>
    <span slot="principal">                
            <h2>Cadastro</h2>
            <input type="text" placeHolder="Nome::" value=""/>
            <input type="text" placeHolder="E-mail:" class="email" value=""/>
            <input type="text" placeHolder="Senha:" class="password" value=""/>
            <input type="text" placeHolder="Confirme sua senha:" class="password" value=""/>
            <button href="#/" type="button" name="button" class="btn">Enviar</button>
            <router-link class="btn orange" to="/login">
                Já possuo conta!
                <i class="material-icons">description</i>
            </router-link>
    </span>
  </login-template-vue>
</template>

<script>
  import LoginTemplateVue from "@/templates/LoginTemplateVue";  
  export default {
    name: 'Login',
    components: {
      LoginTemplateVue
    },
    data() {
      return {
        
      }
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
