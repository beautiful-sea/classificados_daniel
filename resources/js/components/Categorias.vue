<template>
    <section class="grayBG pt80 pb50 GridList adsDetails">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                    <div class="accordion accordion-primary" id="accordion2">
                        <!-- item -->
                        <div class="accordion-item">
                            <div class="accordion-title"><a class="h6 mb-0" data-toggle="collapse" href="#collapse-4">Todas</a>
                            </div>
                            <div class="collapse show" id="collapse-4" data-parent="#accordion2">
                                <div class="accordion-content">
                                    <ul >
                                        <li  v-for="c in categorias.data"><span @click="setCategoria(c)"
                                                :style="categoria && c.id === categoria.id?'font-weight: bold;':''">
                                            <svg style="width: 4px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                                            {{ c.nome }}<span>({{
                                            c.count_anunciantes
                                            }})</span></span>
                                            <ul v-if="c.categorias_filho && c.categorias_filho.length" >
                                                 <li style="margin-left:20px" v-for="cf in c.categorias_filho">
                                                     <svg style="width: 4px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"/></svg>
                                                     <span @click="setCategoria(cf)"
                                                         :style="categoria && cf.id === categoria.id?'font-weight: bold;':''">
                                                         {{ cf.nome }}
                                                         <span>({{
                                                             cf.count_anunciantes
                                                         }})</span></span>
                                                 </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- item -->
                        <div class="accordion-item">
                            <div class="accordion-title"><a class="collapsed" data-toggle="collapse" href="#collapse-5">Localização</a>
                            </div>
                            <div class="collapse" id="collapse-5" data-parent="#accordion2">
                                <div class="accordion-content">
                                    <ul>
                                        <li v-for="e in estados.data" @click="setEstado(e)"><span
                                                :style="estado && e.id === estado.id?'font-weight: bold;':''"><i
                                                class="fas fa-map-marker-alt"></i>{{
                                            e.nome
                                            }}<span>({{ e.count_anunciantes }})</span></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- item -->
                        <!--                        <div class="accordion-item">-->
                        <!--                            <div class="accordion-title"> <a class="collapsed" data-toggle="collapse" href="#collapse-6">Preço</a> </div>-->
                        <!--                            <div class="collapse" id="collapse-6" data-parent="#accordion2">-->
                        <!--                                <div class="accordion-content">-->
                        <!--                                    <div class="row">-->
                        <!--                                        <form role="form" class="form-inline ">-->
                        <!--                                            <div class="form-group col-lg-5 no-padding">-->
                        <!--                                                <input type="text" placeholder="R$ 2000 " id="minPrice" class="form-control">-->
                        <!--                                            </div>-->
                        <!--                                            <div class="form-group col-lg-2 no-padding text-center"> -</div>-->
                        <!--                                            <div class="form-group col-lg-5 col-md-12 no-padding">-->
                        <!--                                                <input type="text" placeholder="R$ 3000 " id="maxPrice" class="form-control">-->

                        <!--                                            </div>-->
                        <!--                                            <div class="form-group col-lg-5 col-md-12 btn_filtrar">-->
                        <!--                                                <input type="button" value="Filtrar" id="btn_filtrar" class="form-control">-->

                        <!--                                            </div>-->

                        <!--                                        </form>-->
                        <!--                                    </div>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </div>-->


                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                    <loader v-if="loading"></loader>
                    <div class="row">
                        <!-- card -->
                        <div v-if="anunciantes.data.length" v-for="a in anunciantes.data"
                             class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alsp-listing listing-post-style-listview_mod alsp-featured clearfix">
                            <div class="listing-wrapper clearfix">
                                <figure class="alsp-listing-logo alsp-listings-own-page"><a :href="'/anunciante/'+a.slug"><img alt=""
                                                                                                                :src="'/storage/'+a.foto_principal"></a>
                                    <div class="listing-logo-overlay"></div>
                                    <!--                                    <span class="featured-tag-10">Em Alta</span>-->
                                </figure>
                                <div class="clearfix alsp-listing-text-content-wrap">
                                    <div class="clearfix mod-inner-content">
                                        <div class="cat-wrapper"><a class="listing-cat" :href="'/anunciante/'+a.slug"
                                                                    rel="tag">{{ a.categoria.nome }}</a><span
                                                class="cat-seperator pacz-icon-angle-right"></span></div>
                                        <header class="alsp-listing-header">
                                            <h2><a :href="'/anunciante/'+a.slug" title="Samsung Galaxy S8 Plus">{{ a.titulo }}</a>
                                                <!--                                                <span class="author-unverified fas fa-certificate"></span>-->
                                            </h2>
                                        </header>
                                        <div class="list-exerpt-field clearfix">
                                            <div class="alsp-field alsp-field-output-block alsp-field-output-block-excerpt alsp-field-output-block-1">
                                                <span class="alsp-field-content">{{
                                                    getDescricaoResumida(a.descricao)
                                                    }} </span></div>
                                        </div>
                                        <div id="fields-block-inline550"
                                             class="list-fields-wrapper inline-fields clearfix"></div>
                                        <div class="list-fields-wrapper block-fields clearfix"></div>
                                        <p class="listing-location"><i class="far fa-compass"></i> <span
                                                class="alsp-location"><span class="alsp-show-on-map"><span>{{
                                            a.endereco.cidade.nome
                                            }}</span></span></span></p>
                                    </div>
                                    <div class="modlist-bottom-area clearfix">
                                        <div class="listing-rating grid-rating"><span class="rating-numbers">4.0</span>
                                            <a href="" class="single-rating review_rate display-only" title="good">
                                                <span class="rating-value">(<span
                                                        itemprop="reviewCount">2</span>)</span> <i
                                                    class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                    class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                    class="far fa-star"></i> </a></div>
                                        <div class="price">
                                            <div class="alsp-field alsp-field-output-block alsp-field-output-block-price alsp-field-output-block-9">
                                                <span class="alsp-field-caption"> </span> <span
                                                    class="alsp-field-content"> R$151/H </span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-author-content-area">
                                    <div class="listng-author-img"><a :href="'/anunciante/'+a.slug"><img class="pacz-user-avatar"
                                                                                          :src="a.foto_perfil"
                                                                                          alt="author"></a>
                                        <!--                                        <span class="author-in-active"></span>-->
                                    </div>
                                    <div class="listng-author-name"><a style="color:grey;" :href="'/anunciante/'+a.slug"><strong>{{
                                        a.user.name
                                        }}</strong></a></div>
                                    <div class="listng-author-url"><a :href="'/anunciante/'+a.slug">contato</a></div>
                                </div>
                            </div>
                        </div>
                        <!--                        Nenhum anunciante encontrado-->
                        <div v-if="!anunciantes.data.length"
                             class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alsp-listing listing-post-style-listview_mod alsp-featured clearfix">
                            <div style=" float:left;margin-left:50px;">
                                <h1 style="font-weight:bold;font-size:34px;"> Nenhum resultado encontrado</h1>
                                <div style="font-size:25px;text-align:left;">
                                    <ul>
                                        <li>Verifique se a busca está escrita corretamente.</li>
                                        <li>Procure por palavras-chave mais genéricas.</li>
                                        <li>Procure por categorias.</li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "Categorias.vue",
    data() {
        return {
            categorias: {
                data: []
            },
            anunciantes: {
                data: []
            },
            estados: {
                data: []
            },
            search: '',
            categoria: null,
            estado: null,
            loading: false,
            perPage: 99999,
        }
    },
    methods: {
        getDescricaoResumida(descricao) {
            if (descricao && descricao.length > 50) {
                return descricao.substring(0, 100) + '...';
            }
            return descricao;
        },
        getCategorias(onlyPai = true) {
            let self = this;
            this.loading = true;
            let url = '/api/categorias';
            url += '?perPage=' + this.perPage;
            if (onlyPai) {
                url += '&only_pai=1';
            }

            axios.get(url).then((response) => {
                this.categorias = response.data;
            }).catch((error) => {
                console.log(error);
            }).finally(() => {
                this.loading = false;
            });
        },

        getEstados() {
            let self = this;
            this.loading = true;
            let url = '/api/estados';
            url += '?only_with_anunciantes=1';
            url += '&perPage=' + this.perPage;

            axios.get(url).then((response) => {
                this.estados = response.data;
            }).catch((error) => {
                console.log(error);
            }).finally(() => {
                this.loading = false;
            });
        },

        setCategoria(categoria) {
            this.categoria = categoria;
            //Remove pesquisa do campo de busca, da url e do componente
            this.search = '';
            let url = new URL(window.location.href);
            url.searchParams.delete('q');
            window.history.pushState({}, '', url);
            //Remove pesquisa do campo de busca com name=q
            let search = document.querySelector('input[name=q]');
            if (search) {
                search.value = '';
            }

            this.getAnunciantes(categoria);
        },
        setEstado(estado) {
            this.estado = estado;
            //Remove pesquisa do campo de busca, da url e do componente
            this.search = '';
            let url = new URL(window.location.href);
            url.searchParams.delete('q');
            window.history.pushState({}, '', url);
            //Remove pesquisa do campo de busca com name=q
            let search = document.querySelector('input[name=q]');
            if (search) {
                search.value = '';
            }
            this.getAnunciantes(this.categoria, estado);
        },
        getAnunciantes(categoria = null, estado = null) {
            this.loading = true;
            let url = '/api/anunciantes';
            url += '?perPage=' + this.perPage;
            url += '&q=' + this.search;

            if (categoria) {
                url += '&categoria_id=' + categoria.id;
            }
            if (estado) {
                url += '&estado_id=' + estado.id;
            }

            axios.get(url).then((response) => {
                this.anunciantes = response.data;
            }).catch((error) => {
                console.log(error);
            }).finally(() => {
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

        this.getCategorias();
        this.getAnunciantes();
        this.getEstados();


    }
}
</script>

<style scoped>
li span {
    cursor: pointer;
}
</style>
