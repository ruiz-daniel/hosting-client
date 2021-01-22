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

import Vue from 'vue';
import App from './components/App';
import axios from 'axios';



import 'primeicons/primeicons.css'
import 'primevue/resources/primevue.min.css'
import 'primeflex/primeflex.css'
import 'primevue/resources/themes/nova/theme.css'

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

new Vue({
    el: '#app',
    render: h => h(App)
});
