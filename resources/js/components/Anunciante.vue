<template>
    <div class="container">
        <div class="row">

            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 page-details perfil-container">
                <h2>{{anunciante.user.name}} <span style="background-color: grey;">{{anunciante.categoria.nome}}</span> </h2>


                <div class="single-page-details">

                    <div class="row">
                        <div class="sindetails-info col-md-8">
                            <h5>{{anunciante.titulo}}</h5>
                            <p>
                                {{anunciante.descricao}}
                            </p>


                        </div>
                        <div class="col-md-4">
                            <div class="shot-info">
                                <ul>

                                    <li v-if="anunciante.valor_hora"> <i class="far fa-money-bill-alt"></i> <strong>Valor por hora:</strong>{{anunciante.valor_hora_real}}</li>

                                    <li> <i class="fa fa-globe" aria-hidden="true"></i> <strong>Localização:</strong> {{anunciante.endereco.cidade.nome}} - {{anunciante.endereco.estado.sigla}} </li>
                                    <li> <i class="fas fa-award"></i> <strong>Profissão:</strong>{{anunciante.categoria.nome }} </li>
                                </ul>
                            </div>
                            <div class="contact-seller">

                                <div class="seller-details"> <img :src="anunciante.foto_perfil">
                                    <p><i class="fas fa-user"></i> {{ anunciante.user.name }}</p>
                                    <p><i class="fa fa-map-marker" aria-hidden="true"></i> Localização: {{ anunciante.endereco.cidade.nome }} </p>
                                </div>
                                <div class="seller_message">
                                    <button v-if="!showContato" @click="salvarCliqueContato()" class="btn btn-success btn-block"><i class="fa fa-envelope-o" aria-hidden="true"></i> Ver contato </button>
                                    <button v-else  class="btn btn-success btn-block"><i class="far fa-whatsapp" aria-hidden="true"></i> {{ anunciante.user.phone }}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="map" style="width: 100%; height: 400px;"></div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Anunciante",
    props: ['slug'],
    data(){
        return{
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
    methods:{
        salvarVisita(){
            let self =  this;
            axios.post('/api/anunciante/'+this.anunciante.id+'/visita').then(response => {
                console.log(response.data);
            });
        },
        salvarCliqueContato(){
            let self =  this;
            axios.post('/api/anunciante/'+this.anunciante.id+'/clique_contato').then(response => {
                self.showContato = true;
            });
        },
        getAnunciante(salvar_visita = false){
            axios.get('/api/anunciante/'+this.slug).then(response => {
                this.anunciante = response.data;
                this.initMap();
                if(salvar_visita){
                    this.salvarVisita();
                }
            });
        },
        initMap() {

            //Lat e lng para Number
            this.anunciante.endereco.lat = parseFloat(this.anunciante.endereco.lat);
            this.anunciante.endereco.lng = parseFloat(this.anunciante.endereco.lng);

            //Se lat e lng não forem numeros, seta para 0
            if(isNaN(this.anunciante.endereco.lat) || isNaN(this.anunciante.endereco.lng)){
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
            var contentString = '<div id="content">'+
                '<div id="siteNotice">'+
                '</div>'+
                '<h4 id="firstHeading" class="firstHeading">'+this.anunciante.titulo+'</h4>'+
                '<div id="bodyContent">'+
                '<p><b>Endereço: </b>'+this.anunciante.endereco.logradouro+', '+this.anunciante.endereco.cidade.nome+' - '+this.anunciante.endereco.estado.sigla+'</p>'+
                '</div>'+
                '</div>';

            var infowindow = new google.maps.InfoWindow({
                content: contentString,
            });
            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });
            infowindow.open(map, marker);

        }
    },
    created(){

    },
    mounted(){
        this.getAnunciante(true);
    }
}
</script>

<style scoped>

</style>
