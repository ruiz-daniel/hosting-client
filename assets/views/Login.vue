<template>
  <div class="p-grid p-justify-center p-mt-4" v-on:keyup.enter="login()">
    <div class="p-col-3 p-shadow-10" style="text-align: center">
      <h2>Inicio de sesión</h2>
      <div class="p-field">
        <label for="username">Usuario</label>
        <InputText id="username" type="text" v-model="username" />
      </div>
      <div class="p-field">
        <label for="password">Contraseña</label>
        <InputText id="password" type="password" v-model="password" />
      </div>
      <div class="p-field">
        <Button label="Entrar" v-on:click="login()" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            username: "",
            password: ""
        }
    },
    methods: {
        login() {
            var store = this.$store;
            var router = this.$router;
            var toast = this.$toast;
            this.$root.api.login(function(data) {
                if(data != 'incorrect') {
                    store.commit("SET_USER_DATA", data)
                    router.push({name:'main'})
                } else {
                  toast.add({severity:'error', detail:'Usuario o contraseña incorrectos', life: 3000});
                }
        }, {'username': this.username, 'password':this.password})
        }
    },
};
</script>

<style scoped>
label {
    width: 80px;
    text-align: end;
}
</style>
