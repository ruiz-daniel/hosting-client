<template>
  <div class="p-grid p-justify-center">
    <div class="p-col-10">
      <DataTable :value="table_data" :filters="filters">
        <template #header>
          <div class="table-header" style="text-align:center">
            Sitios Hospedados
          </div>
          <span class="p-input-icon-left">
                <i class="pi pi-search" />
                <InputText v-model="filters['global']" placeholder="Búsqueda global" />
            </span>
        </template>
        <Column field="site_name" header="Nombre del sitio">
          
        </Column>
        <Column field="alias" header="Alias">
          
        </Column>
        <Column field="client_name" header="Cliente">
          
        </Column>
        <Column field="hosted" header="Orden de hosting">
          
        </Column>
        <Column field="" header="">
          <template #body="slotProps">
            <Button icon="pi pi-eye" v-on:click="viewDetails(slotProps.data)"/>
            <Button icon="pi pi-pencil" v-on:click="modifySite(slotProps.data)"/>
            <Button icon="pi pi-trash" v-on:click="deleteSite(slotProps.data)"/>
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
            table_data: this.$store.state.hosted_sites,
            filters: {}
        }
    },
    methods: {
      viewDetails(site) {
        var store = this.$store;
        var router = this.$router;
        this.$root.api.getSiteData(function(response_data) {
          store.commit('SET_SELECTED_SITE', response_data);
          router.push({name: 'sitedata'})
        }, site)
      },
      modifySite(site) {
        var store = this.$store;
        var router = this.$router;
        this.$root.api.getSiteData(function(response_data) {
          store.commit('SET_SELECTED_SITE', response_data);
          store.commit('SWITCH_EDIT', true)
          router.push({name: 'Form'})
        }, site)
      },
      deleteSite(site) {
        var root = this.$root
        var store = this.$store
        var update = this.updateTableData;
        this.$root.api.deleteSite(function(){
          root.api.getSites(function(data) {
          store.commit("SET_HOSTED_SITES", data);
          update()
        }) 
        }, site)
      },
      updateTableData(){
        this.table_data = this.$store.state.hosted_sites
      }
    },
    mounted(){
      this.table_data.forEach(element=>{
        if (element.hosted == true) element.hosted = "Completada";
        else if (element.hosted == false) element.hosted = "Pendiente";
      })
    }
};
</script>

<style></style>
