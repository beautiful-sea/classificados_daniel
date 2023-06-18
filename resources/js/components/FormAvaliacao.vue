<template>
    <div class="contact-area container">
        <div class="col-12">
            <div class="get-in-touch">
                <div class="sec-title">
                    <h1>Avaliação</h1>
                    <p>Sua opinião é extremamente valiosa para nós, pois nos ajuda a melhorar continuamente a
                        qualidade dos profissionais em nossa plataforma. Pedimos que gentilmente preencha uma rápida avaliação sobre sua experiência
                        com o profissional contratado.</p>
                </div>
<!--                Dados do anunciante-->
                <div class="row">
                    <div class="col-12">
                        <h3>Profissional</h3>
                        <div class="d-flex">
                            <img :src="anunciante_avaliado.photo_path" style="width: 50px;" alt="avatar" class="img-fluid  rounded">
                            <div class="ml-2">
                                <p><b>{{ anunciante_avaliado.name }}</b></p>
                                <span>{{ anunciante_avaliado.anunciante.titulo }}</span>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="contact-form mt-3">

                        <div class="row">
                            <div class="col-12">
                                <h3>E-mail</h3>
                                <input class="form-control" v-model="email" type="email" name="email" required>
                            </div>
                            <div class="col-12">
                                <h3>Nome</h3>
                                <input class="form-control" v-model="nome" type="text" name="nome"   required>
                            </div>
                            <div class="col-12 mb-2">
                                <h3 class="form-label ">Whatsapp</h3>
                                <input class="form-control" v-model="whatsapp" v-whatsapp type="text" name="whatsapp"   required>
                            </div>
                            <div class="col-md-12" v-for="campo in campoAvaliacoes">
                                <h3>{{ campo.nome }}</h3>
                                <div class="stars">
                                     <i @click="setStar(campo,index)" v-for="(star,index) in getStarsClass(campo.nota)" :class="star" ></i>
                                </div>
                            </div>
                            <div class="col-12">
                                <h3>Comentário</h3>
                                <textarea class="form-control" v-model="comentario" name="comentario" rows="5" ></textarea>
                            </div>
                            <div class="col-md-12 mt-5">
                                <button :disabled="loading" type="submit" @click="enviarAvaliacao()" class="btn-send" > Enviar avaliação</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "FormAvaliacao.vue",
    props:['anunciante_avaliado'],
    data() {
        return {
            campoAvaliacoes:{},
            starFull: 'fas fa-star',
            starEmpty: 'far fa-star',
            nome : '',
            email : '',
            whatsapp : '',
            comentario : '',
            loading: false
        }
    },
    methods:{
        setStar(campo,index){
            campo.nota = index + 1;
        },
        getStarsClass(nota){
            let stars = [];
            for(let i = 1; i <= 5; i++){
                if(i <= nota){
                    stars.push(this.starFull);
                }else{
                    stars.push(this.starEmpty);
                }
            }
            return stars;
        },
        validarAvaliacao(){
            if(this.email == ''){
                toastr.error('Preencha o campo email');
                return false;
            }

            if(this.nome == ''){
                toastr.error('Preencha o campo nome');
                return false;
            }

            if(this.whatsapp == ''){
                toastr.error('Preencha o campo whatsapp');
                return false;
            }
            //Se algum campoAvaliacao não tiver nota ou a nota for 0, mostrar um alerta
            for(let i = 0; i < this.campoAvaliacoes.length; i++){
                if(this.campoAvaliacoes[i].nota == 0){
                    toastr.error( "O campo " + this.campoAvaliacoes[i].nome + " não foi avaliado!");
                    return false;
                }
            }
            return true;
        },
        enviarAvaliacao(){
            if(!this.validarAvaliacao()){
                return;
            }
            let avaliacao = {
                nome: this.nome,
                email: this.email,
                whatsapp: this.whatsapp,
                campoAvaliacoes: this.campoAvaliacoes,
                anunciante_id : this.anunciante_avaliado.anunciante.id,
                comentario: this.comentario
            };
            this.loading = true;
            axios.post('/api/avaliacao', avaliacao)
                .then(response => {
                    toastr.success('Avaliação enviada com sucesso!');
                    window.location.href = '/';
                    this.loading = false;
                })
                .catch(error => {
                    this.loading = false;
                    //Pra cada erro de validacao do laravel mostrar um toastr
                    if(error.response.status == 422){
                        let errors = error.response.data.errors;
                        for(let key in errors){
                            toastr.error(errors[key][0]);
                        }
                    }else{
                        toastr.error('Ocorreu um erro ao enviar a avaliação!');
                    }
                })
        },
        getCampoAvaliacoes(){
            axios.get('/api/campoAvaliacoes')
                .then(response => {
                    let data = response.data;
                    //adiciona o atributo nota para cada campoAvaliacao
                    data.forEach(function (campoAvaliacao) {
                        campoAvaliacao.nota = 0;
                    });
                    this.campoAvaliacoes = response.data
                })
                .catch(error => {
                    console.log(error)
                })
        }
    },
    // Diretiva para formatar o whatsapp
    directives: {
        whatsapp: {
            bind(el) {
                el.oninput = function(e) {
                    if (!e.isTrusted) {
                        return;
                    }
                    let x = this.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
                    this.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
                    el.dispatchEvent(new Event('input'));
                }
            }
        }
    },
    mounted() {
        this.getCampoAvaliacoes()
    }
}
</script>

<style scoped>
.btn-send {
    font-size: 15px;
    color: #fff;
    background: #21c87a;
    display: block;
    width: 100%;
    height: 48px;
    font-weight: 600;
    border: none;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    -ms-border-radius: 30px;
    border-radius: 30px;
    margin-top: 10px;
    position: relative;
    z-index: 1;
    overflow: hidden;
}
.stars {
    width: 270px;
    display: inline-block;
}

 .stars i {
     padding: 10px;
     font-size: 18px;
     color: #444;
     transition: all .4s;
     cursor: pointer;
}

  .stars i.fas.fa-star {
      color: #f8ce0b;
  }
  .stars i.far.fa-star:hover {
      color: #f8ce0b;
  }


</style>
