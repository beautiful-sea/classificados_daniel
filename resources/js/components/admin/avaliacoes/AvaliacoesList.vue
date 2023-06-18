<template>
    <div class="col-8">

        <!-- Project table -->
        <div class="card">
            <h4 class="card-header">Avaliações</h4>
            <div class="table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <table class="table datatable-project dataTable no-footer dtr-column"
                           id="DataTables_Table_0" role="grid">
                        <thead>
                        <tr role="row">
                            <th class="text-nowrap sorting_disabled" rowspan="1" colspan="1" >Nome
                            </th>
                            <th class="sorting_disabled" rowspan="1" colspan="1" >Whatsapp
                            </th>
                            <th class="sorting_disabled" rowspan="1" colspan="1" >Data
                            </th>
                            <th class="sorting_disabled" rowspan="1" colspan="1" >
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr v-if="avaliacoes.length" v-for="avaliacao in avaliacoes" role="row" class="odd">
                            <td class="dtr-control" style="display: none;"></td>
                            <td>{{ avaliacao.nome }}</td>
                            <td>{{avaliacao.whatsapp}}</td>
                            <td>{{avaliacao.created_at_for_humans}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a @click="setAvaliacaoModal(avaliacao)" type="button" class="btn btn-primary btn-table"  data-bs-toggle="modal" data-bs-target="#showReviewModal" >
                                        Ver
                                    </a>
                                    <button type="button" class="btn btn-danger btn-table"  @click="deletarAvaliacao(avaliacao)">
                                        Excluir
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr v-if="!avaliacoes.length" role="row" class="odd">
                            <td class="dtr-control" style="display: none;"></td>
                            <td colspan="5">Nenhuma avaliação encontrada</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="showReviewModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-upgrade-plan">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-5 pb-2">
                            <div class="text-center mb-2">
                                <h1 class="mb-1">Avaliação</h1>
                            </div>

                        </div>
                        <hr>
                        <div v-if="avaliacaoModal" class="modal-body px-5 pb-3">
                            <div class="row">
                                <div class="col-12">
                                    <p><b>Nome:</b> {{avaliacaoModal.nome}}</p>
                                    <p><b>E-mail:</b> {{avaliacaoModal.email}}</p>
                                    <p><b>Whatsapp</b> {{avaliacaoModal.whatsapp}}</p>
                                    <p><b>Data:</b> {{avaliacaoModal.created_at_for_humans}}</p>
                                </div>
                                <hr>
                                <div v-for="avaliacao_campo in avaliacaoModal.avaliacao_campos" class="col-12">
                                    <p> {{avaliacao_campo.campo_avaliacao.nome}}:
                                        <svg style="margin-left: 5px" class="stars" v-for="nota in avaliacao_campo.nota" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                                    </p>
                                </div>
                                <hr>
                                <div class="col-12" v-if="avaliacaoModal.comentario">
                                    <p><b>Comentário:</b> {{avaliacaoModal.comentario}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "AvaliacoesList",
    data() {
        return {
            avaliacoes:  [],
            avaliacaoModal:null
        }
    },
    methods: {
        setAvaliacaoModal(avaliacao) {
            this.avaliacaoModal = avaliacao
        },
        getAvaliacoes() {
            axios.get('/api/admin/avaliacoes' )
                .then(response => {
                    this.avaliacoes = response.data
                })
                .catch(error => {
                    console.log(error)
                })
        },
        deletarAvaliacao(avaliacao) {
            let self = this;
            swal.fire( {
                title: 'Tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                //modal dark
                background: '#2a2f48',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'

            } ).then( ( result ) => {
                if ( result.isConfirmed ) {
                    axios.delete('/api/admin/avaliacoes/'+avaliacao.id )
                        .then(response => {
                            //toastr de sucesso
                            swal.fire( {
                                title: 'Excluído!',
                                text: 'Avaliação excluída com sucesso.',
                                icon: 'success',
                                background: '#2a2f48',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            } )
                            self.getAvaliacoes()
                        })
                        .catch(error => {
                            console.log(error)
                        })
                }
            } )
        }
    },
    mounted() {
        this.getAvaliacoes()
    }
}
</script>

<style scoped>

.stars   {
    fill: #f8ce0b;
}
</style>
