<template>
  <div id="loader">

  </div>
</template>

<script>
export default {
    name: "Loader",
    mounted() {
        // //Seleciona o elemento pai do #loader
        // var el = document.getElementById('loader').parentElement;
        // //Todos os elementos filhos do elemento pai do #loader com opacidade 0.2, execto o #loader
        // var children = el.querySelectorAll(':not(#loader)');
        // //Adiciona a classe blur a todos os elementos filhos do elemento pai do #loader com opacidade 0.2, execto o #loader
        // children.forEach(function(element) {
        //     element.classList.add("blur");
        //     //0.2 de opacidade
        //     element.style.opacity = "0.8";
        // });
    },
    //Quando o v-if no componente pai for false, o componente Loader é destruido
    destroyed() {
        //Seleciona o elemento pai do #loader
        // var el = document.getElementById('loader').parentElement;
        // //Todos os elementos filhos do elemento pai do #loader com opacidade 0.2, execto o #loader
        // var children = el.querySelectorAll(':not(#loader)');
        // //Remove a classe blur a todos os elementos filhos do elemento pai do #loader com opacidade 0.2, execto o #loader
        // children.forEach(function(element) {
        //     element.classList.remove("blur");
        //     //1 de opacidade
        //     element.style.opacity = "1";
        // });
    }

}
</script>

<style scoped>

#loader {
  position: fixed;
  z-index: 999;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 50px;
  height: 50px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 0.5s linear infinite;

}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }

}



</style>
