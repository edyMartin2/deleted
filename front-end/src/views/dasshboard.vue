<template>
  <v-container-fluid>
    <v-row>
      <v-col cols="2">
        <v-app>
          <!--Dashboard admin y no admin logica dentro de ese componente-->
          <dashboard :user_type="userType" />
        </v-app>
      </v-col>
      <v-col cols="10" v-if="this.datas.id">
        <h1 class="_h1_main">Datos de perfil</h1>
        <v-row justify="center" align="center">
          <v-col cols="10">
            <v-card class="my-10">
              <v-card-title class="white--text mt-8">
                <p class="ml-3">
                  {{ this.name }}
                </p>
              </v-card-title>

              <v-card-text>
                <div class="font-weight-bold ml-8 mb-2">
                  {{ this.email }}
                </div>

                <v-row justify="space-between">
                  <v-col cols="7" style="text-align: left">
                    <div class="_cont_dash">
                      <div class="_cont_value">
                        <div>TIPO DE SOCIO :</div>
                        <div>{{ this.datas.cargo }}</div>
                      </div>
                      <div class="_cont_value">
                        <div>OFICINA :</div>
                        <div>{{ this.datas.direccionDeOfficina }}</div>
                      </div>
                      <div class="_cont_value">
                        <div>TELEFONO :</div>
                        <div>{{ this.datas.telefonoOfficina }}</div>
                      </div>
                      <div class="_cont_value">
                        <div>CELULAR :</div>
                        <div>{{ this.datas.celular }}</div>
                      </div>
                      <div class="_cont_value">
                        <div>FECHA DE NACIMIENTO :</div>
                        <div>{{ this.datas.cumpleanios }}</div>
                      </div>
                    </div>
                  </v-col>
                </v-row>
              </v-card-text>
              <v-card-actions>
                <v-btn
                  v-if="admin == 'Administrator'"
                  @click="
                    () => {
                      this.$router.push('/admin');
                    }
                  "
                  >Administrar</v-btn
                >

                <v-btn @click="getGoogle">Google</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-container-fluid>
</template>

<script>
var CryptoJS = require("crypto-js");
import VueCookies from "vue-cookies";
import dashboard from "../components/sideBar";
import axios from "axios";
export default {
  components: { dashboard },
  data() {
    return {
      datas: "",
      name: "",
      email: "",
      admin: false,
      date: null,
      menu: false,
      modal: false,
      tel: "",
      cel: "",
      addr: "",
      ex11: 0,
      userType: null,
      dialog: false,
      corp: {
        corp: "",
        name_es: "",
        name_en: "",
        rfc: "",
        address: "",
        cp: "",
        colonia: "",
        estado: "",
        municipio: "",
        tel: "",
        logo: "",
      },
    };
  },
  beforeCreate() {
    var key = VueCookies.get("id");
    if (key) {
      if (key != "") {
        var name = CryptoJS.AES.decrypt(VueCookies.get("name"), "ampip");
        this.name = name.toString(CryptoJS.enc.Utf8);

        var email = CryptoJS.AES.decrypt(VueCookies.get("email"), "ampip");
        this.email = email.toString(CryptoJS.enc.Utf8);

        var decripts = CryptoJS.AES.decrypt(key, "ampip");
        var originalText = decripts.toString(CryptoJS.enc.Utf8);
        this.id = originalText;
        var data = new URLSearchParams();
        data.append("id", this.id);

        axios
          .post(`${this.$store.state.url}/getdatauser`, data)
          .then((res) => {
            this.datas = res.data;
            this.$store.commit("adddata", res.data);
          })
          .catch((e) => console.log(e));

        data = new URLSearchParams();
        data.append("id", this.id);

        axios
          .post(`${this.$store.state.url}/getdatauser`, data)
          .then((res) => {
            this.admin = res.data.cargo;
            VueCookies.set(
              "user_type",
              CryptoJS.AES.encrypt(this.admin, "ampip").toString()
            );

            this.userType = res.data.cargo;
          })
          .catch((e) => console.log(e));

        let param = new URLSearchParams();
        param.append("id", originalText);
        axios
          .post(`${this.$store.state.url}/getparquesusuarios`, param)
          .then((res) => {
            let arr = [];
            for (let i = 0; i < res.data.length; i++) {
              arr.push(res.data[i].permiso);
            }
            this.$store.commit("addpermiso", arr);
          })
          .catch((e) => {
            console.log(e);
          });
      } else {
        this.$router.push("/Home");
      }
    } else {
      this.$router.push("/");
    }
    window.addEventListener("beforeunload", this.preventNav);
  },
  methods: {
    adddataUser() {
      var id = CryptoJS.AES.decrypt(VueCookies.get("id"), "ampip");
      var params = new URLSearchParams();
      params.append("id", id.toString(CryptoJS.enc.Utf8));
      params.append("telefonoOfficina", this.tel);
      params.append("celular", this.cel);
      params.append("direccionDeOfficina", this.addr);
      params.append("cumpleanios", this.date);
      params.append("compartirDatos", this.ex11);

      axios
        .post(`${this.$store.state.url}/createdatauser`, params)
        .then((res) => console.log(res))
        .catch((e) => console.log(e));
    },
    addCorp() {
      var params = new URLSearchParams();
      params.append("corporativo", this.corp.corp);
      params.append("nombre_es", this.corp.name_es);
      params.append("nombre_en", this.corp.name_en);
      params.append("rfc", this.corp.rfc);
      params.append("direccion", this.corp.address);
      params.append("cp", this.corp.cp);
      params.append("colonia", this.corp.colonia);
      params.append("estado", this.corp.estado);
      params.append("municipio", this.corp.municipio);
      params.append("celular", this.corp.tel);
      params.append("logo", this.corp.logo);
      params.append("id", this.datas.id);
      alert(this.datas.id);
      if (
        this.corp.corp != "" &&
        this.corp.name_es != "" &&
        this.corp.name_en != "" &&
        this.corp.rfc != "" &&
        this.corp.address != "" &&
        this.corp.cp != "" &&
        this.corp.colonia != "" &&
        this.corp.estado != "" &&
        this.corp.municipio != "" &&
        this.corp.tel != "" &&
        this.corp.logo != ""
      ) {
        axios
          .post(`${this.$store.state.url}/createcorp`, params)
          .then((res) => {
            alert(res);
          })
          .catch((e) => console.log(e));
      } else {
        alert("Por favor llene todos loc campos");
      }
    },

    getGoogle() {
      var url =
        "https://script.google.com/macros/s/AKfycby7axlogWsY_yN7TByioV9V8Kd8yDP0t9Nquu8K3d8d_35QIj7X39yh4q3ouq_lMU2P/exec";

      axios
        .get(url)
        .then((res) => console.log(res.data))
        .catch((e) => console.log(e));
    },
  },
};
</script>
