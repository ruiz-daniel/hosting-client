import Vue from 'vue';
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        client_types: ["Natural", "Empresarial"],
        web_server_options: [],
        php_options: ["5.6", "7.1", "7.2", "7.3"],
        templates: [],
        database_servers: [],
        packets: []
    },
    getters: {
        getNaturalPackets: state => {
            let result = []
            state.packets.forEach(element => {
                if (element.client_type == "Natural") {
                    result.push(element)
                }
            });
            return result
        },
        getEnterprisePackets: state => {
            let result = []
            state.packets.forEach(element => {
                if (element.client_type == "Empresarial") {
                    result.push(element)
                }
            });
            return result
        }
    },
    mutations: {
        SET_WEB_SERVERS(state, data) {
            state.web_server_options = data;
        },
        SET_TEMPLATES(state, data) {
            state.templates = data;
        },
        SET_DATABASE_SERVERS(state, data) {
            state.database_servers = data;
        },
        SET_PACKETS(state, data) {
            state.packets = data;
        }
    },
    actions:{}
})