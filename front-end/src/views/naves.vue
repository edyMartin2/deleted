<template>
  <v-container-fluid>
    <v-row>
      <v-col cols="2">
        <v-app>
          <dashboard  :user_type="userType"/>
        </v-app>
      </v-col>
      <v-col cols="10" >
        <h1 class="_h1_main">Naves</h1>
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

                      <h3 class="_h3_buscador">Buscar Naves</h3>


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

                <v-col cols="12" md="3" v-for="i in allnaves" :key="i">
                  <card :propsData="i" :name="'Naves'" :del="search('Borrar')"/>
                </v-col>
                <v-col cols="3">
                  <plus-card :dialogs="'newNave'" v-if="search('Creacion')"></plus-card>
                </v-col>
          </v-row>
        </v-container>
      </v-col>
    </v-row>
  </v-container-fluid>
</template>

<script>
import dashboard from "../components/sideBar";
import Card from "../components/card";
var CryptoJS = require("crypto-js");
import VueCookies from "vue-cookies";
import axios from "axios";
import PlusCard from "../components/plusCard";
export default {
  components: {
    PlusCard,
    Card,
    dashboard,

  },
  data() {
    return {
      c: 1,
      allnaves:[],
      actions:["Nuevo"],
      userType:null
    };
  },
  beforeMount() {
    var type = CryptoJS.AES.decrypt(VueCookies.get("user_type"), "ampip");
    this.userType = type.toString(CryptoJS.enc.Utf8);

    var key = VueCookies.get("id");

    if (key){
      if (key != ""  ) {


        var data = new URLSearchParams();
        data.append("id", this.$store.state.data.key_corp);
        axios.post(`${this.$store.state.url}/getallpark`,data ).then(res=>{
          for (var i = 0; i < res.data.length ; i++){
            var newParams = new URLSearchParams();
            newParams.append("id", res.data[i].id);
            //var ctx = this;
            axios.post(`${this.$store.state.url}/getallnave`,newParams)
                .then(res=>{
                  if (res.data.length > 0 ){
                   for (var x = 0 ; x < res.data.length; x ++){
                     this.allnaves.push( res.data[x]);
                   }
                  }
                })
                .catch(e => console.log(e));
          }
        }).catch(e => console.log(e));



      } else {
        this.$router.push("/Home");
      }
    }else{
      this.$router.push("/")
    }
  },
  methods:{
    search(key){
      let dec = false ;
      for (let i = 0 ; i < this.$store.state.permisos.length; i++){
        let search = this.$store.state.permisos[i].search(key);
        if (search > -1){
          dec = true

        }
      }
      return dec
    }
  }
};

</script>
