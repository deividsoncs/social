<template>
  <login-template-vue>
    <span slot="menuesquerdo">        
            <img src="/static/img/social_login.jpg" alt="" class="responsive-img"/>
        </span>
    <span slot="principal">        
                <h2>Login</h2>
                <input type="text" placeHolder="E-mail:" class="email required" v-model="usuario.email"/>
                <input type="password" placeHolder="Senha:" v-model="usuario.password"/>
                <button type="button" class="btn waves-effect waves-light" v-on:click="login()">
                    Entrar
                    <i class="material-icons right">send</i>
                </button>
                <router-link class="btn orange waves-effect waves-light" to="/login/cadastro">
                    Cadastre-se
                    <i class="material-icons right">description</i>
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
        usuario: {
          email: '',
          password: ''
        }
      }
    },
    methods: {
      login() {
        //console.log('OK login');
        this.$http.post(this.$urlAPI + 'login', {
            email: this.usuario.email,
            password: this.usuario.password
          })
          .then((response) => {
            //padronizei os status como retorno no controller da API
            if(response.data.status){
              //login com sucesso!
              sessionStorage.setItem('usuario', JSON.stringify(response.data.usuario));
              //seto o usuário retornado na loja
              this.$store.commit('setUsuario', response.data.usuario);
              //manda para rota x              
              this.$router.push('/');
            }else if(response.data.status == false && response.data.validacao){
              //login não existe mas eu estou validando
              //erro de validacao
              let erros = '';
              for(let erro of Object.values(response.data.erros)){
                erros += erro + " ";
              }
              alert(erros);

            }else{
              console.log(response);  
              alert('Login inválido!');
            }
            
          })
          .catch(function(error) {
            console.log(error);
            alert('Tente novamento mais tarde! Servidor off-line!')
          });
      }
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
