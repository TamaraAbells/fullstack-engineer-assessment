import Vue from 'vue';
import Vuetify from 'vuetify/lib/framework';
import SortedTablePlugin from "vue-sorted-table"
import api from "../services/api"


Vue.use(Vuetify);
Vue.use(require('vue-moment'))
Vue.use(SortedTablePlugin)
Vue.prototype.$http = api;

export default new Vuetify({
});
