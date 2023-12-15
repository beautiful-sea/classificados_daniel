<template>
    <div>
        <loader v-if="loading"></loader>
        <div class="d-flex justify-content-between">
            <button
                v-if="!editandoAgenda"
                class="btn btn-info btn-sm"
                @click="editandoAgenda = !editandoAgenda"
            >
                Adicionar datas disponíveis
            </button>
            <div v-else>
                <button
                    class="btn btn-danger btn-sm"
                    @click="editandoAgenda = !editandoAgenda"
                >
                    Cancelar
                </button>
                <button class="btn btn-success btn-sm" @click="salvarDatas()">
                    Salvar
                </button>
            </div>
        </div>
        <div class="row">
            <v-calendar
                style="width: 100%"
                v-if="!editandoAgenda"
                :attributes="attributes"
                is-expanded
                @dayclick="visualizarData"
                @update:from-page="updatePages"
            />

            <v-calendar
                v-if="editandoAgenda"
                :min-date="new Date()"
                :attributes="attributes"
                @dayclick="adicionarData"
                is-expanded
            />
            <div v-if="editandoAgenda">
                <h3>Selecione os horários disponíveis</h3>
                <select class="form-control" multiple v-model="horarios">
                    <option
                        v-for="horario in horariosPossiveis"
                        :value="horario"
                    >
                        {{ horario }}
                    </option>
                </select>
            </div>

            <div class="mt-3" v-if="!editandoAgenda && diaSelecionado">
                <h3>
                    [{{
                        diaSelecionado.date.getDate() +
                        "/" +
                        (diaSelecionado.date.getMonth() + 1) +
                        "/" +
                        diaSelecionado.date.getFullYear()
                    }}] Horários disponíveis
                    <button
                        @click="adicionarHorario()"
                        class="btn btn-rounded btn-sm btn-info"
                    >
                        <i class="fa fa-plus-circle"></i>
                    </button>
                </h3>
                <div
                    v-for="(hds, index) in horariosDiaSelecionado"
                    class="d-flex"
                    style="flex-direction: column; width: 100%"
                >
                    <template v-if="hds.highlight === 'yellow'">
                        <div class="has-tooltip">
                            <p>
                                Você tem um agendamento nesse horário <br />
                                clique no botão ao lado do horario para ver as
                                informações
                            </p>
                        </div>
                    </template>
                    <div style="display: flex; gap: 5px">
                        <input
                            :disabled="hds.highlight !== 'green'"
                            type="time"
                            class="form-control"
                            v-model="horariosDiaSelecionado[index].horario"
                        />
                        <button
                            class="btn btn-danger"
                            v-if="hds.highlight === 'green'"
                            @click="removerHorario(hds.horario)"
                        >
                            <i class="fas fa-trash"></i>
                        </button>

                        <button
                            class="btn btn-info"
                            v-if="hds.highlight !== 'green'"
                            @click="verAgendamento(hds)"
                        >
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>
                <button
                    class="btn btn-success"
                    @click="salvarHorariosDoDiaSelecionado"
                >
                    Salvar
                </button>
            </div>

            <div
                v-if="!editandoAgenda && !diaSelecionado"
                style="width: 100%; height: 10px"
            >
                Selecione uma data para visualizar os horários disponíveis
            </div>
        </div>

        <!--    <h1>{{ attributes }}</h1>-->
    </div>
</template>

<script>
export default {
    data: () => ({
        loading: false,
        editandoAgenda: false,
        diaSelecionado: null,
        horariosDiaSelecionado: [],
        dias: [],
        attributes: [],
        horarios: [],
        horariosPossiveis: [
            "00:00",
            "01:00",
            "02:00",
            "03:00",
            "04:00",
            "05:00",
            "06:00",
            "07:00",
            "08:00",
            "09:00",
            "10:00",
            "11:00",
            "12:00",
            "13:00",
            "14:00",
            "15:00",
            "16:00",
            "17:00",
            "18:00",
            "19:00",
            "20:00",
            "21:00",
            "22:00",
            "23:00",
        ],
    }),

    methods: {
        finalizarAgendamento(id) {
            let url = "/anunciantes/agendamentos/finalizar/" + id;
            axios
                .post(url)
                .then((response) => {
                    swal.fire({
                        title: "Agendamento finalizado com sucesso!",
                        icon: "success",
                        showCloseButton: true,
                        showCancelButton: false,
                        focusConfirm: false,
                        confirmButtonText: "Ok",
                        confirmButtonColor: "#28a745",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        cancelarAgendamento(id) {
            let url = "/anunciantes/agendamentos/cancelar/" + id;
            axios
                .post(url)
                .then((response) => {
                    swal.fire({
                        title: "Agendamento deletado com sucesso!",
                        icon: "success",
                        showCloseButton: true,
                        showCancelButton: false,
                        focusConfirm: false,
                        confirmButtonText: "Ok",
                        confirmButtonColor: "#28a745",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        verAgendamento(agendamento) {
            console.log(agendamento);
            let url = "/anunciantes/agendamentos/" + agendamento.id;
            axios
                .get(url)
                .then((response) => {
                    let htmlText =
                        "" +
                        '<div class="row">' +
                        '<div class="col-12">' +
                        "<h3>" +
                        response.data.data_hora +
                        "</h3>" +
                        "</div>" +
                        '<div class="col-12 mt-2">' +
                        "<h3>Cliente:</h3>" +
                        "<p>" +
                        response.data.nome +
                        "</p>" +
                        "<p>" +
                        response.data.telefone +
                        "</p>" +
                        "</div>" +
                        //Status
                        '<div class="col-12 mt-2">' +
                        "<h3>Status:</h3>" +
                        '<p class="' +
                        response.data.status_label_bootstrap +
                        '">' +
                        response.data.status_label +
                        "</p>" +
                        "</div>" +
                        "</div>";

                    let swalData = {
                        title: "Agendamentos",
                        html: htmlText,
                        showCloseButton: false,
                        showCancelButton: false,
                        focusConfirm: false,
                        //Botão de cancelar agendamento
                        showDenyButton: true,
                        denyButtonText: "Deletar agendamento",
                        denyButtonColor: "#d33",
                    };
                    //Somente exibir botao de finalizar se o status for agendado
                    if (response.data.status === "agendado") {
                        swalData.showConfirmButton = true;
                        swalData.confirmButtonText = "Finalizar agendamento";
                        swalData.confirmButtonColor = "#28a745";
                    } else {
                        swalData.showConfirmButton = false;
                    }

                    swal.fire(swalData).then((result) => {
                        if (result.isConfirmed) {
                            this.finalizarAgendamento(response.data.id);
                        } else if (result.isDenied) {
                            this.cancelarAgendamento(response.data.id);
                        }
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        salvarHorariosDoDiaSelecionado() {
            let url = "/anunciantes/agendamentos/salvarHorarios";
            let horariosDiaSelecionadoFormatado =
                this.horariosDiaSelecionado.map((data) => {
                    return data.horario ?? data;
                });
            let data = {
                horarios: horariosDiaSelecionadoFormatado,
                data: this.diaSelecionado.date,
            };
            this.loading = true;
            axios
                .post(url, data)
                .then((response) => {
                    //Atualiza os horarios da data selecionada em attributes
                    this.getAgendamentos();
                    this.loading = false;
                    toastr.success("Horários salvos com sucesso");
                    this.diaSelecionado = null;
                    this.horariosDiaSelecionado = [];
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        adicionarHorario() {
            let horario = {
                horario: "00:00:00",
                status: "disponivel",
                highlight: "green",
            };
            this.horariosDiaSelecionado.push(horario);
        },
        removerHorario(horario) {
            //busca em horariosDiaSelecionado o valor do horario selecionado
            let horarioSelecionado = this.horariosDiaSelecionado.find(
                (data) => {
                    return data.horario === horario;
                }
            );
            //busca o index do horario selecionado
            let index = this.horariosDiaSelecionado.indexOf(horarioSelecionado);
            //remove o horario selecionado
            this.horariosDiaSelecionado.splice(index, 1);
        },
        visualizarData(day) {
            //Busca todos os attributes que possuem a data selecionada
            let attributes = this.attributes.filter((data) => {
                let dataAttributo = new Date(data.dates);
                //formato de data YYYY-MM-DD
                dataAttributo =
                    dataAttributo.getFullYear() +
                    "-" +
                    (dataAttributo.getMonth() + 1) +
                    "-" +
                    dataAttributo.getDate();
                let dataDay = new Date(day.date);
                dataDay =
                    dataDay.getFullYear() +
                    "-" +
                    (dataDay.getMonth() + 1) +
                    "-" +
                    dataDay.getDate();
                return dataAttributo === dataDay;
            });

            if (!attributes.length) {
                this.diaSelecionado = null;
                this.horariosDiaSelecionado = [];
                return;
            }
            this.diaSelecionado = {
                date: day.date,
                attributes: attributes,
            };
            //Adiciona em horariosDiaSelecionado todos os horarios dos attributes
            this.horariosDiaSelecionado = attributes.map((data) => {
                return data;
            });

            //ADiciona a cor de fundo no dia selecionado
            // this.attributes.forEach((data) => {
            //   if (data.dates.getDate() === day.date.getDate()) {
            //     data.highlight = 'green';
            //   }else{
            //     data.highlight = true;
            //   }
            // });
        },
        salvarDatas() {
            let url = "/anunciantes/agendamentos/salvarDatas";
            //Salva em datas somente as datas sem ID
            let datas = this.attributes
                .filter((data) => {
                    return data.id === undefined;
                })
                .map((data) => {
                    return data.dates;
                });
            this.loading = true;
            axios
                .post(url, { datas: datas, horarios: this.horarios })
                .then((response) => {
                    this.loading = false;
                    toastr.success("Datas salvas com sucesso");
                    this.getAgendamentos();
                    this.editandoAgenda = false;
                })
                .catch((error) => {
                    console.log(error);
                    this.loading = false;
                });
        },
        adicionarData(day) {
            //verifica se a data é menor que a data atual
            if (day.date < new Date()) {
                return;
            }
            //busca a data no array de attributes
            let data = this.attributes.find((data) => {
                return data.dates.getDate() === day.date.getDate();
            });
            //se a data não existir no array, adiciona
            if (data === undefined) {
                this.attributes.push({
                    highlight: true,
                    dates: day.date,
                });
            } else {
                //se a data existir no array, remove
                let index = this.attributes.indexOf(data);
                this.attributes.splice(index, 1);
            }
        },
        getAgendamentos(month = 0, year = 0) {
            let mes = month || new Date().getMonth() + 1;
            let ano = year || new Date().getFullYear();
            let url = "/anunciantes/agendamentos?mes=" + mes + "&ano=" + ano;
            this.loading = true;
            this.attributes = [];
            axios
                .get(url)
                .then((response) => {
                    let agendamentos = response.data;
                    agendamentos.forEach((agendamento) => {
                        let status = agendamento.status;
                        let status_color = "red";
                        if (status === "disponivel") {
                            status_color = "green";
                        } else if (status === "agendado") {
                            status_color = "yellow";
                        } else if (status === "cancelado") {
                            status_color = "red";
                        } else if (status === "realizado") {
                            status_color = "blue";
                        }
                        //Monta a data e horario do agendamento
                        let dataHora =
                            agendamento.data + " " + agendamento.horario;
                        let date = new Date(dataHora);

                        this.attributes.push({
                            id: agendamento.id,
                            highlight: status_color,
                            dates: date,
                            horario: agendamento.horario,
                        });
                    });
                    this.loading = false;
                })
                .catch((error) => {
                    console.log(error);
                    this.loading = false;
                });
        },
        updatePages({ month, year }) {
            this.getAgendamentos(month, year);
        },
    },
    created() {
        this.getAgendamentos();
    },
};
</script>

<style scoped></style>
