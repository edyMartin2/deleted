<template>
  <v-container-fluid>
    <v-row>
      <v-col cols="2">
        <v-app>
          <!--Dashboard admin y no admin logica dentro de ese componente-->
          <dashboard :user_type="userType" />
        </v-app>
      </v-col>
      <v-col cols="10">
        <v-cotainer>
          <h1 class="_h1_main">Usuarios</h1>
          <v-row>
            <v-col
              v-for="(i, ke) in users"
              :key="i.id"
              cols="3"
              class="my-3 px-3"
            >
              <v-card class="mx-auto" max-width="100%">
                <v-card-text>
                  <h3>{{ i.email }}</h3>
                  <p>{{ i.name }}</p>
                </v-card-text>
                <v-card-actions>
                  <v-btn
                    depressed
                    color="primary"
                    @click="activeThisDialog(i.id, i.pass)"
                  >
                    Opciones
                  </v-btn>
                  <v-btn depressed color="primary" @click="deleteUser(ke)">
                    Eliminar
                  </v-btn>

                  <v-dialog
                    v-model="dialog"
                    max-width="500"
                    max-height="500"
                    height="500"
                  >
                    <v-card>
                      <v-toolbar flat color="primary" dark>
                        <v-toolbar-title>Perfil del usuario</v-toolbar-title>
                      </v-toolbar>
                      <v-tabs vertical>
                        <v-tab>
                          <v-icon left>
                            mdi-account
                          </v-icon>
                          Permisos
                        </v-tab>
                        <v-tab>
                          <v-icon left>
                            mdi-lock
                          </v-icon>
                          Contraseña
                        </v-tab>

                        <v-tab-item>
                          <v-card>
                            <v-card-title>
                              Agrega permisos a este usuario
                            </v-card-title>

                            <v-container>
                              <v-row>
                                <v-col cols="12">
                                  <v-select
                                    :items="corps"
                                    v-model="corpAsig"
                                    name="corporativo"
                                    v-validate="'required'"
                                    item-text="name"
                                    item-value="id"
                                    label="Asignale un corporativo"
                                    outlined
                                    @change="getparques"
                                  />
                                </v-col>
                              </v-row>
                              <v-row v-if="corpAsig != ''">
                                <v-col cols="12">
                                  <v-select
                                    :items="parques"
                                    v-model="parqueasig"
                                    name="parque"
                                    v-validate="'required'"
                                    item-text="nombre_es"
                                    item-value="id"
                                    label="Asignale un parque"
                                    outlined
                                  />
                                </v-col>
                              </v-row>
                              <v-row v-if="parqueasig != ''">
                                <v-col cols="12">
                                  <v-select
                                    v-model="value"
                                    :items="items"
                                    chips
                                    label="Permisos del usuario"
                                    multiple
                                    outlined
                                  ></v-select>
                                </v-col>
                              </v-row>
                            </v-container>

                            <v-card-actions>
                              <v-spacer></v-spacer>

                              <v-btn color="error" text @click="dialog = false">
                                Cancelar
                              </v-btn>

                              <v-btn
                                color="green darken-1"
                                text
                                @click="add(i.id)"
                              >
                                Agregar
                              </v-btn>
                              <br />
                            </v-card-actions>
                          </v-card>
                        </v-tab-item>
                        <v-tab-item>
                          <v-card>
                            <v-card-title>
                              Mirar la contraseña del usuario
                            </v-card-title>

                            <v-container>
                              <v-row>
                                <v-col cols="12">
                                  <v-text-field
                                    v-model="password"
                                    :append-icon="
                                      show1 ? 'mdi-eye' : 'mdi-eye-off'
                                    "
                                    :type="show1 ? 'text' : 'password'"
                                    outlined
                                    counter
                                    @click:append="show1 = !show1"
                                  ></v-text-field>
                                </v-col>
                              </v-row>
                            </v-container>

                            <v-card-actions>
                              <v-spacer></v-spacer>

                              <v-btn color="error" text @click="dialog = false">
                                Cancelar
                              </v-btn>
                              <br />
                            </v-card-actions>
                          </v-card>
                        </v-tab-item>
                      </v-tabs>
                    </v-card>
                  </v-dialog>
                </v-card-actions>
              </v-card>
            </v-col>
          </v-row>
        </v-cotainer>
      </v-col>
    </v-row>
  </v-container-fluid>
</template>

<script>
import VueCookies from "vue-cookies";
var CryptoJS = require("crypto-js");
import dashboard from "../components/sideBar";
import axios from "axios";
import Swal from "sweetalert2";

export default {
  name: "usuarios",
  data() {
    return {
      userType: null,
      users: null,
      dialog: false,
      items: ["Edicion", "Creacion", "Borrar"],
      value: ["solo lectura"],
      corps: [],
      corpAsig: "",
      parques: null,
      parqueasig: "",
      roles: [],
      rolasign: "",
      userIds: 0,
      show1: false,
      password: "",
    };
  },
  beforeMount() {
    axios
      .post(`${this.$store.state.url}/getallcorps`)
      .then((res) => {
        this.corps = res.data;
      })
      .catch((e) => console.log(e));
    axios
      .post(`${this.$store.state.url}/getrole`)
      .then((res) => {
        console.log(res.data);
        this.roles = res.data;
      })
      .catch((e) => console.log(e));
    var type = CryptoJS.AES.decrypt(VueCookies.get("user_type"), "ampip");
    this.userType = type.toString(CryptoJS.enc.Utf8);
    axios
      .post(`${this.$store.state.url}/getallusercorp`)
      .then((res) => (this.users = res.data))
      .catch((e) => console.log(e));
  },
  components: {
    dashboard,
  },
  methods: {
    getData(id) {
      let params = new URLSearchParams();
      params.append("id", id);
      axios
        .post(`${this.$store.state.url}/getparquesusuarios`, params)
        .then((res) => this.value.push(res.data[0].permiso))
        .catch((e) => console.log(e));
    },
    add() {
      if (this.parqueasig != "" && this.corpAsig != "") {
        var key = VueCookies.get("id");
        var decripts = CryptoJS.AES.decrypt(key, "ampip");
        var id = decripts.toString(CryptoJS.enc.Utf8);
        var params = new URLSearchParams();
        params.append("id", this.userIds);
        params.append("parqueasig", this.parqueasig);
        params.append("corpAsig", this.corpAsig);
        params.append("rolasign", this.rolasign);
        params.append("id_key", id);
        var ctx = this;
        for (var i = 0; i < ctx.value.length; i++) {
          let params = new URLSearchParams();
          params.append("idUser", this.userIds);
          params.append("idParque", ctx.parqueasig);
          params.append("permiso", ctx.value[i]);
          axios
            .post(`${this.$store.state.url}/setpermisos`, params)
            .then((res) => {
              if (res.data != null) {
                ctx.$router.push("/dasshboard");
              }
            })
            .catch((e) => console.log(e));
        }
      } else {
        alert("Favor de llenar los datos");
      }
    },
    getparques() {
      var param = new URLSearchParams();
      param.append("id", this.corpAsig);
      axios
        .post(`${this.$store.state.url}/getallpark`, param)
        .then((res) => {
          console.log(res.data);
          this.parques = res.data;
        })
        .catch((e) => console.log(e));
    },
    activeThisDialog(ids, pass) {
      this.userIds = ids;
      this.dialog = true;
      this.password = pass;
    },
    deleteUser(i) {
      var name = this.users[i].name;
      console.log(name);
      var email = this.users[i].email;
      var pass = this.users[i].pass;
      var id = this.users[i].id;
      var status = 0;

      var data = new URLSearchParams();
      data.append("name", name);
      data.append("email", email);
      data.append("pass", pass);
      data.append("status", status);
      data.append("id", id);
      axios
        .post(`${this.$store.state.url}/updateuser`, data)
        .then(res =>
          console.log(
            Swal.fire({
              icon: "success",
              title: "",
              text: res.data.message,
              backdrop: `
                  rgba(0,0,0,0.1)
                  url("/images/nyan-cat.gif")
                  left top
                  no-repeat
                `,
            })
          )
        )
        .catch((e) => console.log(e));
    },
  },
};
</script>

<style scoped></style>
