<template>
  <div class="p-grid p-justify-center" style="margin-top:2%; height: 100vh">
        <div class="p-shadow-14 p-col-6" style="text-align:center" id="container">
          <h1>Datos del Sitio</h1>
          <form action="/viewdata/" method="POST">
            <div class="p-grid form-container">
                <div class="p-col-4 box">
                    <PanelMenu :model="menu_items"></PanelMenu>
                </div>
                <div class="p-col-7 tab" v-show="show_site">
                    <div class="p-field">
                        <label for="site_name">Nombre del Sitio</label>
                        <InputText id="site_name" type="text" v-model="site_name" placeholder="ej: www.nombresitio.nat.cu"/>
                    </div>
                    <div class="p-field">
                        <label for="alias">Alias (si existe)</label>
                        <InputText id="alias" type="text" v-model="alias"/>
                    </div>
                    <div class="p-field">
                        <label for="client">Cliente</label>
                        <Dropdown id="client" :options="client_types" v-model="client" v-on:change="packet = null; getPacket()" />
                    </div>
                </div>

                <div class="p-col-7 tab" v-show="show_packet">
                    <div class="p-field" style="text-align:center; margin-bottom:2rem">
                        <label for="packet">Paquete contratado</label>
                        <Dropdown id="packet" :options="packets" optionLabel="name" v-model="packet" showClear style="width:50%" v-on:change="getPacket()" />
                    </div>
                    <div class="p-grid" v-if="selected_packet">
                        <div class="p-col-6">
                            <label for="disk_space">Espacio en Disco</label>
                            <InputNumber id="disk_space" v-model="disk_space" />MB
                        </div>
                        <div class="p-col-6">
                            <label for="db_space">Espacio en Base de Datos</label>
                            <InputNumber id="db_space" v-model="db_space" />MB
                        </div>
                    </div>
                    <div class="p-grid" v-if="selected_packet">
                        <div class="p-col-6">
                            <label for="extra_disk_space">Espacio adicional en Disco</label>
                            <InputNumber id="extra_disk_space" v-model="extra_disk_space" showButtons :step="100" :min="0" />
                        </div>
                        <div class="p-col-6">
                            <label for="extra_db_space">Espacio adicional en Base de Datos</label>
                            <InputNumber id="extra_db_space" v-model="extra_db_space" showButtons :step="100" :min="0" />
                        </div>
                    </div>
                </div>
                <div class="p-col-7 tab" v-show="show_web">
                    <div class="p-field">
                        <label for="web_server">Servidor Web</label>
                        <Dropdown id="web_server" :options="web_server_options" optionLabel="name" v-model="web_server" v-on:change="selectWebServer()" />
                        <div class="p-field" v-if="show_php_node" style="margin-top:0.5rem">
                            <label for="php_version">Versión php</label>
                            <Dropdown :options="php_options" v-model="php_version" id="php_version" />   
                        </div>
                        <div class="p-field-checkbox" v-if="show_php_node" style="margin-top:0.5rem">
                                <label for="node" style="padding-right:0.5rem">NodeJS</label>
                                <Checkbox id="node" v-model="node" :binary="true"/>
                        </div>
                    </div>
                    <div class="p-field">
                        <label for="template">Plantilla</label>
                        <Dropdown id="web_server" :options="templates" optionLabel="name" v-model="template" />
                    </div>
                    <div class="p-field">
                        <label for="template_version">Versión de la plantilla</label>
                        <InputText id="template_version" type="text" name="template_version" v-model="template_version"/>
                    </div>
                </div>

                <div class="p-col-7 tab" v-show="show_db">
                    <div class="p-field">
                        <label for="database_server">Servidor de Base de Datos</label>
                        <Dropdown id="database_server" :options="database_servers" optionLabel="name" v-model="database_server" />
                    </div>
                    <div class="p-field">
                        <label for="database_name">Nombre base de datos</label>
                        <InputText id="database_name" type="text" v-model="database_name" />
                    </div>
                    <div class="p-field">
                        <label for="database_user">Usuario base de datos</label>
                        <InputText id="database_user" type="text" v-model="database_user" />
                    </div>
                    <div class="p-field">
                        <label for="database_password">Contraseña base de datos</label>
                        <InputText id="database_password" type="password" v-model="database_password" />
                    </div>
                    <div class="p-field">
                        <label for="protected_files">Ficheros Protegidos</label>
                        <InputText id="protected_files" type="text" v-model="protected_files" placeholder="si existen" />
                    </div>
                    <div class="p-field">
                        <label for="index">Fichero de Inicio</label>
                        <InputText id="index" type="text" v-model="index" />
                    </div>
                </div>

                <div class="p-col-7 tab" v-show="show_ldap">
                    <div class="p-field">
                        <label for="ldap_user">Usuario</label>
                        <InputText id="ldap_user" type="text" name="ldap_user" v-model="ldap_user"/>
                    </div>
                    <div class="p-field">
                        <label for="ldap_name">Nombre</label>
                        <InputText id="ldap_name" type="text" name="ldap_name" v-model="ldap_name"/>
                    </div>
                    <div class="p-field">
                        <label for="ldap_last_name">Apellidos</label>
                        <InputText id="ldap_last_name" type="text" name="ldap_last_name" v-model="ldap_last_name"/>
                    </div>
                    <div class="p-field">
                        <label for="ldap_email">Correo</label>
                        <InputText id="ldap_email" type="text" name="ldap_email" v-model="ldap_email"/>
                    </div>
                    <div class="p-field">
                        <label for="ldap_phone">Teléfono</label>
                        <InputText id="ldap_phone" type="number" name="ldap_phone" v-model="ldap_phone"/>
                    </div>
                    <div class="p-field">
                        <label for="ldap_password">Contraseña</label>
                        <InputText id="ldap_password" type="password" name="ldap_password" v-model="ldap_password"/>
                    </div>
                </div>

                <div class="p-col-7 tab" v-show="show_save">
                    <div class="p-col-11" style="text-align:center">
                        <DataTable id="table_data" :value="table_data" :paginator="true" :rows="10">
                            <Column field="field" header="Campo"></Column>
                            <Column field="value" header="Valor"></Column>
                        </DataTable>
                    </div>
                    <div class="submit-div p-col-11">
                        <Button label="Guardar" v-if="validate" v-on:click="submit()" style="float: right"/>
                    </div>
                </div>

                
                
            </div>
          </form>
        </div>
  </div>
</template>

<script>
import axios from 'axios';
import { mapState } from 'vuex';
export default {
    data() {
        return {
            show_site: true,
            show_packet: false,
            show_web: false,
            show_db: false,
            show_ldap: false,
            show_save: false,

            site_name: "",
            alias: "",
            client: "Natural",

            web_server: "Apache/PHP/Node.js",
            show_php_node: true,
            php_version: "",
            node: false,

            template: "",
            template_version: "",

            database_name: "",
            database_user: "",
            database_server: "MySQL",
            database_password: "",

            protected_files: "",
            index: "index.html",

            ldap_name: "",
            ldap_user: "",
            ldap_last_name: "",
            ldap_email: "",
            ldap_phone: "",
            ldap_password: "",

            packet: "",
            selected_packet: false,
            disk_space: "",
            extra_disk_space: 0,
            db_space: "",
            extra_db_space: 0,

            table_data: [],

            menu_items: [
                {
                    label: 'Sitio',
                    icon: 'pi pi-file',
                    command: () =>{
                        this.show_site = true;
                        this.show_packet = false;
                        this.show_web = false;
                        this.show_db = false;
                        this.show_ldap = false;
                        this.show_save = false;
                    }
                },
                {
                    label: 'Paquete',
                    icon: 'pi pi-cloud',
                    command: () =>{
                        this.show_site = false;
                        this.show_packet = true;
                        this.show_web = false;
                        this.show_db = false;
                        this.show_ldap = false;
                        this.show_save = false;
                    }
                },
                {
                    label: 'Servidor Web',
                    icon: 'pi pi-globe',
                    command: () =>{
                        this.show_site = false;
                        this.show_packet = false;
                        this.show_web = true;
                        this.show_db = false;
                        this.show_ldap = false;
                        this.show_save = false;
                    }
                },
                {
                    label: 'Base de Datos y Ficheros',
                    icon: 'pi pi-folder-open',
                    command: () =>{
                        this.show_site = false;
                        this.show_packet = false;
                        this.show_web = false;
                        this.show_db = true;
                        this.show_ldap = false;
                        this.show_save = false;
                    }
                },
                {
                    label: 'Usuario LDAP',
                    icon: 'pi pi-user',
                    command: () =>{
                        this.show_site = false;
                        this.show_packet = false;
                        this.show_web = false;
                        this.show_db = false;
                        this.show_ldap = true;
                        this.show_save = false;
                    }
                },
                {
                    label: 'Guardar',
                    icon: 'pi pi-save',
                    command: () =>{
                        this.createTable();
                        this.show_site = false;
                        this.show_packet = false;
                        this.show_web = false;
                        this.show_db = false;
                        this.show_ldap = false;
                        this.show_save = true;
                    }
                }
            ]
        }
    },
    methods: {
        selectWebServer() {
            if(this.web_server.name === "Apache/PHP/Node.js"){
                this.show_php_node = true;
            }
            else {
                this.php_version = "";
                this.node = {};
                this.show_php_node = false;
            }
        },
        getPacket(){
            if (this.packet === null){
                this.selected_packet = false;
                this.packet = {}
            }
            else if(this.packet != {}){
                this.disk_space = this.packet.disk_space;
                this.db_space = this.packet.db_space;
                this.selected_packet = true;
            }
        },
        createTable(){
            var node = "Sí";
            if(!this.node) node = "No"
            this.table_data = [
                {'field': "Nombre", 'value': this.site_name},
                {'field': "Alias", 'value': this.alias},
                {'field': "Cliente", 'value': this.client},
                {'field': "Nombre del Titular", 'value': this.ldap_name},
                {'field': "Apellidos", 'value': this.ldap_last_name},
                {'field': "Correo", 'value': this.ldap_email},
                {'field': "Teléfono", 'value': this.ldap_phone},
                {'field': "Contraseña ldap", 'value': this.ldap_password},
                {'field': "Paquete Contratado", 'value': this.packet.name},
                {'field': "Espacio adicional disco", 'value': this.extra_disk_space+"MB"},
                {'field': "Espacio adicional bd", 'value': this.extra_db_space+"MB"},
                {'field': "Servidor Web", 'value': this.web_server.name},
                {'field': "Version php", 'value': this.php_version},
                {'field': "Node.js", 'value': node},
                {'field': "Plantilla", 'value': this.template.name},
                {'field': "Versión", 'value': this.template_version},
                {'field': "Servidor de Base de Datos", 'value': this.database_server.name},
                {'field': "Contraseña bd", 'value': this.database_password},
                {'field': "Ficheros Protegidos", 'value': this.protected_files},
                {'field': "Fichero Inicio", 'value': this.index},
                

            ]
        },
        submit(){
            axios.request({
                method: "post",
                url: '/epcommit',
                data: {
                    ldap_name: this.ldap_name,
                    ldap_last_name: this.ldap_last_name,
                    ldap_email: this.ldap_email,
                    ldap_phone: this.ldap_phone,
                    ldap_user: this.ldap_user,
                    client: this.client,
                    site_name: this.site_name,
                    alias: this.alias,
                    ldap_password: this.ldap_password,
                    packet: this.packet.id,
                    disk_space: this.disk_space,
                    extra_disk_space: this.extra_disk_space,
                    db_space: this.db_space,
                    extra_db_space: this.extra_db_space,
                    web_server: this.web_server.id,
                    php_version: this.php_version,
                    node: this.node,
                    template: this.template.id,
                    template_version: this.template_version,
                    database_server: this.database_server.id,
                    database_password: this.database_password,
                    protected_files: this.protected_files,
                    index: this.index
                }
            });
        },
    },
    computed: {
        validate() {
         return this.site_name !== "" &&
                this.template !== "" &&
                this.database_password !== "" &&
                this.index !== "" &&
                this.ldap_user !== "" &&
                this.ldap_name !== "" &&
                this.ldap_last_name !== "" &&
                this.ldap_email !== "" &&
                this.ldap_phone !== "" &&
                this.ldap_password !== "" &&
                this.packet !== null &&
                this.packet != "" &&
                this.disk_space !== "" &&
                this.db_space !== ""
        },
        packets() {
            if (this.client === "Natural"){
                return this.$store.getters.getNaturalPackets
            }
            else if (this.client === "Empresarial"){
                return this.$store.getters.getEnterprisePackets
            }
        },
        ...mapState(['web_server_options', 'templates', 'database_servers', 'client_types', 'php_options'])
    },
    mounted () {

        this.createTable();
    },
}
</script>

<style scoped>
    #container{
        background-color: lightgray;
        height: 90%;
    }
    
    .p-panelmenu{
        padding: 0px;
    }
    .box {
        height: 70vh;
        margin-left: 0.5rem;
        background-color: var(--surface-e);
        text-align: center;
        padding-top: 1rem;
        padding-bottom: 1rem;
        border-radius: 4px;
        box-shadow: 0 2px 1px -1px rgba(0,0,0,.2), 0 1px 1px 0 rgba(0,0,0,.14), 0 1px 3px 0 rgba(0,0,0,.12);
    }
    .tab {
        margin-left: 0.5rem;
        background-color: var(--surface-e);
        text-align: left;
        padding-top: 2rem;
        padding-bottom: 1rem;
        padding-left: 2rem;
        border-radius: 4px;
        box-shadow: 0 2px 1px -1px rgba(0,0,0,.2), 0 1px 1px 0 rgba(0,0,0,.14), 0 1px 3px 0 rgba(0,0,0,.12);
    }
    .form-container{
        padding: 1rem;
    }
    .submit-div{
        margin-left: 1.5rem;
    }
    label {
        width: 35%;
        text-align: end;
    }
</style>