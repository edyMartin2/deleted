<template>
  <v-container>
    <v-row justify="center" align="center" class="all">
      <v-col cols="10" md="5">
        <v-card>
          <v-img
            class="_img_ampip _login"
            lazy-src="http://18.207.162.106/img/logo_ampip.svg"
            max-height="150"
            max-width="250"
            src="http://18.207.162.106/img/logo_ampip.svg"
          ></v-img>
          <v-container v-if="user == false">
            <v-row>
              <v-col cols="12">
                <v-text-field
                  v-model="email"
                  label="Correo"
                  id="id"
                  outlined
                ></v-text-field>
              </v-col>

              <v-col cols="12">
                <v-text-field
                  v-model="pass"
                  label="Contraseña"
                  id="id"
                  outlined
                  type="password"
                ></v-text-field>
              </v-col>
            </v-row>
            <v-col cols="12">
              <v-btn color="success" @click="login">Iniciar secion</v-btn>
              <br />
              <!-- <a @click="forgetPass">Olvide mi contraseña</a> <small>°</small> -->
            </v-col>
          </v-container>
          <v-container v-if="user == true">
            <v-row>
              <v-col cols="6">
                <v-text-field
                  v-model="name"
                  label="Nombre"
                  outlined
                  type="text"
                  :rules="[rules.required, rules.counterThre]"
                ></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-text-field
                  v-model="lastName"
                  label="Apellido"
                  outlined
                  type="text"
                  :rules="[rules.required, rules.counterThre]"
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="email"
                  label="Correo"
                  outlined
                  type="email"
                  :rules="[rules.required, rules.email]"
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="pass"
                  label="Contraseña"
                  outlined
                  type="password"
                  :rules="[rules.required, rules.counterThre]"
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field
                  label="Telefono"
                  v-model="tel"
                  outlined
                  type="number"
                  :rules="[rules.required, rules.phone]"
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field
                  label="Celular"
                  v-model="cel"
                  outlined
                  type="number"
                  :rules="[rules.required, rules.phone]"
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="12">
                <v-menu
                  ref="menu"
                  v-model="menu"
                  :close-on-content-click="false"
                  :return-value.sync="date"
                  transition="scale-transition"
                  offset-y
                  min-width="auto"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="date"
                      label="Fecha de nacimiento"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                      outlined
                      :rules="[rules.required]"
                    ></v-text-field>
                  </template>
                  <v-date-picker v-model="date" no-title scrollable>
                    <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="menu = false">
                      Cancel
                    </v-btn>
                    <v-btn text color="primary" @click="$refs.menu.save(date)">
                      OK
                    </v-btn>
                  </v-date-picker>
                </v-menu>
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field
                  label="Codigo postal"
                  v-model="addr.cp"
                  outlined
                  type="number"
                  :rules="[rules.required, rules.cp]"
                  @keyup="watchCp"
                ></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-select
                  :items="addr.cpResult"
                  label="Colonia"
                  placeholder="Colonia"
                  outlined
                  v-model="addr.col"
                  :rules="[rules.required]"
                  item-text="response.asentamiento"
                  item-value="response.asentamiento"
                ></v-select>
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field
                  label="Estado"
                  v-model="edo"
                  outlined
                  :rules="[rules.required]"
                  disabled
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field
                  label="Municipio"
                  v-model="mun"
                  outlined
                  disabled
                  :rules="[rules.required]"
                ></v-text-field>
              </v-col>
              <v-card-actions>
                <v-col cols="12" md="6">
                  <v-switch
                    v-model="ex11"
                    label="Compartir datos"
                    color="red"
                    value="0"
                    hide-details
                  ></v-switch>
                </v-col>
                <v-col cols="12">
                  <v-btn
                    depressed
                    color="error"
                    @click="upUser"
                    v-show="showButton"
                  >
                    Crear
                  </v-btn>
                </v-col>
              </v-card-actions>
            </v-row>
          </v-container>

          <v-card-actions>
            <v-btn @click="createUser" text  color="red lighten-2" v-if="steep != 1"
              >Hacerme socio</v-btn
            >
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
import VueCookies from "vue-cookies";

var CryptoJS = require("crypto-js");

export default {
  data() {
    return {
      name: "",
      email: "",
      pass: "",
      session: "",
      user: "",
      loginIs: "",
      typeOfUser: 2,
      role: [],
      date: "",
      tel: "",
      cel: "",
      addr: {
        cp: "",
        cpResult: [],
        col: "",
        edo: "",
        mun: "",
      },
      menu: false,
      lastName: "",
      ex11: 0,
      rules: {
        required: (value) => !!value || "Required.",
        counter: (value) => value.length >= 8 || "Minimo 8 characters",
        email: (value) => {
          const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return pattern.test(value) || "Invalid e-mail.";
        },
        counterThre: (value) => value.length >= 3 || "Minimo 3 caracteres",
        phone: (value) => value.length <= 10 || "maximo 10 numeros",
        cp: (value) => value.length <= 5 || "maximo 5 numeros",
      },
      steep:0
    };
  },
  methods: {
    login() {
      var cnx = this;
      if (this.email != "" && this.pass != "") {
        var params = new URLSearchParams();
        params.append("email", this.email);
        params.append("pass", this.pass);
        axios

          .post(`${this.$store.state.url}/login`, params)
          .then(function(res) {
            if (res.data[0].id == undefined) {
              Swal.fire({
                icon: "error",
                title: "Ooops ...",
                text: "No pudimos iniciar secion revisa tus credenciales",
                backdrop: `
                  rgba(255,0,0,0.1)
                  url("/images/nyan-cat.gif")
                  left top
                  no-repeat
                `,
              });
            } else {
              console.log(res.data[0]);

              VueCookies.set(
                "id",
                CryptoJS.AES.encrypt(res.data[0].id, "ampip").toString()
              );
              VueCookies.set(
                "email",
                CryptoJS.AES.encrypt(res.data[0].email, "ampip").toString()
              );
              VueCookies.set(
                "name",
                CryptoJS.AES.encrypt(res.data[0].name, "ampip").toString()
              );
              console.log(res.data[0]);
              cnx.$router.push("/dasshboard");
            }
          })
          .catch();
      }
    },
    createUser() {
      this.user = !this.user;
      this.steep = 1;
    },
    upUser() {
      if (this.user != "" && this.email != "" && this.pass != "") {
        var params = new URLSearchParams();
        params.append("fullname", this.name + " " + this.lastName);
        params.append("email", this.email);
        params.append("pass", this.pass);
        params.append("useForAmpi", 0);
        params.append("typeOfUser", 0);

        axios
          .post(`${this.$store.state.url}/createuser`, params)
          .then((res) => {
            console.log(res.data.message);
            if (res.data.message == 1) {
              axios
                .post(`${this.$store.state.url}/getuseridlogin`, params)
                .then((resDos) => {
                  console.log(resDos.data);
                  if (resDos.data[0].id) {
                    this.upData(resDos.data[0].id);
                  } else {
                    Swal.fire({
                      icon: "error",
                      title: "Ooops ...",
                      text: resDos.data[0].error,
                      backdrop: `
                        rgba(255,0,0,0.1)
                        url("/images/nyan-cat.gif")
                        left top
                        no-repeat
                        `,
                    });
                  }
                })
                .catch((e) => {
                  Swal.fire({
                    icon: "error",
                    title: "Ooops ...",
                    text: e,
                    backdrop: `
                  rgba(255,0,0,0.1)
                  url("/images/nyan-cat.gif")
                  left top
                  no-repeat
                `,
                  });
                });
            } else {
              Swal.fire({
                icon: "error",
                title: "Ooops ...",
                text: res.data.message,
                backdrop: `
                  rgba(255,0,0,0.1)
                  url("/images/nyan-cat.gif")
                  left top
                  no-repeat
                `,
              });
            }
          })
          .catch((e) =>
            Swal.fire({
              icon: "error",
              title: "Ooops ...",
              text: e,
              backdrop: `
                  rgba(255,0,0,0.1)
                  url("/images/nyan-cat.gif")
                  left top
                  no-repeat
                `,
            })
          );
      } else {
        alert("Favor de llenar todos los campos");
      }
    },
    upData(id) {
      var params = new URLSearchParams();
      params.append("id", id);
      params.append("telefonoOfficina", this.tel);
      params.append("celular", this.cel);
      params.append("direccionDeOfficina", this.addr);
      params.append("cumpleanios", this.date);
      params.append("compartirDatos", this.ex11);

      axios
        .post(`${this.$store.state.url}/createdatauser`, params)
        .then((res) => {
          if (res.data.message == "creado") {
            Swal.fire({
              icon: "success",
              title: "Gracias",
              text: res.data.message,
              backdrop: `
                  rgba(0,255,0,0.1)
                  url("/images/nyan-cat.gif")
                  left top
                  no-repeat
                `,
            });
            this.$router.push("/dasshboard");
          } else {
            Swal.fire({
              icon: "error",
              title: "Opps",
              text: res.data.message,
              backdrop: `
                  rgba(0,255,0,0.1)
                  url("/images/nyan-cat.gif")
                  left top
                  no-repeat
                `,
            });
          }
        })
        .catch((e) => console.log(e));
    },
    forgetPass() {
     

      Swal.fire({
        title: "Ingresa tu correo electronico",
        input: "email",
        inputAttributes: {
          autocapitalize: "off",
        },
        showCancelButton: false,
        confirmButtonText: "Confirmar",
        showLoaderOnConfirm: true,
        preConfirm: (login) => {
          axios
            .get(`${login}`)
            .then((res) => console.log(res))
            .catch((e) => console.log(e));
        },
        allowOutsideClick: () => !Swal.isLoading(),
      }).then(() => {
        console.log("process");
      });
    },
    watchCp() {
      axios
        .get(
          `https://api-sepomex.hckdrk.mx/query/info_cp/${this.addr.cp}?token=${this.$store.state.token}`
        )
        .then((res) => {
          this.addr.cpResult = res.data;
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },
  beforeMount() {
    axios
      .post(`${this.$store.state.url}/getrole`)
      .then((res) => (this.role = res.data))
      .catch((e) => console.log(e));
    var cookie = VueCookies.get("id");
    if (cookie) {
      if (cookie != "") {
        this.$router.push("/dasshboard");
      }
    }
  },
  computed: {
    showButton() {
      if (
        this.name != "" &&
        this.lastName != "" &&
        this.email != "" &&
        this.tel != "" &&
        this.cel != "" &&
        this.date != "" &&
        this.addr.cp != "" &&
        this.pass != ""
      ) {
        return true;
      } else {
        return false;
      }
    },
    edo() {
      if (this.addr.cpResult.length > 0) {
        return this.addr.cpResult[0].response.estado;
      } else {
        return "Sin datos";
      }
    },
    mun() {
      if (this.addr.cpResult.length > 0) {
        return this.addr.cpResult[0].response.municipio;
      } else {
        return "Sin datos";
      }
    },
  },
};
</script>

<style scoped>
.all {
  height: 90vh;
}

a {
  margin-top: 1em;
  text-decoration: none;
}
</style>
