<template>
  <div class="p-grid p-justify-center" style="margin-top:2%; height: 100vh">
    <div class="p-shadow-14 p-col-6" style="text-align:center" id="container">
      <h1>Datos del Sitio</h1>
      <form method="POST">
        <div class="p-grid form-container">
          <div class="p-col-4 box">
            <PanelMenu :model="menu_items"></PanelMenu>
          </div>
          <div class="p-col-7 tab" v-show="show_site">
            <div class="p-field">
              <label for="site_name">Nombre del Sitio</label>
              <InputText
                id="site_name"
                type="text"
                v-model="site_name"
                placeholder="ej: www.nombresitio.nat.cu"
              />
            </div>
            <div class="p-field">
              <label for="alias">Alias (si existe)</label>
              <InputText id="alias" type="text" v-model="alias" />
            </div>
            <div class="p-field">
              <label for="client">Cliente</label>
              <Dropdown
                id="client"
                :options="client_types"
                v-model="client"
                v-on:change="
                  packet = null;
                  getPacket();
                "
              />
            </div>
            <div v-if="client == 'Empresarial'" class="p-field">
              <label for="ips">IPs arrendadas</label>
              <InputText id="ips" type="text" v-model="IPs" />
            </div>
            <div class="p-field">
              <label for="client_name">Nombre</label>
              <InputText
                id="client_name"
                type="text"
                name="client_name"
                v-model="client_name"
              />
            </div>
            <div class="p-field">
              <label for="client_last_name">Apellidos</label>
              <InputText
                id="client_last_name"
                type="text"
                name="client_last_name"
                v-model="client_last_name"
              />
            </div>
            <div class="p-field">
              <label for="client_email">Correo</label>
              <InputText
                id="client_email"
                type="text"
                name="client_email"
                v-model="client_email"
              />
            </div>
            <div class="p-field">
              <label for="client_phone">Teléfono</label>
              <InputText
                id="client_phone"
                type="number"
                name="client_phone"
                v-model="client_phone"
              />
            </div>
          </div>

          <div class="p-col-7 tab" v-show="show_packet">
            <div class="p-field" style="text-align:center; margin-bottom:2rem">
              <label for="packet">Paquete contratado</label>
              <Dropdown
                id="packet"
                :options="packets"
                optionLabel="name"
                v-model="packet"
                showClear
                style="width:50%"
                v-on:change="getPacket()"
              />
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
                <InputNumber
                  id="extra_disk_space"
                  v-model="extra_disk_space"
                  showButtons
                  :step="100"
                  :min="0"
                />
              </div>
              <div class="p-col-6">
                <label for="extra_db_space"
                  >Espacio adicional en Base de Datos</label
                >
                <InputNumber
                  id="extra_db_space"
                  v-model="extra_db_space"
                  showButtons
                  :step="100"
                  :min="0"
                />
              </div>
            </div>
          </div>
          <div class="p-col-7 tab" v-show="show_web">
            <div class="p-field">
              <label for="web_server">Servidor Web</label>
              <Dropdown
                id="web_server"
                :options="web_server_options"
                optionLabel="name"
                v-model="web_server"
                v-on:change="selectWebServer()"
              />
              <div
                class="p-field"
                v-if="show_php_node"
                style="margin-top:0.5rem"
              >
                <label for="php_version">Versión php</label>
                <Dropdown
                  :options="php_options"
                  v-model="php_version"
                  id="php_version"
                />
              </div>
              <div
                class="p-field-checkbox"
                v-if="show_php_node"
                style="margin-top:0.5rem"
              >
                <label for="node" style="padding-right:0.5rem">NodeJS</label>
                <Checkbox id="node" v-model="node" :binary="true" />
              </div>
              <div class="p-field">
                <label for="database_server">Servidor de Base de Datos</label>
                <Dropdown
                  id="database_server"
                  :options="database_servers"
                  optionLabel="name"
                  v-model="database_server"
                />
              </div>
              <div class="p-field">
                <label for="database_name">Nombre base de datos</label>
                <InputText
                  id="database_name"
                  type="text"
                  v-model="database_name"
                />
              </div>
              <div class="p-field">
                <label for="database_user">Usuario base de datos</label>
                <InputText
                  id="database_user"
                  type="text"
                  v-model="database_user"
                />
              </div>
              <div class="p-field">
                <label for="database_password">Contraseña base de datos</label>
                <InputText
                  id="database_password"
                  type="password"
                  v-model="database_password"
                />
              </div>
            </div>
          </div>

          <div class="p-col-7 tab" v-show="show_db">
            <div class="p-field">
              <label for="template">Plantilla</label>
              <Dropdown
                id="web_server"
                :options="templates"
                optionLabel="name"
                v-model="template"
              />
            </div>
            <div class="p-field">
              <label for="template_version">Versión de la plantilla</label>
              <InputText
                id="template_version"
                type="text"
                name="template_version"
                v-model="template_version"
              />
            </div>
            <div class="p-field">
              <label for="protected_files">Ficheros Protegidos</label>
              <InputText
                id="protected_files"
                type="text"
                v-model="protected_files"
                placeholder="si existen"
              />
            </div>
            <div class="p-field">
              <label for="index">Fichero de Inicio</label>
              <InputText id="index" type="text" v-model="index" />
            </div>
          </div>

          <div class="p-col-7 tab" v-show="show_ldap">
            <div v-if="!$store.state.edit_switch"></div>
            <div class="p-field">
              <label for="ldap_user">Usuario</label>
              <InputText
                id="ldap_user"
                type="text"
                name="ldap_user"
                v-model="ldap_user"
              />
            </div>
            <div class="p-field">
              <label for="ldap_password">Contraseña</label>
              <InputText
                id="ldap_password"
                type="password"
                name="ldap_password"
                v-model="ldap_password"
              />
            </div>
            <div>
              <Button
                label="Añadir usuario"
                v-on:click="addLdapUser(ldap_user, ldap_password)"
              />
            </div>
            <div>
              <DataTable :value="ldap_users" :autoLayout="true" editMode="cell">
                <template #header>
                  <div class="table-header" style="text-align:center">
                    Usuarios
                  </div>
                </template>
                <Column field="ldap_user" header="usuario">
                  <template #body="slotProps">
                    <InputText type="text" v-model="slotProps.data.ldap_user" />
                  </template>
                </Column>
                <Column field="ldap_password" header="contraseña">
                  <template #body="slotProps">
                    <InputText
                      type="text"
                      v-model="slotProps.data.ldap_password"
                      style="width:auto"
                    />
                  </template>
                </Column>
                <Column field="" header="">
                  <template #body="slotProps">
                    <Button
                      icon="pi pi-trash"
                      v-on:click="removeLdapUser(slotProps.data)"
                      style="width:auto"
                    />
                  </template>
                </Column>
              </DataTable>
            </div>
          </div>

          <div class="p-col-7 tab" v-show="show_save">
            <div class="p-col-11" style="text-align:center">
              <Message
                severity="error"
                :closable="false"
                v-if="!validateSiteName"
                >Falta el nombre del sitio</Message
              >
              <Message
                severity="error"
                :closable="false"
                v-if="!validateClientData"
                >Faltan datos del cliente</Message
              >
              <Message
                severity="error"
                :closable="false"
                v-if="!validateIPs"
                >Especifique IPs arrendadas</Message
              >
              <Message
                severity="error"
                :closable="false"
                v-if="!selected_packet"
                >Seleccione un paquete</Message
              >
              <Message
                severity="error"
                :closable="false"
                v-if="!validateWebServer"
                >Seleccione un servidor web</Message
              >
              <Message
                severity="error"
                :closable="false"
                v-if="!validatePhpVersion"
                >Especifique versión de php</Message
              >
              <Message
                severity="error"
                :closable="false"
                v-if="!validateDatabaseData"
                >Faltan datos de nombre y usuario de base de datos</Message
              >
              <Message
                severity="error"
                :closable="false"
                v-if="!validateTemplate"
                >Seleccione una plantilla y versión</Message
              >
              <Message
                severity="error"
                :closable="false"
                v-if="!ldap_users.length > 0"
                >Inserte al menos un usuario LDAP</Message
              >
              <Message
                severity="success"
                :closable="false"
                v-if="validate"
                >Los Datos son correctos</Message
              >
              <div class="submit-div p-col-11">
              <Button
                label="Guardar"
                v-if="validate"
                v-on:click="submit()"
                style="float: right"
              />
            </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  data() {
    return {
      show_site: true,
      show_packet: false,
      show_web: false,
      show_db: false,
      show_ldap: false,
      show_save: false,

      site_name: "www.",
      alias: "",
      client: "Natural",
      IPs: "",

      web_server: { id: 1, name: "Apache/PHP/Node.js" },
      show_php_node: true,
      php_version: "",
      node: false,

      template: "",
      template_version: "",

      database_name: "db",
      database_user: "dbo",
      database_server: {id: null, name: ""},
      database_password: "",

      protected_files: "",
      index: "index.html",

      client_name: "",
      ldap_user: "ftp",
      client_last_name: "",
      client_email: "",
      client_phone: "",
      ldap_password: "",

      ldap_users: [],

      packet: "",
      selected_packet: false,
      disk_space: "",
      extra_disk_space: 0,
      db_space: "",
      extra_db_space: 0,

      table_data: [],

      site_id: "",
      hosted: false,
      editingLdapUser: false,

      menu_items: [
        {
          label: "Sitio y Cliente",
          icon: "pi pi-file",
          command: () => {
            this.show_site = true;
            this.show_packet = false;
            this.show_web = false;
            this.show_db = false;
            this.show_ldap = false;
            this.show_save = false;
          },
        },
        {
          label: "Cuota",
          icon: "pi pi-cloud",
          command: () => {
            this.show_site = false;
            this.show_packet = true;
            this.show_web = false;
            this.show_db = false;
            this.show_ldap = false;
            this.show_save = false;
          },
        },
        {
          label: "Servidor Web y BD",
          icon: "pi pi-globe",
          command: () => {
            this.show_site = false;
            this.show_packet = false;
            this.show_web = true;
            this.show_db = false;
            this.show_ldap = false;
            this.show_save = false;
          },
        },
        {
          label: "Plantilla y Ficheros",
          icon: "pi pi-folder-open",
          command: () => {
            this.show_site = false;
            this.show_packet = false;
            this.show_web = false;
            this.show_db = true;
            this.show_ldap = false;
            this.show_save = false;
          },
        },
        {
          label: "Usuario LDAP",
          icon: "pi pi-user",
          command: () => {
            this.show_site = false;
            this.show_packet = false;
            this.show_web = false;
            this.show_db = false;
            this.show_ldap = true;
            this.show_save = false;
          },
        },
        {
          label: "Guardar",
          icon: "pi pi-save",
          command: () => {
            this.show_site = false;
            this.show_packet = false;
            this.show_web = false;
            this.show_db = false;
            this.show_ldap = false;
            this.show_save = true;
          },
        },
      ],
    };
  },
  methods: {
    selectWebServer() {
      if (this.web_server.name === "Apache/PHP/Node.js") {
        this.node = false;
        this.show_php_node = true;
      } else {
        this.php_version = "";
        this.node = false;
        this.show_php_node = false;
      }
    },
    getPacket() {
      if (this.packet === null) {
        this.selected_packet = false;
        this.packet = "";
      } else if (this.packet != "") {
        this.disk_space = this.packet.disk_space;
        this.db_space = this.packet.db_space;
        this.selected_packet = true;
      }
    },
    addLdapUser(username, password) {
      if (username !== "" && password !== "") {
        this.ldap_users.push({
          ldap_user: username,
          ldap_password: password,
        });
        this.ldap_user = "ftp" + this.ldap_users.length.toString();
        this.ldap_password = "";
      }
    },
    removeLdapUser(user) {
      for (let i = 0; i < this.ldap_users.length; i++) {
        if (this.ldap_users[i] === user) {
          this.ldap_users.splice(i, 1);
        }
      }
    },
    submit() {
      var toast = this.$toast;
      if (!this.$store.state.edit_switch) {
        this.$root.api.registerNewSite(function() {
          toast.add({severity:'success', detail:'El sitio se ha guardado con éxito', life: 3000});
        }, {
          ldap_users: this.ldap_users,
          client_type: this.client,
          client_name: this.client_name,
          client_last_name: this.client_last_name,
          client_email: this.client_email,
          client_phone: this.client_phone,
          site_name: this.site_name,
          alias: this.alias,
          packet: this.packet.id,
          extra_disk_space: this.extra_disk_space,
          extra_db_space: this.extra_db_space,
          web_server: this.web_server.id,
          php_version: this.php_version,
          node: this.node,
          template: this.template.id,
          template_version: this.template_version,
          database_server: this.database_server.id,
          database_password: this.database_password,
          database_name: this.database_name,
          database_user: this.database_user,
          protected_dir: this.protected_files,
          index: this.index,
          IPs: this.IPs
        });
      } else {
        this.$root.api.updateSite(function() {
          toast.add({severity:'success', detail:'El sitio se ha actualizado con éxito', life: 3000});
        }, {
          id: this.site_id,
          ldap_users: this.ldap_users,
          client_type: this.client,
          client_name: this.client_name,
          client_last_name: this.client_last_name,
          client_email: this.client_email,
          client_phone: this.client_phone,
          site_name: this.site_name,
          alias: this.alias,
          packet: this.packet.id,
          extra_disk_space: this.extra_disk_space,
          extra_db_space: this.extra_db_space,
          web_server: this.web_server.id,
          php_version: this.php_version,
          node: this.node,
          template: this.template.id,
          template_version: this.template_version,
          database_server: this.database_server.id,
          database_password: this.database_password,
          database_name: this.database_name,
          database_user: this.database_user,
          protected_dir: this.protected_files,
          index: this.index,
          hosted: this.hosted,
          IPs: this.IPs
        });
      }
    },
  },
  computed: {
    validate() {
      return (
        this.validateSiteName &&
        this.validateClientData &&
        this.validateWebServer &&
        this.validatePhpVersion !== "" &&
        this.ldap_users.length > 0 &&
        this.selected_packet &&
        this.validateTemplate &&
        this.validateDatabaseData
      );
    },
    validateSiteName() {
      return this.site_name != "" && this.site_name != "www.";
    },
    validateClientData() {
      return (
        this.client_name != "" &&
        this.client_last_name != "" &&
        this.client_email != "" &&
        this.client_phone != ""
      );
    },
    validateWebServer() {
      return this.web_server != "" && this.web_server != null;
    },
    validatePhpVersion() {
      return (
        (this.show_php_node && this.php_version != "") || !this.show_php_node
      );
    },
    validateDatabaseData() {
      return (
        this.database_server.name != "" &&
        this.database_name != "" &&
        this.database_name != "db" &&
        this.database_user != "" &&
        this.database_user != "dbo"  &&
        this.database_password != ""
      ) || (this.database_server.name == "" || this.database_server == null) || (this.database_server.id == 0);
    },
    validateTemplate() {
      return this.template != "" && this.template != null
    },
    validateIPs() {
      return (this.client == "Empresarial" && this.IPs != "") || this.client == "Natural"
    },
    packets() {
      if (this.client === "Natural") {
        return this.$store.getters.getNaturalPackets;
      } else if (this.client === "Empresarial") {
        return this.$store.getters.getEnterprisePackets;
      }
    },
    ...mapState([
      "web_server_options",
      "templates",
      "database_servers",
      "client_types",
      "php_options",
    ]),
  },
  mounted() {
    if (this.$store.state.edit_switch) {
      let site = this.$store.state.selected_site;
      this.site_id = site.id;
      this.site_name = site.site_name;
      this.alias = site.alias;
      this.client = site.client_type;
      (this.client_name = site.client_name),
        (this.client_last_name = site.client_last_name),
        (this.client_email = site.client_email),
        (this.client_phone = site.client_phone),
        (this.packet = this.$store.getters.getPacketByNameAndClient(
          site.packet,
          site.client_type
        ));
      this.getPacket();
      this.extra_disk_space = site.extra_disk_space;
      this.extra_db_space = site.extra_db_space;
      this.web_server = this.$store.getters.getWebServerByName(site.web_server);
      this.selectWebServer();
      this.php_version = site.php_version;
      this.node = site.node;
      this.database_server = this.$store.getters.getDatabaseServerByName(
        site.db_server
      );
      this.database_name = site.db_name;
      this.database_user = site.db_user;
      this.database_password = site.db_password;
      this.template = this.$store.getters.getTemplateByName(site.template);
      this.template_version = site.template_version;
      this.hosted = site.hosted;
      this.IPs = site.IPs;
      for (let i = 0; i < site.ldap_users.length; i++) {
        this.addLdapUser(site.ldap_users[i], site.ldap_passwords[i]);
      }
    }
  },
};
</script>

<style scoped>
#container {
  background-color: lightgray;
  height: 85%;
}

.p-panelmenu {
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
  box-shadow: 0 2px 1px -1px rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.14),
    0 1px 3px 0 rgba(0, 0, 0, 0.12);
}
.tab {
  margin-left: 0.5rem;
  background-color: var(--surface-e);
  text-align: left;
  padding-top: 2rem;
  padding-bottom: 1rem;
  padding-left: 2rem;
  border-radius: 4px;
  box-shadow: 0 2px 1px -1px rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.14),
    0 1px 3px 0 rgba(0, 0, 0, 0.12);
}
.form-container {
  padding: 1rem;
}
.submit-div {
  margin-left: 1.5rem;
}
label {
  width: 35%;
  text-align: end;
}
.p-dropdown {
  width: 189px;
}
</style>
