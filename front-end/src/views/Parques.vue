<template>
  <v-container-fluid>
    <v-row>
      <v-col cols="2">
        <v-app>
          <dashboard  :user_type="userType"/>
        </v-app>
      </v-col>
      <v-col cols="10" >
        <v-container class="container">
          <v-row justify="start" align="start">
            <v-col cols="12">
              <div>
                <v-app-bar
                    color="deep-purple accent-4"
                    dense
                    dark
                    height="100vh"
                    width="100%"
                >

                  <v-toolbar-title>Parques ----</v-toolbar-title>


                  <template>
                    <v-container>

                      <v-row justify="end" align="end">
                        <v-col cols="3" class="my-3">
                          <v-text-field
                              label="Buscar"

                              filled
                              rounded
                              dense
                          ></v-text-field>
                        </v-col>
                      </v-row>

                    </v-container>
                  </template>

                </v-app-bar>
              </div>
            </v-col>
            <v-col cols="12" md="3" v-for="i in allparks" :key="i">
              <v-card
                  class="mx-auto"
                  max-width="100%"
              >
                <v-card-text>
                  <h3>Parque</h3>
                  <p class="_p">
                    {{i.nombre_es}}
                  </p>

                </v-card-text>
                <v-card-actions>
                  <v-btn
                      text
                      color="teal accent-4"
                      @click="getParque(i.id)"
                  >
                    <popup-parque :datasOfPark="i" :edit="search('Edicion')"/>
                  </v-btn>
                  <v-btn
                      text
                      color="red"
                      @click="deleteParque(i.id)"
                      v-if="search('Borrar')"
                  >
                    <v-icon> mdi-delete</v-icon>
                  </v-btn>
                </v-card-actions>

              </v-card>
            </v-col>
            <v-col cols="3">
              <plusCard
              :dialogs="'newPark'"
              v-if="search('Creacion')"
              ></plusCard>
            </v-col>

          </v-row>
        </v-container>
      </v-col>
    </v-row>
  </v-container-fluid>
</template>

<script>
import dashboard from "../components/sideBar";
import plusCard from "../components/plusCard";
import popupParque from "../components/popupParque";
import axios from "axios";
import VueCookies from "vue-cookies";
import PopupParque from "../components/popupParque";
var CryptoJS = require("crypto-js");
export default {
name: "Parques",
  components:{
    PopupParque,
    dashboard,
    plusCard,
    popupParque
  },
  data(){
  return{
    allparks:[],
    userType:null
  }
  },
  beforeMount() {
    var type = CryptoJS.AES.decrypt(VueCookies.get("user_type"), "ampip");
    this.userType = type.toString(CryptoJS.enc.Utf8);
    var params = new URLSearchParams();
    params.append("id", this.$store.state.data.key_corp);
    axios.post(`${this.$store.state.url}/getallpark`,params).then(res => this.allparks=  res.data ).catch(e => console.log(e));
  },

  methods:{
    search(key){
      for (let i = 0 ; i < this.$store.state.permisos.length; i++){
        let search = this.$store.state.permisos[i].search(key);
        if (search > -1){
          return true
        }
      }
    }
  }
}
</script>

<style scoped>

</style>
