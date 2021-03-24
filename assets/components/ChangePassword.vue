<template>
  <div class="p-grid p-ml-2 p-justify-center">
    <div class="p-col-4 p-mt-2 p-shadow-6 container">
      <div style="text-align:center" class="header-div">
        <h3>Cambiar Contraseña</h3>
      </div>

      <div class="p-field" v-on:keyup.enter="change()">
        <label for="old_password">Contraseña actual</label>
        <InputText id="old_password" type="password" v-model="old_password" />
      </div>
      <div class="p-field" v-on:keyup.enter="change()">
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
      <div class="p-field" v-on:keyup.enter="change()">
        <label for="confirm_password">Confirmar Contraseña</label>
        <InputText
          id="confirm_password"
          type="password"
          v-model="confirm_password"
        />
        <br />
        <small
          v-show="!validatePasswords"
          id="confirm_invalid"
          class="p-invalid"
          >Las contraseñas no coinciden</small
        >
      </div>
      <div class="p-grid" style="text-align:end">
        <div class="p-col-3">
          <Button v-show="validatePasswords" class="p-ml-2" label="Guardar" v-on:click="change()" />
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
      var toast = this.$toast;
      if (this.validatePasswords) {
        this.$root.api.changePassword(
          function(response) {
            if (response === true) {
              toast.add({
                severity: "success",
                detail: "Se ha cambiado su contraseña",
                life: 3000,
              });
            } else if (response == "incorrect password") {
              toast.add({
                severity: "error",
                detail: "Contraseña actual incorrecta",
                life: 3000,
              });
            } else {
              toast.add({
                severity: "error",
                detail: "Ha ocurrido un error al cambiar su contraseña",
                life: 3000,
              });
            }
          },
          {
            username: this.username,
            old_password: this.old_password,
            password: this.password,
          }
        );
      }
    },
  },
  mounted() {
    if (this.$store.state.user_data.username == null) {
      this.username = sessionStorage.getItem("username");
    } else {
      this.username = this.$store.state.user_data.username;
    }
  },
  computed: {
    validatePasswords() {
      return this.confirm_password === this.password;
    },
  },
};
</script>

<style scoped>
label {
  width: 150px;
  text-align: end;
}
.container {
  width: 400px;
}
small {
  margin-left: 150px;
}
</style>
