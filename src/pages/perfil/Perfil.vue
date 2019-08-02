<template>
  <site-template-vue>
    <span slot="menuesquerdo">        
          <img :src="usuario.imagem || '/static/img/social_login.jpg'" alt="" class="responsive-img"/>
      </span>
    <span slot="pagina">                
      <h2>Perfil</h2>
      <input type="text" placeHolder="Nome::" v-model="usuario.name"/>
      <input type="text" placeHolder="E-mail:" class="email" v-model="usuario.email"/>
      <div class="file-field input-field">
        <div class="btn">
          <span>Imagem</span>
          <input type="file" v-on:change="salvaImagem">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
        </div>
      </div>
      <input type="password" placeHolder="Senha:" class="password" v-model="usuario.password" />
      <input type="password" placeHolder="Confirme sua senha:" class="password" v-model="usuario.password_confirmation" />
      <button v-on:click="perfil()" type="button" name="button" class="btn waves-effect waves-light">Enviar</button>
    </span>
  </site-template-vue>
</template>

<script>
    import SiteTemplateVue from "@/templates/SiteTemplateVue";
    //import axios from "axios"; ja importei no mais.js
    export default {
      name: 'Perfil',
      components: {
        SiteTemplateVue
      },
      data() {
        return {
          usuario: {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            imagem: ''
          },
          imagemAux: ''
        }
      },
      created() {
        let usuarioAux = sessionStorage.getItem('usuario');
        if (usuarioAux) {
          //console.log('wow usuario');
          this.usuario = JSON.parse(usuarioAux);
        }
      },
      methods: {
        //ver documentação javascript
        salvaImagem(e){//pego o evento do onchange do inputFile
          let arquivo = e.target.files || e.dataTransfer.files;
          console.log(arquivo);
          if (!arquivo.length){
            return;
          }
          let reader = new FileReader();
          reader.onload = (e) => {
            this.imagemAux = e.target.result;
            this.usuario.imagem = this.imagemAux;
          }
          reader.readAsDataURL(arquivo[0]);          
        },

        perfil() {
          //console.log('OK perfil');
          this.$http.put(this.$urlAPI + 'perfil', {
              name: this.usuario.name,
              email: this.usuario.email,
              password: this.usuario.password,
              password_confirmation: this.usuario.password_confirmation,
              imagem: this.imagemAux || ''
            }, {"headers":{"authorization":"Bearer " + this.usuario.token}})
            .then((response) => {
              if (response.data.status) {
                //console.log(response.data);
                sessionStorage.setItem('usuario', JSON.stringify(response.data.usuario));
                alert('Perfil Atualizado!');
              } else if (!response.data.status && response.data.validacao){
                //erro de validacao
                let erros = '';
                for (let erro of Object.values(response.data.erros)) {
                  erros += erro + " ";
                }
                alert(erros);
               }else{
                 alert('Erro ao tentar Atualizar perfil! Tente mais tarde!');
                 console.log(response);
               }                             
            })
            .catch(function(error) {
              console.log(error);
              alert('Tente novamente mais tarde! Servidor off-line!')
            });
        }
      }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
