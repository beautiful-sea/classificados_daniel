<template>
  <div class="col-12  ">
    <h1>Agendar um horário</h1>
    <v-calendar
        v-if="!dataSelecionada"
        is-expanded
        @dayclick="selecionarData"
        :attributes="attributes"
    />
    <div v-if="dataSelecionada && !agendamentoFinalizado">
      <button class="btn btn-danger" @click="resetar"> Voltar </button>
      <h3>Selecione o horário disponível para o dia {{ dataSelecionada.getDate() }}/{{
          dataSelecionada.getMonth() + 1
        }}/{{ dataSelecionada.getFullYear() }}:</h3>
      <select class="form-control" v-model="horaSelecionada">
        <option v-for="horario in horariosDisponiveis" :value="horario">{{ horario }}</option>
      </select>

      <h5>Nome:</h5>
      <input type="text" class="form-control" v-model="cliente.nome">
      <h5>Telefone:</h5>
      <input type="text" class="form-control" v-model="cliente.telefone">
      <button class="mt-2 btn btn-success" @click="agendarHorario">
        Agendar
      </button>
    </div>
    <div v-if="agendamentoFinalizado">
      <h3>Agendamento realizado com sucesso!</h3>
      <h5>Data:  <p>{{ dataSelecionada.getDate() }}/{{ dataSelecionada.getMonth() + 1 }}/{{ dataSelecionada.getFullYear() }}</p></h5>

      <h5>Horário: <p>{{ horaSelecionada }}</p></h5>

      <h5>Cliente:  <p>{{ cliente.nome }}</p></h5>

      <h5>Telefone: <p>{{ cliente.telefone }}</p></h5>

    </div>
  </div>
</template>
<script>
export default {
  props: ['anunciante_id'],
  name: "Agendar",
  data() {
    return {
      attributes: [],
      dataSelecionada: null,
      horaSelecionada: null,
      horariosDisponiveis: [],
      cliente:{
        nome:'',
        telefone:'',
      },
      agendamentoFinalizado:false
    }
  },
  methods: {
    resetar() {
      this.dataSelecionada = null;
      this.horaSelecionada = null;
      this.horariosDisponiveis = [];
      this.cliente.nome = '';
      this.cliente.telefone = '';
      this.agendamentoFinalizado = false;
    },
    agendarHorario() {
      let url = '/anunciantes/' + this.anunciante_id + '/agendamentos';
      let data = {
        data: this.dataSelecionada,
        horario: this.horaSelecionada,
        cliente: this.cliente,
      };
      axios.post(url, data).then(response => {
        console.log(response.data);
        this.agendamentoFinalizado = true;
        toastr.success('Horário agendado com sucesso!');
      }).catch(error => {
        console.log(error);
        toastr.error('Erro ao agendar horário');
      });
    },
    selecionarData({date, events}) {
      let data = new Date(date);
      //Adiciona em horarios disponiveis os horarios disponiveis para a data selecionada em attributes
      this.horariosDisponiveis = [];
      this.attributes.forEach((attribute) => {
        if (attribute.dates.getDate() === data.getDate()) {
          this.horariosDisponiveis.push(attribute.dates.getHours() + ':' + attribute.dates.getMinutes());
        }
      });

      this.dataSelecionada = data;
    },
    getDatasDisponiveis() {
      let url = '/anunciantes/' + this.anunciante_id + '/agendamentos';
      axios.get(url).then(response => {
        let agendamentos = response.data;
        agendamentos.forEach((agendamento) => {
          let status = agendamento.status;
          let status_color = 'red';
          if (status === 'disponivel') {
            status_color = 'green';
          } else if (status === 'agendado') {
            status_color = 'yellow';
          } else if (status === 'cancelado') {
            status_color = 'red';
          } else if (status === 'realizado') {
            status_color = 'blue';
          }
          //Monta a data e horario do agendamento
          let dataHora = agendamento.data + ' ' + agendamento.horario;
          let date = new Date(dataHora);

          this.attributes.push({
            id: agendamento.id,
            highlight: true,
            dates: date,
            horario: agendamento.horario,
          })

        })
      }).catch(error => {
        console.log(error);
      });
    }
  },
  mounted() {
    this.getDatasDisponiveis();
  }

}
</script>

<style scoped>

</style>
