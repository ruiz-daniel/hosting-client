<template>
  <div class="p-grid p-justify-center">
    <div class="p-col-10">
      <DataTable :value="table_data" :filters="filters">
        <template #header>
          <div class="table-header" style="text-align:center">
            Listado de usuarios
          </div>
          <span class="p-input-icon-left">
            <i class="pi pi-search" />
            <InputText
              v-model="filters['global']"
              placeholder="Búsqueda global"
            />
          </span>
        </template>
        <Column field="username" header="Nombre de usuario"> </Column>
        <Column field="role" header="Rol"> </Column>
        <Column field="" header="">
          <template #body="slotProps">
            <Button
              icon="pi pi-user-edit"
              hovertext="Editar usuario"
              v-on:click="modifyUser(slotProps.data)"
            />
            <Button
              icon="pi pi-trash"
              v-on:click="deleteUser(slotProps.data)"
            />
          </template>
        </Column>
      </DataTable>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      table_data: this.$store.state.users_list,
      filters: {},
    };
  },
  methods: {
    modifyUser(user) {
      this.$store.commit("SET_SELECTED_USER", user)
      this.$router.push({name:'edituser'})
    },
    deleteUser(user) {
      var root = this.$root;
      var store = this.$store;
      var update = this.updateTableData; // doing this with a method due to vue not allowing to call a local variable from within a function parameter
      this.$root.api.deleteUser(function() {
        root.api.getUsers(function(data) {
          store.commit("SET_USERS_LIST", data);
          update();
        });
      }, user);
    },
    updateTableData() {
      this.table_data = this.$store.state.users_list;
    },
  },
};
</script>

<style></style>
