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
        <v-container>
          <v-row>
            <v-col v-for="i in corps" :key="i" cols="3" class="my-3 px-3">
              <v-card class="mx-auto" max-width="100%">
                <v-card-text>
                  <h3>{{ i.name }}</h3>
                  <p v-if="i.rfc">{{ i.rfc }}</p>
                  <p v-if="i.rfc == null">Sin RFC</p>
                </v-card-text>
                <v-card-actions>
                  <dial :id="i.id" />

                  <v-btn
                    icon
                    color="red"
                    v-if="i.status && i.id != 1"
                    @click="inactiveActive(i.id, 'i', 'c')"
                  >
                    <v-icon>
                      mdi-delete
                    </v-icon>
                  </v-btn>

                  <v-btn
                    icon
                    color="blue"
                    v-if="!i.status"
                    @click="inactiveActive(i.id, 'a', 'c')"
                  >
                    <v-icon>
                      mdi-checkbox-marked-circle-outline
                    </v-icon>
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-col>
            <v-col cols="3" class="my-3 px-3">
              <plus-card
                :dialogs="'newCorp'"
              ></plus-card>
            </v-col>
          </v-row>
        </v-container>
      </v-col>
    </v-row>
  </v-container-fluid>
</template>

<script>
import axios from "axios";
import VueCookies from "vue-cookies";
var CryptoJS = require("crypto-js");
import dashboard from "../components/sideBar";
import dial from "../components/dialog";
import plusCard from "../components/plusCard";
export default {
  name: "corporativos",
  data() {
    return {
      userType: null,
      corps: null,
    };
  },
  beforeMount() {
    var type = CryptoJS.AES.decrypt(VueCookies.get("user_type"), "ampip");
    this.userType = type.toString(CryptoJS.enc.Utf8);

    axios
      .post(`${this.$store.state.url}/getallcorps`)
      .then((res) => (this.corps = res.data))
      .catch((e) => console.log(e));
  },
  components: {
    dashboard,
    dial,
    plusCard
  },
  methods: {
    inactiveActive(id, action, table) {
      let params = new URLSearchParams();
      params.append("id", id);
      params.append("type", action);
      params.append("table", table);

      axios
        .post(`${this.$store.state.url}/activeinactive`, params)
        .then((res) => {
          if (res.data.message == "listo") {
            this.$router.push("/dasshboard");
          }
        })
        .catch((e) => console.log(e));
    },
    search(key) {
      let dec = false;
      for (let i = 0; i < this.$store.state.permisos.length; i++) {
        let search = this.$store.state.permisos[i].search(key);
        if (search > -1) {
          dec = true;
        }
      }
      return dec;
    },
  },
};
</script>

<style scoped></style>
