<template>
  <v-container-fluid>
    <v-row>
      <v-col cols="2">
        <v-app>
          <dashboard :user_type="userType" />
        </v-app>
      </v-col>
      <v-col cols="10" v-if="users[0].id">
        <v-row justify="start" align="start" class="my-5">
          <v-col cols="3" v-for="i in users" :key="i">
            <v-card class="mx-auto" max-width="100%">
              <v-card-text>
                <p>{{ i.email }}</p>
                <p>{{ i.name }}</p>
              </v-card-text>
              <v-card-actions>
                <!-- -->
                <v-btn depressed color="primary" @click="dialog = true">
                  Opciones
                </v-btn>
                <v-dialog v-model="dialog" max-width="500">
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
                            :items="roles"
                            v-model="rolasign"
                            name="roles"
                            v-validate="'required'"
                            item-text="name"
                            item-value="name"
                            label="Tipo de socio"
                            outlined
                          />
                        </v-col>
                        <v-col
                            cols="12"
                        >
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

                      <v-btn color="green darken-1" text @click="add(i.id)">
                        Agregar
                      </v-btn>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-container-fluid>
</template>

<script>
import dashboard from "../components/sideBar";
import VueCookies from "vue-cookies";
import axios from "axios";
var CryptoJS = require("crypto-js");
export default {
  name: "admin.vue",
  data() {
    return {
      id: "",
      users: [],
      userType: null,
      role: [],
      dialog: false,
      corps: [],
      corpAsig: "",
      parques: null,
      parqueasig: "",
      roles: [],
      rolasign: "",
      items: ['Edicion', 'Creacion','Borrar'],
      value: ['solo lectura'],
    };
  },
  components: {
    dashboard,
  },
  beforeCreate() {
    if (VueCookies.get("admin") != "") {
      console.log("WELCOME ADMIN");
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
    } else {
      this.$router.push("/");
    }
  },
  beforeMount() {
    var type = CryptoJS.AES.decrypt(VueCookies.get("user_type"), "ampip");
    this.userType = type.toString(CryptoJS.enc.Utf8);
    axios
      .post(`${this.$store.state.url}/getalluser`)
      .then((res) => {
        this.users = res.data;
      })
      .catch((e) => console.log(e));

    axios
      .post(`${this.$store.state.url}/getrole`)
      .then((res) => (this.role = res.data))
      .catch((e) => console.log(e));
  },
  methods: {
    add(ids) {
      if (this.parqueasig != "" && this.corpAsig != "" && this.rolasign != "") {
        var key = VueCookies.get("id");
        var decripts = CryptoJS.AES.decrypt(key, "ampip");
        var id = decripts.toString(CryptoJS.enc.Utf8);
        var params = new URLSearchParams();
        params.append("id", ids);
        params.append("parqueasig", this.parqueasig);
        params.append("corpAsig", this.corpAsig);
        params.append("rolasign", this.rolasign);
        params.append("id_key", id);
        var ctx = this;
        axios
          .post(`${this.$store.state.url}/activeuser`, params)
          .then((res) => {
            if (res.data){
              for (var i = 0 ; i < ctx.value.length ; i ++){
                let params = new URLSearchParams();
                params.append("idUser",ids);
                params.append("idParque", ctx.parqueasig);
                params.append("permiso", ctx.value[i]);
                axios.post(`${this.$store.state.url}/setpermisos`,params).then(res=>{
                  if (res.data!=null){
                    ctx.$router.push("/dasshboard")
                  }
                }).catch(e => console.log(e));
              }
            }
          })
          .catch((e) => console.log(e));
      } else{
        alert("Favor de llenar los datos")
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
  },
};
</script>

<style scoped></style>
