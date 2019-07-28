<template>
    <div class="card-panel grey lighten-5 z-depth-1">
        <div class="row valign-wrapper">
            <div class="col s4">
                <img :src="src" alt="" class="circle responsive-img">
                <!-- notice the "circle" class -->
            </div>
            <div class="col s8">
                <span class="black-text">
                                    <h6>{{ nome }}</h6>
                                    {{ detalhe }}
                                  </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["src", "nome", "detalhe"],
        name: "CardMenuVue",
        data() {
            return {};
        }
    };
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
