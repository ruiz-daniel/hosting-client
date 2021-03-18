<template>
  <div class="p-grid p-ml-2">
    <div class="p-col-4 p-mt-2 p-shadow-6">
      <div style="text-align:center">
        <h3>Datos del usuario</h3>
      </div>

      <div class="p-field">
        <label for="username">Usuario</label>
        <InputText id="username" type="text" v-model="username" />
      </div>
      <div class="p-field">
        <label for="password">Contraseña</label>
        <Password id="password" v-model="password" promptLabel="" weakLabel="Débil" mediumLabel="Media" strongLabel="Fuerte" />
      </div>
      <div class="p-field">
        
        <label for="confirm_password">Confirmar Contraseña</label>
        <InputText
          id="confirm_password"
          type="password"
          aria-describedby="confirm_invalid"
          v-model="confirm_password"
        />
        <small v-show="!validatePasswords" id="confirm_invalid" class="p-invalid">Las contraseñas no coinciden</small>
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
              <Button class="p-ml-2" label="Guardar" v-on:click="submit()" />
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
      confirm_password: "",
      role: "",
    };
  },
  methods: {
    submit() {
        var toast = this.$toast
        if(this.validate) {
            this.$root.api.addUser(function(response){
                if(response){
                    toast.add({severity:'success', detail:'El usuario se ha insertado', life: 3000});
                } else{
                    toast.add({severity:'error', detail:'Ha ocurrido un error al insertar el usuario', life: 3000});
                }
            }, {
                'username': this.username,
                'password': this.password,
                'role': this.role.id
            })
        }
        else if (!this.validatePasswords) {
            toast.add({severity:'error', detail:'Las contraseñas no coinciden', life: 3000});
        }
    },
  },
  computed: {
      validate() {
          return this.username != "" && this.password != "" && this.confirm_password != "" && this.role != "" && this.validatePasswords
      },
      validatePasswords() {
          return this.password === this.confirm_password
      }
  },
};
</script>

<style scoped>
label {
  width: 150px;
  text-align: end;
}
</style>
