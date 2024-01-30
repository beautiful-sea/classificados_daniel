<template>
    <div
        class="col-md-12 p-0 body-category"
        :style="!anunciantes.data.length ? 'height: calc(100vh - 193px)' : ''"
    >
        <div class="portfolio-wrap grid items-3 items-padding-category">
            <!-- portfolio-card -->
            <template v-if="anunciantes.data.length">
                <div
                    v-for="anunciante in anunciantes.data"
                    class="portfolio-card isotope-item photo marketing Classidied-box"
                >
                    <div class="card card-event info-overlay card-category">
                        <h4 class="card-title-name">
                            <a
                                class="username-user"
                                :href="`/anunciante/` + anunciante.slug"
                                >{{ anunciante.user.name }}</a
                            >
                        </h4>
                        <div class="img has-background">
                            <div class="content-image-anunciante">
                                <img
                                    class="image-anunciante"
                                    :src="anunciante.foto_principal"
                                />
                            </div>
                            <span class="event-badges">
                                <span
                                    class="badge badge-danger"
                                    v-if="anunciante.tag"
                                    >{{ anunciante.tag }}</span
                                >
                            </span>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a
                                    class="information"
                                    :href="`/anunciante/` + anunciante.slug"
                                    >{{ anunciante.titulo }}</a
                                >
                            </h4>
                            <a
                                :href="`/anunciante/` + anunciante.slug"
                                class="content-view-more"
                            >
                                <div class="button-view-more">
                                    <span class="view-more">Ver mais</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <div class="col-md-12 p-0">
                    <div class="alert alert-warning" role="alert">
                        Nenhum anunciante encontrado.
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    name: "Categorias.vue",
    data() {
        return {
            categorias: {
                data: [],
            },
            anunciantes: {
                data: [],
            },
            estados: {
                data: [],
            },
            search: "",
            categoria: null,
            estado: null,
            loading: false,
            perPage: 99999,
        };
    },
    methods: {
        getDescricaoResumida(descricao) {
            if (descricao && descricao.length > 50) {
                return descricao.substring(0, 100) + "...";
            }
            return descricao;
        },
        getCategorias(onlyPai = true, select_id_before = null) {
            let self = this;
            this.loading = true;
            let url = "/api/categorias";
            url += "?perPage=" + this.perPage;
            if (onlyPai) {
                url += "&only_pai=1";
            }

            axios
                .get(url)
                .then((response) => {
                    this.categorias = response.data;
                    if (select_id_before) {
                        let categoria = this.categorias.data.find(
                            (c) => c.id == select_id_before
                        );
                        self.setCategoria(categoria);
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loading = false;
                });
        },

        getEstados() {
            let self = this;
            this.loading = true;
            let url = "/api/estados";
            url += "?only_with_anunciantes=1";
            url += "&perPage=" + this.perPage;

            axios
                .get(url)
                .then((response) => {
                    this.estados = response.data;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loading = false;
                });
        },

        setCategoria(categoria) {
            this.categoria = categoria;
            //Remove pesquisa do campo de busca, da url e do componente
            this.search = "";
            let url = new URL(window.location.href);
            url.searchParams.delete("q");
            window.history.pushState({}, "", url);
            //Remove pesquisa do campo de busca com name=q
            let search = document.querySelector("input[name=q]");
            if (search) {
                search.value = "";
            }

            this.getAnunciantes(categoria);
        },
        setEstado(estado) {
            this.estado = estado;
            //Remove pesquisa do campo de busca, da url e do componente
            this.search = "";
            let url = new URL(window.location.href);
            url.searchParams.delete("q");
            window.history.pushState({}, "", url);
            //Remove pesquisa do campo de busca com name=q
            let search = document.querySelector("input[name=q]");
            if (search) {
                search.value = "";
            }
            this.getAnunciantes(this.categoria, estado);
        },
        getAnunciantes(categoria = null, estado = null) {
            this.loading = true;
            let url = "/api/anunciantes";
            url += "?perPage=" + this.perPage;
            url += "&q=" + this.search;

            if (categoria) {
                url += "&categoria_id=" + categoria.id;
            }
            if (estado) {
                url += "&estado_id=" + estado.id;
            }

            axios
                .get(url)
                .then((response) => {
                    this.anunciantes = response.data;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
    created() {
        //Busca o parametro q na url e seta no search
        let url = new URL(window.location.href);
        let q = url.searchParams.get("q");
        if (q) {
            this.search = q;
        }

        //Se existir o parametro c na url, busca a categoria e seta no componente
        let c = url.searchParams.get("c");
        if (c) {
            this.getCategorias(false, c);
            //Busca os anunciantes daquela categoria
            this.getAnunciantes(c);
        } else {
            this.getCategorias();
            this.getAnunciantes();
        }
        this.getEstados();
    },
};
</script>

<style scoped>
li span {
    cursor: pointer;
}
</style>
