<template>
    <div id="form">
        <div class="col-lg-12 form-group">
            <label>Nome</label>
            <input
                class="form-control"
                v-model="anunciante.name"
                name="first-name"
                placeholder="Nome"
                type="text"
            />
        </div>
        <div class="col-lg-12 form-group">
            <label>Email</label>
            <input
                class="form-control"
                v-model="anunciante.email"
                name="email"
                placeholder="Email"
                type="email"
            />
        </div>
        <div class="col-lg-12 form-group">
            <label>Telefone</label>
            <input
                class="form-control"
                v-model="anunciante.phone"
                name="telefone"
                placeholder="Telefone / contato"
                type="text"
            />
        </div>
        <div class="col-lg-12 form-group">
            <label>Categoria</label>
            <template
                v-if="
                    anunciante.anunciante &&
                    anunciante.anunciante.subcategoria_id
                "
            >
                <select
                    class="form-control select2"
                    @change="getCategorias"
                    v-model="anunciante.anunciante.subcategoria_id"
                >
                    <option
                        :value="categoria.id"
                        v-for="categoria in categorias.data"
                    >
                        {{ categoria.nome }}
                    </option>
                </select>
            </template>
            <template v-else>
                <p>Sem Categoria</p>
            </template>
        </div>
        <hr />
        <div class="col-12">
            <h3>Endereco:</h3>
        </div>
        <div class="col-lg-12 form-group">
            <label>CEP</label>
            <input
                class="form-control"
                name="codigo-postal"
                v-model="anunciante.endereco.cep"
                placeholder="Código Postal"
                type="text"
            />
        </div>
        <div class="col-lg-12 form-group">
            <label>Endereço</label>
            <input
                class="form-control"
                name="endereco"
                v-model="anunciante.endereco.logradouro"
                placeholder="Endereço"
                type="text"
            />
        </div>
        <div class="col-lg-12 form-group">
            <label>Estado</label>
            <select
                class="form-control select2"
                @change="getCidades"
                v-model="anunciante.endereco.estado_id"
            >
                <option :value="estado.id" v-for="estado in estados.data">
                    {{ estado.sigla }}
                </option>
            </select>
        </div>
        <div class="col-lg-12 form-group">
            <label>Cidade</label>
            <select
                :disabled="!this.anunciante.endereco.estado_id"
                class="form-control select2"
                v-model="anunciante.endereco.cidade_id"
            >
                <option :value="cidade.id" v-for="cidade in cidades.data">
                    {{ cidade.nome }}
                </option>
            </select>
        </div>

        <!--        Mapa com a localização do usuario e opção dele editar sua localização (Google maps)-->
        <div class="col-lg-12 form-group">
            <label>Localização</label>
            <div id="map" style="width: 100%; height: 400px"></div>
        </div>
        <hr />

        <h3>Informações:</h3>
        <!--            Titulo-->
        <div class="col-lg-12 form-group">
            <label>Titulo</label>
            <template
                v-if="anunciante.anunciante && anunciante.anunciante.titulo"
            >
                <input
                    class="form-control"
                    v-model="anunciante.anunciante.titulo"
                    name="titulo"
                    placeholder="Titulo"
                    type="text"
                />
            </template>
            <template v-else>
                <p>Sem Titulo</p>
            </template>
        </div>
        <!--            Descrição-->
        <div class="col-lg-12 form-group">
            <label>Descrição</label>
            <template
                v-if="anunciante.anunciante && anunciante.anunciante.descricao"
            >
                <textarea
                    class="form-control"
                    v-model="anunciante.anunciante.descricao"
                    name="descricao"
                    placeholder="Descrição"
                    type="text"
                ></textarea>
            </template>
            <template v-else>
                <p>Sem Descrição</p>
            </template>
        </div>

        <!--        Valor Hora-->
        <!--        <div class="col-lg-12 form-group">-->
        <!--            <label>Valor Hora</label>-->
        <!--            <input class="form-control" v-model="anunciante.anunciante.valor_hora" name="valor_hora"-->
        <!--                   placeholder="Valor Hora" type="text" v-mask-money>-->
        <!--        </div>-->

        <hr />

        <div class="col-lg-12 form-group">
            <input
                value="Atualizar Perfil"
                @click="atualizarPerfil()"
                class="btn btn-success regi-btn btn-md"
                name="atualizar"
                type="submit"
            />
        </div>

        <h3>Galeria:</h3>

        <!--        Foto principal-->
        <div class="col-lg-12 form-group">
            <label>Imagem principal</label>
            <input
                class="form-control"
                @input="setFotoPrincipal"
                name="foto_principal"
                placeholder="Foto principal"
                type="file"
            />
        </div>
        <div class="col-lg-12 form-group">
            <label>Imagens</label>
            <input
                class="form-control"
                multiple
                @input="setImagens"
                name="imagens[]"
                placeholder="Imagens"
                type="file"
            />
        </div>

        <!--        Botao de salvar fotos-->
        <div class="col-lg-12 form-group">
            <input
                value="Salvar"
                class="btn btn-success regi-btn btn-md"
                @click="salvarFotos"
                name="salvar_fotos"
                type="submit"
            />
        </div>
    </div>
</template>

<script>
export default {
    name: "EditarPerfil",
    props: {
        userId: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            estados: {
                data: [],
            },
            cidades: {
                data: [],
            },
            categorias: {
                data: [],
            },
            marker: null,
            map: null,
            anunciante: {
                endereco: {
                    cidade: {},
                    estado: {},
                },
                anunciante: {
                    categoria: {},
                    imagens: [],
                },
            },
        };
    },
    computed: {
        //Latitude e longitude do anunciante convertidos para number
        lat: {
            get() {
                return Number(this.anunciante.endereco.lat);
            },
            set(value) {
                this.anunciante.endereco.lat = value;
            },
        },
        lng: {
            get() {
                return Number(this.anunciante.endereco.lng);
            },
            set(value) {
                this.anunciante.endereco.lng = value;
            },
        },
    },
    //Se a lat ou lng mudar, atualiza o mapa
    watch: {
        lat() {
            this.initMap();
        },
        lng() {
            this.initMap();
        },
    },
    methods: {
        getCoordinates() {
            let self = this;

            if (
                !this.anunciante.endereco.lat ||
                !this.anunciante.endereco.lng
            ) {
                var geocoder = new google.maps.Geocoder();

                //Endereco é logradouro + cidade + estado
                let endereco =
                    this.anunciante.endereco.logradouro +
                    ", " +
                    this.anunciante.endereco?.cidade?.nome +
                    ", " +
                    this.anunciante?.endereco?.estado?.sigla;
                geocoder.geocode(
                    { address: endereco },
                    function (results, status) {
                        if (status == "OK") {
                            self.lat = results[0].geometry.location.lat();
                            self.lng = results[0].geometry.location.lng();
                        } else {
                            // handle errors here
                            toastr.error(
                                "Não foi possível encontrar a localização"
                            );
                        }
                    }
                );
            } else {
                self.lat = this.anunciante.endereco.lat;
                self.lng = this.anunciante.endereco.lng;
            }
        },
        setMarkers() {
            let self = this;
            const image = {
                url: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
                size: new google.maps.Size(20, 32),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(0, 32),
            };

            let marker = new google.maps.Marker({
                position: { lat: self.lat, lng: self.lng },
                map: self.map,
                icon: image,
                draggable: true,
            });

            google.maps.event.addListener(marker, "dragend", function (event) {
                // Atualize as coordenadas da localização do usuário com a nova posição do marcador
                var latLng = event.latLng;
                self.lat = latLng.lat();
                self.lng = latLng.lng();
            });

            //Cria uma janela de informação
            let infowindow = new google.maps.InfoWindow({
                content: "Arraste o marcador para a sua localização",
            });

            //Abre a janela de informação
            infowindow.open(self.map, marker);

            this.marker = marker;
        },
        initMap() {
            //caso ja exista um mapa, o zoom do mapa novo é o mesmo do antigo
            let zoom = 15;
            if (this.map) {
                zoom = this.map.zoom;
            }
            //Se ja existir um mapa, o tipo de mapa é o mesmo do antigo
            let mapTypeId = "roadmap";
            if (this.map) {
                mapTypeId = this.map.mapTypeId;
            }

            //corrige: etCenter: not a LatLng or LatLngLiteral with finite coordinates: in property lat: not a number
            if (!this.lat || !this.lng) {
                this.lat = 0;
                this.lng = 0;
            }

            this.map = new google.maps.Map(document.getElementById("map"), {
                zoom: zoom,
                center: { lat: this.lat, lng: this.lng },
                //Padrao como mapa
                mapTypeId: mapTypeId,
            });

            this.setMarkers();
        },
        salvarFotos() {
            let url = "/anunciante/" + this.anunciante.anunciante.id + "/fotos";
            let formData = new FormData();
            formData.append(
                "foto_principal",
                this.anunciante.anunciante.foto_principal
            );
            console.log(this.anunciante.anunciante.imagens, "imagens", this.anunciante.anunciante.foto_principal, "foto principal")
            if (this.anunciante.anunciante.imagens) {
                for (
                    let i = 0;
                    i < this.anunciante.anunciante.imagens.length;
                    i++
                ) {
                    formData.append(
                        "imagens[]",
                        this.anunciante.anunciante.imagens[i]
                    );
                }
            } else {
                toastr.error("Selecione uma imagem");
                return;
            }
            axios
                .put(url, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    toastr.success("Fotos salvas com sucesso!");
                }).catch(error => {
                    toastr.error("Erro ao salvar fotos");
                    console.log(error);
                });
        },
        setFotoPrincipal(event) {
            this.anunciante.anunciante.foto_principal = event.target.files[0];
        },
        setImagens(event) {
            this.anunciante.anunciante.imagens = event.target.files;
        },
        getCidades() {
            let url = "/api/cidades/" + this.anunciante.endereco.estado_id;
            let perPage = 99999;
            url += "?perPage=" + perPage;
            axios.get(url).then((response) => {
                this.cidades = response.data;
            });
        },
        getEstados() {
            let url = "/api/estados";
            let perPage = 99999;
            url += "?perPage=" + perPage;
            axios.get(url).then((response) => {
                this.estados = response.data;
            });
        },
        getCategorias() {
            let url = "/api/categorias/";
            let perPage = 99999;
            url += "?perPage=" + perPage;
            axios.get(url).then((response) => {
                this.categorias = response.data;
            });
        },

        atualizarPerfil() {
            let self = this;
            //Desformata o valor_hora para salvar no banco
            this.anunciante.anunciante.valor_hora =
                this.anunciante.anunciante.valor_hora
                    .replace("R$ ", "")
                    .replace(".", "")
                    .replace(",", ".");
            this.anunciante.endereco.lat = this.lat;
            this.anunciante.endereco.lng = this.lng;

            axios
                .put("/anunciante/" + this.anunciante.id, this.anunciante)
                .then((response) => {
                    self.anunciante = response.data;
                    toastr.success("Perfil atualizado com sucesso!");
                    self.getCoordinates();
                });
        },
        getAnunciante() {
            let url = "/api/anunciante/user/" + this.userId;
            axios.get(url).then((response) => {
                this.anunciante = response.data;
                //Se o endereco nao tiver lat e lng, seta para do rio de janeiro
                if (
                    !this.anunciante.endereco.lat ||
                    !this.anunciante.endereco.lng
                ) {
                    this.anunciante.endereco.lat = -22.2406799;
                    this.anunciante.endereco.lng = -43.7445063;
                } else {
                    this.anunciante.endereco.lat = Number(
                        this.anunciante.endereco.lat
                    );
                    this.anunciante.endereco.lng = Number(
                        this.anunciante.endereco.lng
                    );
                }
                if (this.anunciante.endereco.estado_id) {
                    this.getCidades();
                }

                this.getCoordinates();
            });
        },
    },
    //Mascara o campo de valor_hora para o formato de moeda brasileiro
    directives: {
        "mask-money": {
            inserted: function (el) {
                //Sem biblioteca
                el.addEventListener("keyup", function (e) {
                    e.currentTarget.value = e.currentTarget.value
                        .replace(/\D/g, "")
                        .replace(/([0-9]{2})$/g, ",$1");
                    e.currentTarget.value = e.currentTarget.value.replace(
                        /(?=(?:[0-9]{3})+(?:\.|$))/g,
                        "."
                    );
                    if (e.currentTarget.value.length > 6) {
                        e.currentTarget.value = e.currentTarget.value.replace(
                            /([0-9]{3}),([0-9]{2}$)/g,
                            ".$1,$2"
                        );
                    }
                });
            },
        },
    },
    created() {
        this.getEstados();
        this.getCategorias();
    },
    mounted() {
        this.getAnunciante();
    },
};
</script>

<style scoped></style>
