<template>
  <div class="p-grid p-justify-center">
    <div class="p-col-10">
      <DataTable :value="table_data">
        <template #header>
          <div class="table-header" style="text-align:center">
            Sitios Hospedados
          </div>
        </template>
        <Column field="site_name" header="Nombre del sitio">
          
        </Column>
        <Column field="alias" header="Alias">
          
        </Column>
        <Column field="client_name" header="Cliente">
          
        </Column>
        <Column field="" header="">
          <template #body="slotProps">
            <Button icon="pi pi-eye" v-on:click="viewDetails(slotProps.data)"/>
            <Button icon="pi pi-pencil" v-on:click="modifySite(slotProps.data.id)"/>
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
            table_data: []
        }
    },
    methods: {
      viewDetails(site) {
        this.$root.api.getSiteData(function(data){
          this.$store.commit('SET_SELECTED_SITE', data)
        }, site)
      }
    },
    created(){
      this.table_data = this.$store.state.hosted_sites;
    }
};
</script>

<style></style>
