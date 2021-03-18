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
        packets: [],
        hosted_sites: [],
        selected_site: {}, // site that is being edited or checked its info
        edit_switch: false, // flag to know when a site has been selected for modifications
        user_data: "no user", //loged in user data
        users_list: [],
        roles: [],
        selected_user: {}
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
        },
        getPacketByNameAndClient: state => (name, client) => {
            let result;
            state.packets.forEach(element => {
                if (element.name === name && element.client_type === client) {
                    result = element
                }
            });
            return result
        },
        getWebServerByName: state => name => {
            let result
            state.web_server_options.forEach(element => {
                if (element.name === name) {
                    result = element
                }
            })
            return result
        },
        getDatabaseServerByName: state => name => {
            let result
            state.database_servers.forEach(element => {
                if (element.name === name) {
                    result = element
                }
            })
            return result
        },
        getTemplateByName: state => name => {
            let result
            state.templates.forEach(element => {
                if (element.name === name) {
                    result = element
                }
            })
            return result
        },
        getRoleByName: state => name => {
            let result
            state.roles.forEach(element => {
                if(element.name === name) {
                    result = element
                }
            })
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
        },
        SET_HOSTED_SITES(state, data) {
            state.hosted_sites = data
        },
        SET_SELECTED_SITE(state, data) {
            state.selected_site = data
        },
        SWITCH_EDIT(state, edit) {
            state.edit_switch = edit;
        },
        SET_USER_DATA(state, data) {
            state.user_data = data;
        },
        SET_USERS_LIST(state, data) {
            state.users_list = data
        },
        SET_USER_ROLES(state, data) {
            state.roles = data
        },
        SET_SELECTED_USER(state, data) {
            state.selected_user = data
        }
    },
    actions:{}
})