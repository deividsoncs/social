<template>
  <login-template-vue>          
    <span slot="menuesquerdo">        
        <img src="/static/img/social_login.jpg" alt="" class="responsive-img"/>
    </span>
    <span slot="principal">
        <span v-if="!cadastro">
            <h2>Login</h2>
            <input type="text" placeHolder="E-mail:" value="" class="email required"/>
            <input type="text" placeHolder="Senha:" value=""/>
            <button type="button" class="btn">
                Entrar
                <i class="material-icons right">send</i>
            </button>
            <router-link class="btn orange" to="/login/cadastro">
                Cadastre-se
            </router-link>            
        </span>
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
