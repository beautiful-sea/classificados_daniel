<template>
    <div class="col-md-12 p-0">
        <div class="nav justify-content-center">
            <ul class="nav-tabs nav-tabs-style-2 text-center px-2 p-md-0 m-0 mb-4">
                <li :class="'nav-filter '+((filter == 'recentes')?'active':'')" @click="setFilter('recentes')">Mais Recentes</li>
                <li :class="'nav-filter '+((filter == 'populares')?'active':'')" @click="setFilter('populares')">Mais Populares</li>
            </ul>
        </div>
        <div class="portfolio-wrap grid items-3 items-padding">

            <!-- portfolio-card -->
            <div v-for="anunciante in anunciantes.data" class="portfolio-card isotope-item photo marketing Classidied-box">
                <div class="card card-event info-overlay">
                    <div class="img has-background"
                         :style="'background-image: url('+anunciante.foto_principal+')'+'; background-size:cover' ">
                        <a :href="'/anunciante/'+anunciante.slug" class="event-pop-link">
                            <span class="event-badges ">
                                 <span class="badge badge-danger"> EM ALTA</span>
                            </span>
                            <div class="event-pop-info">
                                <p class="publisher"><strong> </strong></p>
                                <div class="event-rating">
                                    <div class="star">
                                        <i class="fa  fa-star"></i>
                                        <i class="fa  fa-star"></i> <i class="fa  fa-star"></i> <i
                                            class="fa  fa-star"></i> <i class="fa  fa-star"></i>
                                    </div>
                                    <div class="review-count"> 4.89 | 89 avaliações</div>
                                </div>
                            </div>
                        </a>
                        <a :href="`/anunciante/`+anunciante.slug">
                            <img alt="340x230" class="card-img-top img-responsive" data-holder-rendered="true"
                                 src="images/10x6.gif">
                        </a>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a :href="`/anunciante/`+anunciante.slug">{{ anunciante.titulo }}</a>
                        </h4>
                        <div class="card-event-info">
                            <p class="event-location">
                                <i class="far fa-compass"></i>
                                {{anunciante.endereco.cidade.nome}} - {{anunciante.endereco.cidade.estado.sigla}}
                            </p>
<!--                            <p class="event-time"><i class="far fa-clock"></i> </p>-->
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="pull-left left">
                            <div class="">por
                                <a :href="`/anunciante/`+anunciante.slug">
                                    {{anunciante.user.name}}
                                </a>
                            </div>
                        </div>
<!--                        <div class="pull-right right social-link">-->
<!--                            <a href="#">-->
<!--                                <i class="fa  fa-share-alt"></i>-->
<!--                            </a>-->
<!--                            <a href="#"></a>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>

        </div>


    </div>
</template>

<script>
export default {
    name: "TabsAnunciantes",
    data() {
        return {
            filter: 'recentes',
            anunciantes: {
                data:[]
            },
        }
    },
    methods: {
        setFilter(filter) {
            this.filter = filter;
            this.getAnunciantes();
        },
        getAnunciantes() {
            let url = '/api/anunciantes';
            url += '?filter=' + this.filter;
            axios.get(url)
                .then(response => {
                    this.anunciantes = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        }
    },
    mounted() {
        this.getAnunciantes();
    }
}
</script>

<style scoped>

</style>
