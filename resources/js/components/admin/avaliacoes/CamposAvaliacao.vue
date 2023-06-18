<template>
    <div class="col-4">

        <!-- Project table -->
        <div class="card">
            <h4 class="card-header">Campos de avaliação</h4>
            <div class="card-body">
                <button type="button" v-if="!novoCampo" class="btn btn-primary" @click="novoCampo = {nome:''}">Novo campo</button>
                <div class="mb-3" v-else  >
                    <label for="nome" class="form-label">Nome</label>
                    <div class="input-group">
                        <input v-model="novoCampo.nome" type="text" class="form-control" id="nome"  required>
                        <button @click="salvarCampoAvaliacao()" type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>

            </div>
            <div class="table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <table class="table datatable-project dataTable no-footer dtr-column"
                           id="DataTables_Table_0" role="grid">
                        <thead>
                        <tr role="row">
                            <th class="text-nowrap sorting_disabled" rowspan="1" colspan="1" >Nome
                            </th>
                            <th class="sorting_disabled" rowspan="1" colspan="1" >
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr v-if="campos_avaliacoes.length" v-for="campo in campos_avaliacoes" role="row" class="odd">
                            <td class="dtr-control" style="display: none;"></td>
                            <td>
                                <div v-if="editandoCampoId!=campo.id">
                                    {{ campo.nome }}
                                </div>
                                <div v-else>
                                    <input v-model="campo.nome" type="text" class="form-control" id="nome"  required>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a v-if="editandoCampoId!=campo.id" @click="editandoCampoId = campo.id" type="button" class="btn btn-primary btn-table" >
                                        Editar
                                    </a>
                                    <a v-else @click="editarCampoAvaliacao(campo)" type="button" class="btn btn-success btn-table"  >
                                        Salvar
                                    </a>
                                    <button type="button" class="btn btn-danger btn-table"  @click="deletarCamposAvaliacao(campo)">
                                        Excluir
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr v-if="!campos_avaliacoes.length" role="row" class="odd">
                            <td class="dtr-control" style="display: none;"></td>
                            <td colspan="5">Nenhum campo cadastrado</td>
                        </tr>

                        </tbody>
                    </table>
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
            campos_avaliacoes:  [],
            campoModal: null,
            novoCampo: null,
            editandoCampoId:null
        }
    },
    methods: {
        editarCampoAvaliacao(campo) {
            let self = this;
            axios.put('/api/admin/campos_avaliacoes/'+this.editandoCampoId, campo)
                .then(response => {
                    //toastr de sucesso
                    swal.fire( {
                        title: 'Salvo!',
                        text: 'Campo salvo com sucesso.',
                        icon: 'success',
                        background: '#2a2f48',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    } )
                    self.getCamposAvaliacao()
                    self.editandoCampoId = null
                })
                .catch(error => {
                    //toastr de erro de validação laravel
                    if (error.response.status === 422) {
                        let errors = error.response.data.errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach(function (value) {
                                    toastr.error(value, 'Erro de validação')
                                });
                            }
                        }
                    }
                })
        },
        salvarCampoAvaliacao() {
            let self = this;
            axios.post('/api/admin/campos_avaliacoes', this.novoCampo )
                .then(response => {
                    //toastr de sucesso
                    swal.fire( {
                        title: 'Salvo!',
                        text: 'Campo salvo com sucesso.',
                        icon: 'success',
                        background: '#2a2f48',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    } )
                    self.getCamposAvaliacao()
                    self.novoCampo = null
                })
                .catch(error => {
                    console.log(error)
                })
        },
        getCamposAvaliacao() {
            axios.get('/api/admin/campos_avaliacoes' )
                .then(response => {
                    this.campos_avaliacoes = response.data
                })
                .catch(error => {
                    console.log(error)
                })
        },
        deletarCamposAvaliacao(campo_avaliacao) {
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
                    axios.delete('/api/admin/campos_avaliacoes/'+campo_avaliacao.id )
                        .then(response => {
                            //toastr de sucesso
                            swal.fire( {
                                title: 'Excluído!',
                                text: 'Campo excluído com sucesso.',
                                icon: 'success',
                                background: '#2a2f48',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            } )
                            self.getCamposAvaliacao()
                        })
                        .catch(error => {
                            //Erro 400 mostra o toastr
                            if (error.response.status === 400) {
                                swal.fire( {
                                    title: 'Erro!',
                                    text: error.response.data.message,
                                    icon: 'error',
                                    background: '#2a2f48',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok'
                                } )
                            }
                        })
                }
            } )
        }
    },
    mounted() {
        this.getCamposAvaliacao()
    }
}
</script>

<style scoped>

.stars   {
    fill: #f8ce0b;
}
</style>
