<template>
  <div class="p-grid p-ml-2 p-justify-center">
    <div class="p-col-4 p-mt-2 p-shadow-6 container">
      <div style="text-align:center" class="header-div">
        <h3>Cambiar Nombre de Usuario</h3>
      </div>

      <div class="p-field" v-on:keyup.enter="change()">
        <label for="username">Nombre de usuario</label>
        <InputText id="username" type="text" v-model="username" />
        <br>
        <small
          v-show="!validateUsername"
          class="p-invalid"
          >Usuario no valido</small
        >
      </div>
      <div class="p-field" v-on:keyup.enter="change()">
        <label for="password">Contraseña actual</label>
        <InputText
          id="password"
          type="password"
          v-model="password"
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
      password: "",
      usernames: []
    };
  },
  methods: {
    change() {
      var toast = this.$toast
      var store = this.$store
      var router = this.$router
      var username = this.username
      this.$root.api.changeUsername(function(response) {
        if (response === true) {
          toast.add({severity:'success', detail:'Se ha cambiado su nombre de usuario', life: 3000});
          store.commit("SET_USER_DATA", {username: username, role: store.state.user_data.role});
            router.push({ name: "main" });
            sessionStorage.setItem("username", username);
        }
        else if (response == "incorrect password") {
          toast.add({severity:'error', detail:'Contraseña incorrecta', life: 3000});
        }
        else {
          toast.add({severity:'error', detail:'Ha ocurrido un error al cambiar su contraseña', life: 3000});
        }
      }, {
        old_username: this.$store.state.user_data.username,
        username: this.username,
        password: this.password,
      });
    },
    fillUsernames(usernames) {
      this.usernames = usernames
    }
  },
  mounted() {
    var fill = this.fillUsernames
    this.$root.api.getUsernames(function(data){
      fill(data)
    })
  },
  computed: {
    validateUsername() {
      return !this.usernames.includes(this.username)
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
