<template>
  <login-template-vue>          
    <span slot="menuesquerdo">        
        <img src="/static/img/social_login.jpg" alt="" class="responsive-img"/>
    </span>
    <span slot="principal">                
            <h2>Cadastro</h2>
            <input type="text" placeHolder="Nome::" v-model="usuario.name"/>
            <input type="text" placeHolder="E-mail:" class="email" v-model="usuario.email"/>
            <input type="password" placeHolder="Senha:" class="password" v-model="usuario.password"/>
            <input type="password" placeHolder="Confirme sua senha:" class="password" v-model="usuario.password_confirmation"/>
            <button v-on:click="cadastrar()" type="button" name="button" class="btn waves-effect waves-light">Enviar</button>
            <router-link class="btn orange waves-effect waves-light" to="/login">
                Já possuo conta!
                <i class="material-icons">description</i>
            </router-link>
    </span>
  </login-template-vue>
</template>

<script>
  import LoginTemplateVue from "@/templates/LoginTemplateVue";  
  import axios from "axios";
  export default {
    name: 'Cadastro',
    components: {
      LoginTemplateVue
    },
    data() {
      return {
        usuario: {
          name: '',
          email: '',
          password: '',
          password_confirmation: ''
        }
      }
    },
    methods:{
      cadastrar() {
        //console.log('OK cadastrando...');
        axios.post('http://localhost:8000/api/login/cadastro', {
            name: this.usuario.name,
            email: this.usuario.email,
            password: this.usuario.password,
            password_confirmation: this.usuario.password_confirmation
          })
          .then((response) => {
            if(response.data.token){
              //login com sucesso!
              sessionStorage.setItem('usuario', JSON.stringify(response.data));
              //manda para rota x              
              this.$router.push('/');
            }else if(response.data.status == false){
              //login não existe
              console.log('Erro ao tentar cadastrar um usuaário!');
            }else{
              //erro de validacao
              let erros = '';
              for(let erro of Object.values(response.data)){
                erros += erro + " ";
              }
              alert(erros);
            }
            console.log(response);
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
