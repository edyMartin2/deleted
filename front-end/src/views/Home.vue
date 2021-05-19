<template>
  <v-container>
    <v-row justify="center" align="center" class="all">
      <v-col cols="10" md="5">
        <v-card>
          <br />
          <h1>AMPIP</h1>
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
              <a href="">Olvide mi contraseña</a> <small>°</small>
              <a @click="createUser">Hacerme socio</a>
            </v-col>
          </v-container>
          <v-container v-if="user == true">
            <v-row>
              <v-col cols="12">
                <v-text-field
                  v-model="name"
                  label="Nombre completo"
                  outlined
                  type="text"
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="email"
                  label="Correo"
                  outlined
                  type="email"
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="pass"
                  label="Contraseña"
                  outlined
                  type="password"
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field
                    label="Telefono"
                    v-model="tel"
                    outlined
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field
                    label="Celular"
                    v-model="cel"
                    outlined
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="6">
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
                    ></v-text-field>
                  </template>
                  <v-date-picker v-model="date" no-title scrollable>
                    <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="menu = false">
                      Cancel
                    </v-btn>
                    <v-btn
                        text
                        color="primary"
                        @click="$refs.menu.save(date)"
                    >
                      OK
                    </v-btn>
                  </v-date-picker>
                </v-menu>
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field
                    label="Direccion"
                    v-model="addr"
                    outlined
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
                  <v-btn depressed color="error" @click="upUser">
                    Crear
                  </v-btn>
                </v-col>
              </v-card-actions>
            </v-row>
          </v-container>
        </v-card>

      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from "axios";
import VueCookies from "vue-cookies";
var CryptoJS = require("crypto-js");

export default {
  data() {
    return {
      name: "",
      email: "",
      pass: "",
      session: "",
      user: false,
      loginIs: true,
      typeOfUser: 2,
      role:[],
      date: null,
      tel: "",
      cel: "",
      addr: "",
      ex11: 0,
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
              console.log(res.data);
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
              console.log(res.data[0])
              cnx.$router.push("/dasshboard");
            }
          })
          .catch();
      }
    },
    createUser() {
      this.user = !this.user;
    },
    upUser() {
      if (this.user != "" && this.email != "" && this.pass != "") {
        var params = new URLSearchParams();
        params.append("fullname", this.name);
        params.append("email", this.email);
        params.append("pass", this.pass);
        params.append("useForAmpi", 0);
        params.append("typeOfUser",0);
        
        axios
          .post(`${this.$store.state.url}/createuser`, params)
          .then((res) => {
              if(res.data.message == 1){
                axios.post(`${this.$store.state.url}/getuseridlogin`,params).then(resDos=>{this.upData(resDos.data[0].id)}).catch(e => {console.log(e)})
              }            
          })
          .catch((e) => console.log(e));
      } else {
        alert("Favor de llenar todos los campos");
      }
    },
    upData(id){
     
      var params = new URLSearchParams();
      params.append("id",id);
      params.append("telefonoOfficina", this.tel);
      params.append("celular", this.cel);
      params.append("direccionDeOfficina", this.addr);
      params.append("cumpleanios", this.date);
      params.append("compartirDatos", this.ex11);

      axios
          .post(`${this.$store.state.url}/createdatauser`, params)
          .then((res) => {
            if(res.data.message == "creado"){
              this.$router.push("/dasshboard");
            }
          })
          .catch((e) => console.log(e));
    }  

  },
  beforeMount() {
    axios.post(`${this.$store.state.url}/getrole`).then(res => this.role =  res.data).catch(e => console.log(e))
    var cookie = VueCookies.get("id");
    if (cookie) {
      if (cookie != "") {
        this.$router.push("/dasshboard");
      }
    }
  },
  computed:{
  }

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
