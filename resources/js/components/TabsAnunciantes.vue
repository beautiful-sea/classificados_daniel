<template>
    <div class="col-md-12 p-0">
        <div class="portfolio-wrap grid items-3 items-padding">

            <!-- portfolio-card -->
            <div v-for="anunciante in anunciantes.data" class="portfolio-card isotope-item photo marketing Classidied-box">
                <div class="card card-event info-overlay">
                    <h4 class="card-title-name">
                        <a class="username-user" :href="`/anunciante/`+anunciante.slug">{{anunciante.user.name}}</a>
                    </h4>
                    <div class="img has-background">
                        <div class="content-image-anunciante">
                            <img class="image-anunciante" :src="anunciante.foto_principal || '/images/avatar.web'"/>
                        </div>  
                        <span class="event-badges ">
                                <span class="badge badge-danger" v-if="anunciante.tag">{{anunciante.tag }}</span>
                        </span>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a class="information" :href="`/anunciante/`+anunciante.slug">{{ anunciante.titulo }}</a>
                        </h4>
                        <a :href="`/anunciante/`+anunciante.slug" class="content-view-more">
                            <div class="button-view-more">
                                <span class="view-more">Ver mais</span>
                            </div>
                        </a>
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
