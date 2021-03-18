<template>
  <div class="p-grid p-ml-2">
    <div class="p-col-4 p-mt-2 p-shadow-6">
      <div style="text-align:center">
        <h3>Cambiar Contraseña</h3>
      </div>

      <div class="p-field">
        <label for="old_password">Contraseña actual</label>
        <InputText id="old_password" type="password" v-model="old_password" />
      </div>
      <div class="p-field">
        <label for="password">Nueva Contraseña</label>
        <Password
          id="password"
          v-model="password"
          promptLabel=""
          weakLabel="Débil"
          mediumLabel="Media"
          strongLabel="Fuerte"
        />
      </div>
      <div class="p-field">
        <label for="confirm_password">Confirmar Contraseña</label>
        <InputText
          id="confirm_password"
          type="password"
          aria-describedby="confirm_invalid"
          v-model="confirm_password"
        />
        <small
          v-show="!validatePasswords"
          id="confirm_invalid"
          class="p-invalid"
          >Las contraseñas no coinciden</small
        >
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
          <Button class="p-ml-2" label="Guardar" v-on:click="change()" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      username: "",
      old_password: "",
      password: "",
      confirm_password: "",
    };
  },
  methods: {
    change() {
      this.$root.api.changePassword(function() {}, {
        old_password: this.old_password,
        password: this.password,
      });
    },
  },
  mounted() {
    this.user_id = this.$store.state.user_data.username;
  },
  computed: {
    validatePasswords() {
      return this.old_password === this.password;
    },
  },
};
</script>

<style></style>
