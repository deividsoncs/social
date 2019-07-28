<template>
 <div class="navbar-fixed">
    <nav :class="cor || 'green darken-1'">
        <div class="nav-wrapper container">
            <router-link :to="url || '/'" class="brand-logo">{{ logo || 'Sem Logo Definido'}}</router-link>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <slot/>
            </ul>
        </div>
    </nav>  
  </div>
</template>

<script>
export default {
  props: ['logo', 'url', 'cor'], 
  name: 'NavBarVue',
  data () {
    return {
      
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
