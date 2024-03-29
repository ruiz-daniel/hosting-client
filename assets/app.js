/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

// Vue essentials
import Vue from 'vue';
import App from './components/App';
import store from './store.js';
import router from './router.js';
//JS file for axios http requests
import api from './services/ApiCalls.js'

// progress bar
import 'nprogress/nprogress.css'



// PrimeVue essentials
import 'primeicons/primeicons.css'
import 'primevue/resources/primevue.min.css'
import 'primeflex/primeflex.css'
import 'primevue/resources/themes/nova/theme.css'
import ToastService from 'primevue/toastservice';
Vue.use(ToastService);

// PrimeVue components
import PanelMenu from 'primevue/panelmenu';
Vue.component('PanelMenu', PanelMenu);
import InputText from 'primevue/inputtext';
Vue.component('InputText', InputText);
import InputNumber from 'primevue/inputnumber';
Vue.component("InputNumber", InputNumber);
import Button from 'primevue/button';
Vue.component('Button', Button);
import Dropdown from 'primevue/dropdown';
Vue.component("Dropdown", Dropdown);
import Checkbox from 'primevue/checkbox';
Vue.component("Checkbox", Checkbox);
import DataTable from 'primevue/datatable';
Vue.component("DataTable", DataTable);
import Column from 'primevue/column';
Vue.component("Column", Column);
import Card from 'primevue/card';
Vue.component("Card", Card);
import Toolbar from 'primevue/toolbar';
Vue.component("Toolbar", Toolbar);
import Message from 'primevue/message';
Vue.component("Message", Message);
import InlineMessage from 'primevue/inlinemessage';
Vue.component("InlineMessage", InlineMessage);
import Dialog from 'primevue/dialog';
Vue.component("Dialog", Dialog);
import Toast from 'primevue/toast';
Vue.component("Toast", Toast);
import OverlayPanel from 'primevue/overlaypanel';
Vue.component("OverlayPanel", OverlayPanel);
import Password from 'primevue/password';
Vue.component("Password", Password);
import DataView from 'primevue/dataview';
Vue.component("DataView", DataView);
import Chart from 'primevue/chart';
Vue.component("Chart", Chart);

new Vue({
    store,
    router,

    data() {
        return {
            api
        }
    },
    methods: {
    // Get data for comboboxes
      getServerData() {
        api.getPackets(function(data){
            store.commit("SET_PACKETS", data)
        })

        api.getWebServers(function(data){
            store.commit("SET_WEB_SERVERS", data)
        })

        api.getDbServers(function(data){
            store.commit("SET_DATABASE_SERVERS", data)
        })

        api.getTemplates(function(data){
            store.commit("SET_TEMPLATES", data)
        })
      }
    },

    mounted() {
        this.getServerData()
        // If the page is reloaded outside of the login view, get the logged in user data from the session storage
        if (this.$route.path !== "/" && (store.user_data == "no user" || store.user_data == null)) {
            let user_data = {
              'username': sessionStorage.getItem('username'),
              'role': sessionStorage.getItem('role')
            }
            store.commit("SET_USER_DATA", user_data)
          }

    },

    el: '#app',
    render: h => h(App)
});
