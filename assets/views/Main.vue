<template>
  <div class="p-grid">
    <div class="p-col-9 p-ml-3">
      <div class="p-grid">
        <div class="p-col-7 p-justify-center p-mr-3 p-mt-2">
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
        <div v-if="$store.state.user_data.role === 'Especialista'" class="p-col-7 p-justify-center p-mt-3">
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
      this.$store.commit('SWITCH_EDIT', false) //remove the edit flag to go as a new site
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
.p-card:hover {
  box-shadow: 10px 10px rgb(199, 194, 194);
}
</style>
