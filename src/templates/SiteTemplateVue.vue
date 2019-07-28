<template>
    <span>
            <header>
                <nav-bar-vue logo="Jump! Social" url="#/" cor="green darken-1">
                    <li><router-link to="/">Home</router-link></li>
                    <li><router-link to="/login">Entrar</router-link></li>
                </nav-bar-vue>
            </header>
            <main>
                <div class="container">
                    <div class="row">
                        <grid-vue tamanho="4">
                        
                            <slot name="menuesquerdo"/>
                        </grid-vue>
                        <grid-vue tamanho="8">
                        
                            <slot name="pagina"/>
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
    import CardMenuVue from "@/components/social/CardMenuVue";
    export default {
        name: "SiteTemplateVue",
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
