<template>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <h3>Lista de usuários</h3>

            <!-- Permission Table -->
            <div class="card" style="border-radius: 5px">
                <div class="top-table">
                    <div class="exibir">
                        <p>Exibindo</p>
                        <select
                            name="tabela-length"
                            v-model="perPage"
                            class="form-select"
                        >
                            <option
                                value="10"
                                :selected="users.per_page === '10'"
                            >
                                10
                            </option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>

                    <div class="btn_cadastrar">
                        <!-- <button type="button" class="btn btn-primary btn-table">Cadastrar</button> -->
                        <div class="form-modal-ex">
                            <!-- Button trigger modal -->
                            <button
                                type="button"
                                class="btn btn-primary btn-table"
                                data-bs-toggle="modal"
                                data-bs-target="#inlineForm"
                            >
                                Cadastrar
                            </button>
                            <!-- Modal -->
                            <div
                                class="modal fade text-start"
                                id="inlineForm"
                                tabindex="-1"
                                aria-labelledby="myModalLabel33"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4
                                                class="modal-title"
                                                id="myModalLabel33"
                                            >
                                                Cadastrar Usuário
                                            </h4>
                                            <button
                                                style="width: 20px"
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"
                                            ></button>
                                        </div>
                                        <form action="#">
                                            <div class="modal-body">
                                                <label>Nome: </label>
                                                <div class="mb-1">
                                                    <input
                                                        type="text"
                                                        placeholder="Nome do Usuário"
                                                        class="form-control"
                                                    />
                                                </div>

                                                <label>Profissão: </label>
                                                <div class="mb-1">
                                                    <select
                                                        id="state"
                                                        class="select2 form-select"
                                                    >
                                                        <option value="">
                                                            Pedreiro
                                                        </option>
                                                        <option value="rj">
                                                            Mecânico
                                                        </option>
                                                        <option value="sp">
                                                            Diarista
                                                        </option>
                                                    </select>
                                                </div>
                                                <label>Localização: </label>
                                                <div class="mb-1">
                                                    <input
                                                        type="text"
                                                        placeholder="Localização do Usuário"
                                                        class="form-control"
                                                    />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-primary"
                                                    data-bs-dismiss="modal"
                                                >
                                                    Cadastrar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="procurar">
                        <p>
                            Buscar
                            <input
                                class="input-table"
                                type="text"
                                placeholder="Buscar usuário"
                                v-model="search"
                            />
                        </p>
                    </div>
                </div>
                <hr />
                <div
                    class="card-datatable table-responsive"
                    style="border-radius: 5px"
                >
                    <table class="table" style="border-top: 10px">
                        <thead class="table-light">
                            <tr class="tabela">
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Tipo de usuário</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-primary">
                            <tr class="tabela" v-for="user in users.data">
                                <td style="color: black">{{ user.name }}</td>
                                <td style="color: black">{{ user.email }}</td>
                                <td style="color: black">{{ user.role }}</td>
                                <td>
                                    <div
                                        class="btn-group"
                                        role="group"
                                        aria-label="Basic example"
                                    >
                                        <a
                                            type="button"
                                            class="btn btn-primary btn-table"
                                            :href="'/admin/usuarios/' + user.id"
                                        >
                                            Ver
                                        </a>
                                        <button
                                            type="button"
                                            class="btn btn-danger btn-table"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            @click="selectedUser = user"
                                        >
                                            Excluir
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-warning btn-table"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal"
                                            @click="selectedUser = user"
                                        >
                                            Editar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Permission Table -->
            <!-- Add Permission Modal -->

            <!--/ Edit Permission Modal -->

            <!-- Delete Permission Modal -->

            <!-- Delete User Modal -->
            <div
                class="modal fade"
                id="deleteModal"
                tabindex="-1"
                aria-labelledby="deleteModalLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">
                                Excluir Usuário
                            </h5>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <div class="modal-body">
                            Tem certeza de que deseja excluir este usuário?
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal"
                            >
                                Cancelar
                            </button>
                            <button
                                type="button"
                                class="btn btn-danger"
                                @click="deleteUser"
                            >
                                Excluir
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit User Modal -->
            <div
                class="modal fade"
                id="editModal"
                tabindex="-1"
                aria-labelledby="editModalLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">
                                Editar Usuário
                            </h5>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <div class="modal-body">
                            <template v-if="selectedUser">
                                <label>Tipo do usuario: </label>
                                <select
                                    v-model="selectedUser.role"
                                    class="form-select"
                                >
                                    <option value="admin">Admin</option>
                                    <option value="anunciante">
                                        Anunciante
                                    </option>
                                    <!-- Outros papéis -->
                                </select>
                            </template>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal"
                            >
                                Cancelar
                            </button>
                            <button
                                type="button"
                                class="btn btn-primary"
                                @click="editUser"
                            >
                                Salvar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Users",
    data() {
        return {
            users: {
                data: [],
            },
            search: "",
            perPage: 10,
            selectedUser: null,
        };
    },
    watch: {
        search() {
            this.getUsers();
        },
        perPage() {
            this.getUsers();
        },
    },
    methods: {
        getUsers() {
            let url = "/api/users?search=" + this.search;
            url += "&perPage=" + this.perPage;
            axios
                .get(url)
                .then((response) => {
                    this.users = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        deleteUser() {
            axios
                .get("/api/admin/usuarios/" + this.selectedUser.id)
                .then((response) => {
                    this.getUsers();
                    $("#deleteModal").modal("hide");
                    toastr.success("Usuario excluído com sucesso!");
                })
                .catch((error) => {
                    toastr.error("Erro ao excluir usuário!");
                    console.log(error);
                });
        },
        editUser() {
            console.log(this.selectedUser);
            axios
                .post("/api/admin/usuarios/" + this.selectedUser.id +"/role", {
                    role: this.selectedUser.role,
                })
                .then((response) => {
                    this.getUsers();
                    $("#editModal").modal("hide");
                    toastr.success("Papel do usuário atualizado com sucesso!");
                })
                .catch((error) => {
                    toastr.error("Erro ao atualizar papel do usuário!");
                    console.log(error);
                });
        },
    },
    created() {
        this.getUsers();
    },
};
</script>

<style scoped></style>
