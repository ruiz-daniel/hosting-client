<template>
  <div class="p-grid p-justify-center">
    <div class="p-col-10">
      <div class="p-grid">
        <div class="p-col-6 p-justify-center">
          <Card>
            <template #title>
              Registrar Nuevo Sitio
            </template>
            <template #content> </template>
            <template #footer>
              <Button icon="pi pi-check" label="Ir" @click="newSite()" />
            </template>
          </Card>
        </div>
        <div class="p-col-6 p-justify-center">
          <Card>
            <template #title>
              Ver Sitios
            </template>
            <template #content> </template>
            <template #footer>
              <Button icon="pi pi-check" label="Ir" @click="viewSites()" />
            </template>
          </Card>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  methods: {
    newSite() {
      this.$store.commit('SWITCH_EDIT', false)
      this.$router.push({ name: "Form" });
    },
    viewSites() {
      var store = this.$store
      var router = this.$router
        this.$root.api.getSites(function(data) {
          store.commit("SET_HOSTED_SITES", data);
          router.push({name: 'viewsites'})
        }) 
            
        
    },
  },
};
</script>

<style>
.p-card {
  box-shadow: 10px 10px rgb(199, 194, 194);
}
</style>
