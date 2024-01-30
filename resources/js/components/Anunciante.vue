<template>
  <div class="container">
    <div class="row">

      <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 page-details perfil-container">
        <div class="content-header-anunciante">
          <div class="seller-details">
            <div class="content-image-anunciante-perfil">
              <img class="image-anunciante-perfil" :src="anunciante.foto_perfil" />
            </div>
            <div class="information-anunciante">
              <p>{{ anunciante.user.name }}</p>
              <p>Área de atuação: {{ anunciante.categoria.nome }} </p>
            </div>
          </div>
          <div class="content-mapa-anunciante">
            <div id="map" class="mapa"></div>
          </div>
        </div>

        <div class="single-page-details">

          <div class="row">
            <div class="sindetails-info col-md-8">
              <h3>Experiência</h3>
              <p>
                {{ anunciante.descricao }}
              </p>
            </div>
          </div>
          <div class="row content-agenda">
            <agendar v-if="anunciante.id" :anunciante_id="anunciante.id"></agendar>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Anunciante",
  props: ['slug'],
  data() {
    return {
      anunciante: {
        endereco: {
          cidade: {},
          estado: {}
        },
        categoria: {},
        user: {},
      },
      showContato: false
    }
  },
  methods: {
    salvarVisita() {
      let self = this;
      axios.post('/api/anunciante/' + this.anunciante.id + '/visita').then(response => {
        console.log(response.data);
      });
    },
    salvarCliqueContato() {
      let self = this;
      axios.post('/api/anunciante/' + this.anunciante.id + '/clique_contato').then(response => {
        self.showContato = true;
      });
    },
    getAnunciante: function (salvar_visita = false) {
      axios.get('/api/anunciante/' + this.slug).then(response => {
        this.anunciante = response.data;
        this.initMap();
        if (salvar_visita) {
          this.salvarVisita();
        }
      }).catch(error => {
        console.log(error);
      });
    },
    initMap() {

      //Lat e lng para Number
      this.anunciante.endereco.lat = parseFloat(this.anunciante.endereco.lat);
      this.anunciante.endereco.lng = parseFloat(this.anunciante.endereco.lng);

      //Se lat e lng não forem numeros, seta para 0
      if (isNaN(this.anunciante.endereco.lat) || isNaN(this.anunciante.endereco.lng)) {
        this.anunciante.endereco.lat = 0;
        this.anunciante.endereco.lng = 0;
      }
      var myLatLng = {lat: this.anunciante.endereco.lat, lng: this.anunciante.endereco.lng};

      console.log(myLatLng)
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: myLatLng,
        mapTypeId: 'satellite',
        disableDefaultUI: true,
        zoomControl: true,
        mapTypeControl: true,
        scaleControl: true,
      });

      var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: this.anunciante.titulo,
        draggable: false
      });
      //Adiciona uma caixa de informações com o titulo do anunciante e o endereço
      var contentString = '<div id="content">' +
          '<div id="siteNotice">' +
          '</div>' +
          '<h4 id="firstHeading" class="firstHeading">' + this.anunciante.titulo + '</h4>' +
          '<div id="bodyContent">' +
          '<p><b>Endereço: </b>' + this.anunciante.endereco.logradouro + ', ' + this.anunciante.endereco.cidade.nome + ' - ' + this.anunciante.endereco.estado.sigla + '</p>' +
          '</div>' +
          '</div>';

      var infowindow = new google.maps.InfoWindow({
        content: contentString,
      });
      marker.addListener('click', function () {
        infowindow.open(map, marker);
      });
      infowindow.open(map, marker);

    }
  },
  created() {
    this.getAnunciante(true);
  },
  mounted() {

  }
}
</script>

<style scoped>

</style>
