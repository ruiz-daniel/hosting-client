<template>
  <div class="sidebar">
    <div class="logo">
      <h2> <span class="pi pi-cog"></span> Menú</h2>
    </div>
    <div>
      <PanelMenu
        v-if="$store.state.user_data.role == 'Especialista'"
        :model="items_specialist"
      ></PanelMenu>
      <PanelMenu
        v-if="$store.state.user_data.role == 'Cliente'"
        :model="items_client"
      ></PanelMenu>
      <PanelMenu
        v-if="$store.state.user_data.role == 'Administrador'"
        :model="items_admin"
      ></PanelMenu>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items_specialist: [
        {
          label: "Nuevo sitio",
          icon: "pi pi-globe",
          command: () => {
            this.$store.commit("SWITCH_EDIT", false); //remove the edit flag to go as a new site
            this.$router.push({ name: "Form" });
          },
        },
        {
          label: "Ver sitios hospedados",
          icon: "pi pi-users",
          command: () => {
            var store = this.$store;
            var router = this.$router;
            if (store.state.user_data.role == "Especialista") {
              this.$root.api.getSites(function(data) {
                store.commit("SET_HOSTED_SITES", data);
                router.push({ name: "viewsites" });
              });
            }
          },
        },
        {
          label: "Cambiar Nombre de Usuario",
          icon: "pi pi-user",
          command: () => {
            this.$router.push({name: 'changeusername'})
          }
        },
        {
          label: "Cambiar contraseña",
          icon: "pi pi-key",
          command: () => {
            this.$router.push({name:'changepassword'})
          }
        },
        {
          label: "Salir",
          icon: "pi pi-sign-out",
          command: () => {
            this.$store.commit("SET_USER_DATA", "no user");
            this.$router.push({ name: "index" });
          },
        },
      ],
      items_client: [
        {
          label: "Nuevo sitio",
          icon: "pi pi-globe",
          command: () => {
            this.$store.commit("SWITCH_EDIT", false); //remove the edit flag to go as a new site
            this.$router.push({ name: "Form" });
          },
        },
        {
          label: "Cambiar Nombre de Usuario",
          icon: "pi pi-user",
          command: () => {
            this.$router.push({name: 'changeusername'})
          }
        },
        {
          label: "Cambiar contraseña",
          icon: "pi pi-key",
          command: () => {
            this.$router.push({name:'changepassword'})
          }
        },
        {
          label: "Salir",
          icon: "pi pi-sign-out",
          command: () => {
            this.$store.commit("SET_USER_DATA", "no user");
            this.$router.push({ name: "index" });
          },
        },
      ],
      items_admin: [
        {
          label: "Ver usuarios",
          icon: "pi pi-users",
          command: () => {
            var store = this.$store;
            var router = this.$router;
            var root = this.$root;
            if (store.state.user_data.role == "Administrador") {
              root.api.getUsers(function(data) {
                store.commit("SET_USERS_LIST", data);
                root.api.getUserRoles(function(data) {
                  store.commit("SET_USER_ROLES", data);
                  router.push({ name: "manageusers" });
                });
              });
            }
          },
        },
        {
          label: "Crear usuario",
          icon: "pi pi-user-plus",
          command: () => {
            var store = this.$store;
            var router = this.$router;
            this.$root.api.getUserRoles(function(data) {
              store.commit("SET_USER_ROLES", data);
              router.push({ name: "insertuser" });
            });
          },
        },
        {
          label: "Cambiar Nombre de Usuario",
          icon: "pi pi-user",
          command: () => {
            this.$router.push({name: 'changeusername'})
          }
        },
        {
          label: "Cambiar contraseña",
          icon: "pi pi-key",
          command: () => {
            this.$router.push({name:'changepassword'})
          }
        },
        {
          label: "Salir",
          icon: "pi pi-sign-out",
          command: () => {
            this.$store.commit("SET_USER_DATA", "no user");
            this.$router.push({ name: "index" });
          },
        },
      ],
    };
  },
};
</script>

<style scoped>
.sidebar {
  height: 88vh;
  z-index: 999;
  overflow-y: auto;
  user-select: none;
  box-shadow: 10px 0 20px 0 rgba(0, 0, 0, 0.16);
  /* background-color: #0786e0; */
  background: linear-gradient(180deg, #eeeff0 0, #ced4d8);
}
.logo {
  text-align: center;
  color: #0786e0
}
.p-panelmenu .p-panelmenu-panel{
  margin-bottom: 0;
}
</style>
