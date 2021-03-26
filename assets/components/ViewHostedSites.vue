<template>
  <div class="p-grid p-justify-center">
    <Dialog
      header="Inserte su contraseña"
      :visible.sync="askPassword"
      :style="{ width: '350px' }"
      :modal="true"
    >
      <div class="confirmation-content" v-on:keyup.enter="refresh()">
        <InputText type="password" v-model="password" autofocus />
        <Button icon="pi pi-check" v-on:click="refresh()" />
      </div>
    </Dialog>
    <div class="p-col-10">
      <DataTable :value="table_data" :filters="filters">
        <template #header>
          <div class="table-header" style="text-align:center">
            Sitios Hospedados
          </div>
          <span class="p-input-icon-left">
            <i class="pi pi-search" />
            <InputText
              v-model="filters['global']"
              placeholder="Búsqueda global"
            />
          </span>
          <OverlayPanel ref="op" style="width:54vw" :showCloseIcon="true">
            <SiteData></SiteData>
          </OverlayPanel>
        </template>
        <Column field="site_name" header="Nombre del sitio"> </Column>
        <Column field="alias" header="Alias"> </Column>
        <Column field="client_name" header="Cliente"> </Column>
        <Column field="hosted" header="Orden de hosting"> </Column>
        <Column field="" header="">
          <template #body="slotProps">
            <Button icon="pi pi-eye" v-on:click="viewDetails(slotProps.data)" />
            <Button
              icon="pi pi-pencil"
              v-on:click="modifySite(slotProps.data)"
            />
            <Button
              icon="pi pi-trash"
              v-on:click="displayConfirmation = true"
            />
            <Dialog
              header="Confirmación"
              :visible.sync="displayConfirmation"
              :style="{ width: '350px' }"
              :contentStyle="{overflow: 'visible'}"
              :modal="true"
              :dismissableMask="true"
            >
              <div class="confirmation-content">
                <i
                  class="pi pi-exclamation-triangle p-mr-3"
                  style="font-size: 2rem"
                />
                <span>Seguro que desea eliminar este sitio?</span>
              </div>
              <template #footer>
                <Button
                  label="No"
                  icon="pi pi-times"
                  v-on:click="displayConfirmation = false"
                  class="p-button-text"
                  autofocus
                />
                <Button
                  label="Sí"
                  icon="pi pi-check"
                  v-on:click="deleteSite(slotProps.data)"
                  class="p-button-text"
                />
              </template>
            </Dialog>
          </template>
        </Column>
      </DataTable>
    </div>
  </div>
</template>

<script>
import SiteData from "./SiteData.vue";
export default {
  data() {
    return {
      table_data: [],
      filters: {},
      askPassword: false,
      password: "",
      displayConfirmation: false,
    };
  },
  components: {
    SiteData,
  },
  methods: {
    // Show panel with site data
    viewDetails(site, event) {
      var store = this.$store;
      var op = this.$refs.op;
      this.$root.api.getSiteData(function(response_data) {
        store.commit("SET_SELECTED_SITE", response_data);
        op.toggle(event);
      }, site);
    },
    modifySite(site) {
      var store = this.$store;
      var router = this.$router;
      this.$root.api.getSiteData(function(response_data) {
        store.commit("SET_SELECTED_SITE", response_data);
        store.commit("SWITCH_EDIT", true);
        router.push({ name: "Form" });
      }, site);
    },
    deleteSite(site) {
      var root = this.$root;
      var store = this.$store;
      var update = this.updateTableData; // doing this with a method due to vue not allowing to call a local variable from within a function parameter
      this.$root.api.deleteSite(function() {
        root.api.getSites(function(data) {
          store.commit("SET_HOSTED_SITES", data);
          update();
        });
      }, site);
    },
    updateTableData() {
      this.table_data = this.$store.state.hosted_sites;
      this.table_data.forEach((element) => {
        //Change boolean value of hosted to Completed / Pendant
        if (element.hosted == true) element.hosted = "Completada";
        else if (element.hosted == false) element.hosted = "Pendiente";
      });
    },
    refresh() {
      var toast = this.$toast;
      var store = this.$store;
      var update = this.updateTableData;
      var root = this.$root;
      var closeconfirm = this.closePasswordDialog;

      this.$root.api.checkPassword(
        function(response) {
          if (response) {
            root.api.getSites(function(data) {
              store.commit("SET_HOSTED_SITES", data);
              update();
              closeconfirm();
            });
          } else {
            toast.add({
              severity: "error",
              detail: "Contraseña incorrecta",
              life: 3000,
            });
          }
        },
        {
          username: sessionStorage.getItem("username"),
          password: this.password,
        }
      );
    },
    closePasswordDialog() {
      this.askPassword = false;
    },
  },
  mounted() {
    if (
      sessionStorage.getItem("role") == "Especialista" &&
      this.$store.state.hosted_sites.length == 0
    ) {
      this.askPassword = true;
    } else {
      this.updateTableData();
    }
  },
};
</script>

<style scoped>
.confirmation-content {
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
