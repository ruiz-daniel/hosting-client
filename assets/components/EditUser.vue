<template>
  <div class="p-grid p-ml-2" v-on:keyup.enter="update()">
    <div class="p-col-4 p-mt-2 p-shadow-6">
      <div style="text-align:center">
        <h3>Datos del usuario</h3>
      </div>

      <div class="p-field">
        <label for="username">Usuario</label>
        <InputText id="username" type="text" v-model="username" />
      </div>

      <div class="p-field">
        <label for="role">Rol</label>
        <Dropdown
          :options="$store.state.roles"
          optionLabel="name"
          v-model="role"
        />
      </div>
      <div class="p-grid" style="text-align:end">
        <div class="p-col-3">
          <Button class="p-ml-2" label="Guardar" v-on:click="update()" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      id: "",
      username: "",
      role: "",
    };
  },
  methods: {
    update() {
      var toast = this.$toast;
      if (this.validate) {
        this.$root.api.updateUser(
          function(response) {
            if (response) {
              toast.add({
                severity: "success",
                detail: "El usuario se ha actualizado",
                life: 3000,
              });
            } else {
              toast.add({
                severity: "error",
                detail: "Ha ocurrido un error al actualizar el usuario",
                life: 3000,
              });
            }
          },
          {
            id: this.id,
            username: this.username,
            role: this.role.id,
          }
        );
      } else {
        toast.add({
          severity: "error",
          detail: "Campos vacíos",
          life: 3000,
        });
      }
    },
  },
  computed: {
    validate() {
      return this.username != "" && this.role != "";
    },
  },
  mounted () {
    this.id = this.$store.state.selected_user.id;
    this.username = this.$store.state.selected_user.username;
    this.role = this.$store.getters.getRoleByName(this.$store.state.selected_user.role);
  },
};
</script>

<style scoped>
label {
  width: 150px;
  text-align: end;
}
</style>
