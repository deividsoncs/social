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
    import axios from "axios";
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
          }
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
            this.usuario.imagem = e.target.result;
          }
          reader.readAsDataURL(arquivo[0]);
          console.log(this.usuario.imagem)
        },

        perfil() {
          //console.log('OK perfil');
          axios.put('http://localhost:8000/api/perfil', {
              name: this.usuario.name,
              email: this.usuario.email,
              password: this.usuario.password,
              password_confirmation: this.usuario.password_confirmation,
              imagem: this.usuario.imagem
            }, {"headers":{"authorization":"Bearer " + this.usuario.token}})
            .then((response) => {
              if (response.data.token) {
                //console.log(response.data);
                sessionStorage.setItem('usuario', JSON.stringify(response.data));
                alert('Perfil Atualizado!');
              } else {
                //erro de validacao
                let erros = '';
                for (let erro of Object.values(response.data)) {
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
