<template>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <h3>Lista de categorias</h3>

            <!-- Permission Table -->
            <div class="card" style="border-radius: 5px; ">
                <div class="top-table">
                    <div class="exibir">
                        <p>Exibindo </p>
                        <select name="tabela-length" v-model="perPage" class="form-select">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>

                    <div class="btn_cadastrar">

                        <div class="form-modal-ex">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-table" data-bs-toggle="modal" data-bs-target="#inlineForm">
                                Cadastrar
                            </button>
                            <!-- Modal -->
                            <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">Cadastrar Categoria</h4>
                                            <button style="width: 20px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="#">
                                            <div class="modal-body">
                                                <label>Nome: </label>
                                                <div class="mb-1">
                                                    <input type="text" v-model="newCategoria.nome" placeholder="Nome da Categoria" class="form-control" />
                                                </div>
                                                <label>Categoria pai: </label>
                                                <div class="mb-1">
                                                    <select class="select2 form-control" v-model="newCategoria.categoria_pai_id">
                                                        <option :value="null" >Nenhuma (Categoria Principal)</option>
                                                        <option :value="categoria.id" v-for="categoria in selectCategoriasPai">{{ categoria.nome }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="cadastrarCategoria">Cadastrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade text-start" id="modalEditarCategoria" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">Editar Categoria</h4>
                                            <button style="width: 20px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="#">
                                            <div class="modal-body">
                                                <label>Nome: </label>
                                                <div class="mb-1">
                                                    <input type="text" v-model="editandoCategoria.nome" placeholder="Nome da Categoria" class="form-control" />
                                                </div>
                                                <label>Categoria pai: </label>
                                                <div class="mb-1">
                                                    <select class="select2 form-control" v-model="editandoCategoria.categoria_pai_id">
                                                        <option :value="null" >Nenhuma (Categoria Principal)</option>
                                                        <option :value="categoria.id" v-for="categoria in selectCategoriasPai">{{ categoria.nome }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="updateCategoria">Salvar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="procurar">
                        <p>Buscar <input class="input-table" type="text" v-model="search" placeholder="Buscar categoria"></p>


                    </div>

                </div>
                <hr>
                <div class="card-datatable table-responsive " style="border-radius: 5px;">
                    <table class=" table" style="border-top: 10px;">
                        <thead class="table-light" >
                        <tr class="tabela">
                            <th>Nome</th>
                            <th>Categoria pai</th>
                            <th></th>
                        </tr>

                        </thead>
                        <tbody class="table-primary">
                        <tr class="tabela" v-for="categoria in categorias.data">
                            <td style="color: black;">{{ categoria.nome }}</td>
                            <td style="color: black;">
                                    <span v-if="categoria.categoria_pai_id != null">{{ categoria.categoria_pai.nome }}</span>
                                    <span v-else>Nenhuma</span>
                            </td>
                            <td>
                                <button @click="editarCategoria(categoria)" type="button" class="btn btn-primary btn-table" data-bs-toggle="modal" data-bs-target="#modalEditarCategoria">
                                    Editar
                                </button>
                            </td>
                        </tr>
                        <tr>
                        </tr>

                        </tbody>

                    </table>
                </div>
            </div>
            <!--/ Permission Table -->
            <!-- Add Permission Modal -->

            <!--/ Edit Permission Modal -->

        </div>
    </div>
</template>

<script>
import toast from "bootstrap/js/src/toast";

export default {
    name: "Categorias",
    data(){
        return{
            categorias:{
                data:[]
            },
            newCategoria:{
                nome:null,
                categoria_pai_id:null
            },
            editandoCategoria:{
                nome:null,
                categoria_pai_id:null
            },
            search:'',
            perPage:10
        }
    },
    watch:{
        search(){
            this.getCategorias();
        },
        perPage(){
            this.getCategorias();
        }
    },
    computed:{
        //Retorna somente categorias pai (que não possuem categoria pai)
      selectCategoriasPai(){
          let categorias = this.categorias.data;
          let categoriasPai = [];
          categorias.forEach((categoria)=>{
              if(categoria.categoria_pai_id == null){
                  categoriasPai.push(categoria);
              }
          })
          //Remove a categoria que está sendo editada da lista de categorias pai
          if(this.editandoCategoria.id != null){
              categoriasPai = categoriasPai.filter((categoria)=>{
                  return categoria.id != this.editandoCategoria.id;
              })
          }
          return categoriasPai;
      }
    },
    methods:{
        editarCategoria(categoria){
            this.editandoCategoria = categoria;
        },
        updateCategoria(){
            axios.put('/api/admin/categorias/'+this.editandoCategoria.id,this.editandoCategoria).then((response)=>{
                this.getCategorias();
                this.editandoCategoria = {
                    nome:null,
                    categoria_pai_id:null
                }
                toastr.success('Categoria atualizada com sucesso!')
            }).catch((error)=>{
                //toast de erro
                toastr.error(error.response.data.message)
            })
        },
        getCategorias(){
            let url = '/api/categorias?search='+this.search;
            url += '&perPage='+this.perPage;
            axios.get(url).then((response)=>{
                this.categorias = response.data
            })
        },
        cadastrarCategoria(){
            axios.post('/api/categorias',this.newCategoria).then((response)=>{
                this.getCategorias();
                this.newCategoria = {
                    nome:null,
                    categoria_pai_id:null
                }
            }).catch((error)=>{
                //toast de erro
                toastr.error(error.response.data.message)
            })
        }
    },
    mounted() {
        this.getCategorias();
    }
}
</script>

<style scoped>

</style>
