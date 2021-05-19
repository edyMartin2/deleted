<template>
  <div>
    <v-card class="mx-auto my-auto" max-width="100%">
      <v-card-text>
        <br />
        <div>Nuevo</div>
        <p class="display-1 text--primary">
          <v-btn icon @click="dial(dialogs)">
            <v-icon large>
              mdi-plus
            </v-icon>
          </v-btn>
        </p>
        <br />
      </v-card-text>
    </v-card>
    <!-- Nueva nave -->
    <v-dialog v-model="newNave" max-width="730px">
      <v-card>
        <v-card-title>Agrega una nave</v-card-title>
        <br />
        <v-container>
          <v-row>
            <v-col cols="12">
              <v-text-field
                outlined
                placeholder="Nombre"
                v-model="name"
              ></v-text-field>
              <br />
              <label for="cars">Selecciona el parque : </label>
              <select name="cars" id="cars" v-model="parque">
                <option value="">Selecciona</option>
                <option v-for="i in parques" :key="i" :value="i.id">{{
                  i.nombre_es
                }}</option>
              </select>
            </v-col>
          </v-row>
        </v-container>
        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn color="green darken-1" text @click="addNave">
            Añadir
          </v-btn>

          <v-btn color="green darken-1" text @click="newNave = false">
            Cancelar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <!-- Nuevo parque -->
    <v-dialog v-model="newPark" max-width="730px">
      <v-card>
        <v-card-title>Agrega un parque</v-card-title>
        <v-container>
          <v-row>
            <v-col cols="6">
              <v-text-field
                label="Nombre en español"
                outlined
                placeholder="Nombre"
                v-model="name_es"
              ></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-text-field
                label="Nombre en ingles"
                outlined
                placeholder="Nombre"
                v-model="name_en"
              >
              </v-text-field>
            </v-col>

            <v-col cols="6">
              <v-text-field
                label="Administrador"
                outlined
                placeholder="Administrador"
                v-model="admins"
              ></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-text-field
                label="Propietario"
                outlined
                placeholder="Propietario"
                v-model="propi"
              >
              </v-text-field>
            </v-col>

            <v-col cols="6">
              <v-text-field
                label="Region"
                outlined
                placeholder="Nombre"
                v-model="region"
              >
              </v-text-field>
            </v-col>
            <v-col cols="6">
              <v-text-field
                label="Mercado"
                outlined
                placeholder="Nombre"
                v-model="mercado"
              ></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-text-field
                label="Tipo de industria"
                outlined
                placeholder="Nombre"
                v-model="industria"
              >
              </v-text-field>
            </v-col>
            <!-- superficies -->
            <v-col cols="6">
              <v-text-field
                label="Superficie total"
                suffix="km2"
                outlined
                placeholder="En km2"
                type="number"
                v-model="sup_tot"
              ></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-text-field
                label="Superficie urbanizada"
                outlined
                suffix="km2"
                placeholder="En km2"
                type="number"
                v-model="sup_urb"
              >
              </v-text-field>
            </v-col>
            <v-col cols="6">
              <v-text-field
                label="Superficie ocupada"
                suffix="km2"
                outlined
                placeholder="En km2"
                type="number"
                v-model="sup_oc"
              ></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-text-field
                label="Superficie disponible"
                suffix="km2"
                outlined
                placeholder="En km2"
                type="number"
                v-model="sup_dis"
              >
              </v-text-field>
            </v-col>
            <!-- superficies -->

            <v-col cols="6">
              <v-select
                :items="items"
                label="Tipo de propiedad"
                outlined
                v-model="tipo"
              ></v-select>
            </v-col>
            <v-col cols="6">
              <v-menu
                v-model="menu1"
                :close-on-content-click="false"
                max-width="290"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field
                    :value="date"
                    label="Inicio de operaciones"
                    readonly
                    outlined
                    v-bind="attrs"
                    v-on="on"
                    @click:clear="date = null"
                  ></v-text-field>
                </template>
                <v-date-picker
                  v-model="date"
                  @change="menu1 = false"
                ></v-date-picker>
              </v-menu>
            </v-col>
            <v-col cols="6">
              <v-select
                :items="infraList"
                label="Tipo de infraestructura"
                outlined
                v-model="infra"
              ></v-select>
            </v-col>
            <v-col cols="6">
              <v-text-field
                label="Nombre de contacto"
                outlined
                placeholder="Nombre"
                v-model="name_contact"
              >
              </v-text-field>
            </v-col>
            <v-col cols="6">
              <v-text-field
                label="Telefono"
                outlined
                placeholder="Telefono"
                type="phone"
                v-model="telefono"
              ></v-text-field>
            </v-col>

            <v-col cols="12">
              <h1>Seleciona la ubicacion</h1>
              <GmapMap
                :center="{ lat: 25, lng: -100 }"
                :zoom="4"
                map-type-id="terrain"
                style="width: 100%; height: 300px"
                @click="add"
              >
                <GmapMarker
                  :position="markers"
                  :clickable="true"
                  :draggable="true"
                />
              </GmapMap>
            </v-col>
          </v-row>
        </v-container>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-switch
            color="error"
            value
            input-value="false"
            id="into"
            label="Parque dentro de parque"
            v-model="parkIntoPark"
          ></v-switch>
          <v-btn color="green darken-1" text @click="addparque">
            Añadir
          </v-btn>

          <v-btn color="green darken-1" text @click="newPark = false">
            Cancelar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <!-- Nuevo cotp -->
    <h1>gtgtg</h1>
    <v-dialog v-model="newCorp" max-width="730px">
      <v-card>
        <v-card-title>Agrega un corporativo</v-card-title>
        <v-container>
          <v-row>
            <v-col cols="6">
              <v-text-field
                label="Nombre en español"
                outlined
                placeholder="Nombre"
                v-model="corp.name_es"
              ></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-text-field
                label="Nombre en ingles"
                outlined
                placeholder="Nombre"
                v-model="corp.name_en"
              ></v-text-field>
            </v-col>
          </v-row>
        </v-container>
        <v-card-actions>
          <v-btn color="green darken-1" text @click="addparque">
            Añadir
          </v-btn>

          <v-btn color="green darken-1" text @click="newPark = false">
            Cancelar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "plusCard",

  data() {
    return {
      newNave: false,
      newPark: false,
      newCorp: false,
      name: "",
      parques: [],
      parque: "",
      items: ["Privada", "Gubernamental"],
      menu1: false,
      date: "",
      name_es: null,
      name_en: null,
      admins: null,
      propi: null,
      region: null,
      mercado: null,
      industria: null,
      sup_tot: null,
      sup_urb: null,
      sup_oc: null,
      sup_dis: null,
      tipo: null,
      infraList: ["a", "a"],
      name_contact: null,
      telefono: null,
      parkIntoPark: 0,
      key_corp: null,
      infra: null,
      markers: { x: 56.19605552778996, y: 111.13718986063111 },
      copr:{
        name_es:"",
        name__en:"", 
        typeSociety:"",
        address: "",
        cp:"",
        col:"",
        edo:"",
        cel:"",
        logo:"",
        inv_sig:"",
        inv_act:"",
        inv_ant:""
      }
    };
  },
  props: ["dialogs"],
  methods: {
    dial(dia) {
      console.log(dia);
      switch (dia) {
        case "newNave":
          this.newNave = !this.newNave;
          var params = new URLSearchParams();
          params.append("id", this.$store.state.data.key_corp);
          axios
            .post(`${this.$store.state.url}/getallpark`, params)
            .then((res) => {
              for (var i = 0; i < res.data.length; i++) {
                this.parques.push(res.data[i]);
              }
            })
            .catch((e) => console.log(e));
          break;
        case "newPark":
          this.newPark = !this.newPark;
          break;
        case "newCorp":
          this.newCorp = !this.newCorp;
      }
    },
    addNave() {
      var params = new URLSearchParams();
      params.append("name", this.name);
      params.append("idParque", this.parque);
      var ctx = this;
      if (this.name != "" && this.parque != "") {
        axios
          .post(`${this.$store.state.url}/createnave`, params)
          .then((res) => {
            if (res.data.message === "Creado") {
              ctx.$router.push("/");
            }
          })
          .catch((e) => console.log(e));
      } else {
        alert("Favor de llenar todos los campos");
      }
    },
    addparque() {
      var params = new URLSearchParams();
      params.append("key_corp", this.$store.state.data.key_corp);
      params.append("nombre_es", this.name_es);
      params.append("nombre_en", this.name_en);
      params.append("adminParq", this.admins);
      params.append("parqProp", this.propi);
      params.append("parqIntoParq", this.parkIntoPark);
      params.append("region", this.region);
      params.append("mercado", this.mercado);
      params.append("tipoDeIndustria", this.industria);
      params.append("superficieTotal", this.sup_tot);
      params.append("superficieUrban", this.sup_urb);
      params.append("superficieOcup", this.sup_urb);
      params.append("superficieDisp", this.sup_dis);
      params.append("tipoDePropiedad", this.tipo);
      params.append("ifraestructura", this.infra);
      axios
        .post(`${this.$store.state.url}/createpark`, params)
        .then((res) => {
          console.log(res.data);
        })
        .catch((e) => console.log(e));
    },
    addCorp() {},
    add(target) {
      this.markers = target.latLng.toJSON();
    },
  },
};
</script>

<style scoped></style>
