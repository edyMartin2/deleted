import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import router from './router'
import store from './store'
import VueCryptojs from 'vue-cryptojs'
import * as VueGoogleMaps from 'gmap-vue'

Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyCFdQ7O0MIewEqbyXhW0k9XemMqnYx0aDQ',
    libraries: 'places'
  },
  installComponents: true
})

Vue.config.productionTip = false
Vue.use(VueCryptojs)

router.push('/')

new Vue({
  vuetify,
  router,
  store,
  render: h => h(App)
}).$mount('#app')
