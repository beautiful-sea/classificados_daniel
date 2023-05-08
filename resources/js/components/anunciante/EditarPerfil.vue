<template>
    <div id="form">
            <div class="col-lg-12 form-group">
                <label>Nome</label>
                <input class="form-control" v-model="anunciante.name" name="first-name" placeholder="Nome" type="text">
            </div>
            <div class="col-lg-12 form-group">
                <label>Email</label>
                <input class="form-control" v-model="anunciante.email" name="email" placeholder="Email" type="email">
            </div>
            <div class="col-lg-12 form-group">
                <label>Telefone</label>
                <input class="form-control" v-model="anunciante.phone" name="telefone" placeholder="Telefone / contato" type="text">
            </div>
            <div class="col-lg-12 form-group">
                <label>Categoria</label>
                <select class="form-control select2" @change="getCategorias" v-model="anunciante.anunciante.subcategoria_id">
                    <option :value="categoria.id" v-for="categoria in categorias.data">{{categoria.nome}}</option>
                </select>
            </div>
        <hr>
            <div class="col-12">
                <h3>Endereco:</h3>
            </div>
            <div class="col-lg-12 form-group">
                <label>CEP</label>
                <input class="form-control" name="codigo-postal" v-model="anunciante.endereco.cep" placeholder="Código Postal" type="text">
            </div>
            <div class="col-lg-12 form-group">
                <label>Endereço</label>
                <input class="form-control" name="endereco" v-model="anunciante.endereco.logradouro" placeholder="Endereço" type="text">
            </div>
            <div class="col-lg-12 form-group">
                <label>Estado</label>
               <select class="form-control select2" @change="getCidades" v-model="anunciante.endereco.estado_id">
                    <option :value="estado.id" v-for="estado in estados.data">{{estado.sigla}}</option>
               </select>
            </div>
            <div class="col-lg-12 form-group">
                <label>Cidade</label>
                <select :disabled="!this.anunciante.endereco.estado_id" class="form-control select2" v-model="anunciante.endereco.cidade_id">
                    <option :value="cidade.id" v-for="cidade in cidades.data">{{cidade.nome}}</option>
                </select>
            </div>

            <div class="col-lg-12 form-group">
                <input value="Atualizar Perfil" @click="atualizarPerfil()" class="btn btn-success regi-btn btn-md" name="atualizar" type="submit">
            </div>
    </div>
</template>

<script>
export default {
    name: "EditarPerfil",
    props:{
        anunciante: Object
    },
    data(){
        return{
            estados:{
                data:[]
            },
            cidades:{
                data:[]
            },
            categorias:{
                data:[]
            }
        }
    },
    methods:{
        getCidades(){
            let url = '/api/cidades/'+this.anunciante.endereco.estado_id;
            let perPage = 99999;
            url+='?perPage='+perPage;
            axios.get(url).then(response => {
                this.cidades = response.data;
            });
        },
        getEstados(){
            let url = '/api/estados';
            let perPage = 99999;
            url+='?perPage='+perPage;
            axios.get(url).then(response => {
                this.estados = response.data;
            });
        },
        getCategorias(){
            let url = '/api/categorias/';
            let perPage = 99999;
            url+='?perPage='+perPage;
            axios.get(url).then(response => {
                this.categorias = response.data;
            });
        },

        atualizarPerfil(){
            axios.put('/anunciante/'+this.anunciante.id, this.anunciante).then(response => {
                toastr.success('Perfil atualizado com sucesso!');
            });
        }
    },
    created(){
        this.getEstados();
        if(this.anunciante.endereco.estado_id){
            this.getCidades();
        }
        this.getCategorias();
    }
}
</script>

<style scoped>

</style>
