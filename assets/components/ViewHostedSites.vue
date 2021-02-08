<template>
  <div class="p-grid p-justify-center">
    <div class="p-col-10">
      <DataTable :value="table_data">
        <template #header>
          <div class="table-header">
            Sitios Hospedados
          </div>
        </template>
        <Column field="site_name" header="Sitio">
          
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
import axios from 'axios'
export default {
    data() {
        return {
            table_data: []
        }
    },
    methods: {
      getSitesNames(){
        this.table_data.forEach(element=> {
          axios.request({
            method: "post",
            url: '/epsitename',
            data: {
                'site': element.id
            }
          }).then(response => {
              element.site_name = response.data
          })
        })
        
      }
    },
    created(){
      this.$store.state.hosted_sites.forEach(element => {
        this.table_data.push({
          'id': element.site,
          'site_name': ""
        });
      });
      this.getSitesNames()
    }
};
</script>

<style></style>
