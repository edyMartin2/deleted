import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    url: "http://localhost:8000/api",
    data: null,
    permisos: null,
    token: "a270c78c-a633-4e22-bb98-172615781bb8",
  },
  mutations: {
    adddata(state, value) {
      state.data = value;
    },
    addpermiso(state, value) {
      state.permisos = value;
    },
  },
  actions: {},
  modules: {},
});
