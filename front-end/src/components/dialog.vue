<template>
  <v-dialog v-model="dialog" max-width="600px">
    <template v-slot:activator="{ on, attrs }">
      <v-btn color="error" icon v-bind="attrs" v-on="on" @click="watchCp">
        <v-icon>
          mdi-eye
        </v-icon>
      </v-btn>
    </template>
    <v-card>
      <v-card-title>
        <span class="headline">Datos del corporativo</span>
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="6">
              <v-text-field
                label="Corporativo"
                placeholder="Corporativo"
                outlined
                v-model="corp.corporativo"
                :rules="[rules.required]"
              ></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-text-field
                label="Nombre en español"
                placeholder="Nombre en español"
                outlined
                v-model="corp.nombre_es"
                :rules="[rules.required]"
              ></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-text-field
                label="Nombre en ingles"
                placeholder="Nombre en ingles"
                outlined
                v-model="corp.nombre_en"
                :rules="[rules.required]"
              ></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-text-field
                label="Direccion"
                placeholder="Direccion"
                outlined
                v-model="corp.direccion"
                :rules="[rules.required]"
              ></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-text-field
                label="Codigo Postal"
                placeholder="C.P"
                outlined
                v-model="corp.cp"
                :rules="[rules.required]"
                @keyup="watchCp"
              ></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-select
                :items="cp"
                label="Colonia"
                placeholder="Colonia"
                outlined
                v-model="corp.colonia"
                :rules="[rules.required]"
                item-text="response.asentamiento"
                item-value="response.asentamiento"
              ></v-select>
            </v-col>
            <v-col cols="6">
              <v-text-field
                label="Estado"
                placeholder="Estado"
                outlined
                v-model="edo"
                :rules="[rules.required]"
              ></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-text-field
                label="Municipio"
                outlined
                :rules="[rules.required]"
                v-model="mun"
              ></v-text-field>
            </v-col>
            <v-col cols="3">
              <v-select
                :items="items"
                label="Lada"
                outlined
                :rules="[rules.required]"
              ></v-select>
            </v-col>
            <v-col cols="9">
              <v-text-field
                label="Telefono"
                placeholder="Telefono"
                outlined
                v-model="corp.celular"
                :rules="[rules.required]"
                type="number"
              ></v-text-field>
            </v-col>
          </v-row>
        </v-container>
        <small>*Todos los campos son requeridos</small>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="dialog = false">
          Cancelar
        </v-btn>
        <v-btn color="blue darken-1" text @click="update()">
          Guardar
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import axios from "axios";
var CryptoJS = require("crypto-js");
import VueCookies from "vue-cookies";

export default {
  name: "dialog.vue",
  data() {
    return {
      dialog: false,
      corp: {
        corporativo: "",
        nombre_es: "",
        nombre_en: "",
        rfc: "",
        direccion: "",
        cp: "",
        colonia: "",
        estado: "",
        municipio: "",
        celular: "",
        logo: "",
      },
      items: ["+52", "+1"],
      rules: {
        required: (value) => !!value || "Obligatorio.",
        min: (v) => v.length >= 8 || "Min 8 characters",
        emailMatch: () => `The email and password you entered don't match`,
      },
      cp: [],
    };
  },
  props: ["id"],
  beforeMount() {
    let param = new URLSearchParams();
    param.append("id", this.id);
    axios
      .post(`${this.$store.state.url}/corp`, param)
      .then((res) => (this.corp = res.data))
      .catch((e) => console.log(e));
  },
  methods: {
    update() {
      var key = VueCookies.get("id");
      var decripts = CryptoJS.AES.decrypt(key, "ampip");
      var originalText = decripts.toString(CryptoJS.enc.Utf8);
      let params = new URLSearchParams();
      params.append("id", originalText);
      params.append("id_key", this.corp.id);
      params.append("nombre_es", this.corp.nombre_es);
      params.append("nombre_en", this.corp.nombre_en);
      params.append("direccion", this.corp.direccion);
      params.append("cp", this.corp.cp);
      params.append("colonia", this.corp.colonia);
      params.append("estado", this.corp.estado);
      params.append("municipio", this.corp.municipio);
      params.append("telefono", this.corp.celular);
      params.append("rfc", this.corp.rfc);

      axios
        .post(`${this.$store.state.url}/updatecorp`, params)
        .then((res) => {
          console.log(res.data);
        })
        .catch((e) => {
          console.log(e);
        });
      alert(originalText + "  " + this.corp.id);
      this.dialog = false;
    },

    watchCp() {
      axios
        .get(
          `https://api-sepomex.hckdrk.mx/query/info_cp/${this.corp.cp}?token=${this.$store.state.token}`
        )
        .then((res) => {
          this.cp = res.data;
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },

  computed: {
    edo() {
      if (this.cp.length > 0) {
        return this.cp[0].response.estado;
      } else {
        return "Sin datos";
      }
    },
    mun() {
      if (this.cp.length > 0) {
        return this.cp[0].response.municipio;
      } else {
        return "Sin datos";
      }
    }, 
  },
};
</script>

<style scoped></style>
