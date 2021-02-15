<template>
  <div class="p-grid p-justify-center p-mt-3">
    <div class="p-grid p-shadow-14 wrap">
      <div class="p-col-2 p-mt-4 p-ml-4">
        <div class="p-d-flex p-jc-between">
          <div class="p-mr-3">
            <p>Sitio</p>
            <span id="site_name">{{ site_data.site_name }}</span>
          </div>
          <div>
            <p>Alias</p>
            <span id="alias">{{ site_data.alias }}</span>
          </div>
        </div>
        <div class="content-wrapper">
          <div>
            <p>Titular</p>
            {{ site_data.client }}
          </div>
          <div>
            <p>Tipo de cliente</p>
            {{ site_data.client_type }}
          </div>
          <div>
            <p>Correo</p>
            {{ site_data.client_email }}
          </div>
          <div>
            <p>Teléfono</p>
            {{ site_data.client_phone }}
          </div>
        </div>
      </div>
      <div class="p-col-2 p-mt-4 p-ml-4">
          <div class="content-wrapper">
              <div>
                  <p>Paquete contratado</p>
                  {{site_data.packet}}
              </div>
              <div>
                  <p>Espacio en disco</p>
                  {{site_data.disk_space}} MB
              </div>
              <div>
                  <p>Espacio extra en disco</p>
                  {{site_data.extra_disk_space}} MB
              </div>
              <div>
                  <p>Espacio en bd</p>
                  {{site_data.db_space}} MB
              </div>
              <div>
                  <p>Espacio extra en bd</p>
                  {{site_data.extra_db_space}} MB
              </div>
          </div>
      </div>
      <div class="p-col-2 p-mt-4 p-ml-4">
        <div class="content-wrapper">
          <div>
            <p>Servidor Web</p>
            {{ site_data.web_server }}
          </div>
          <div v-if="site_data.web_server === 'Apache/PHP/Node.js'">
            <p>Version php</p>
            {{ site_data.php_version }}
            <p v-if="site_data.node">Usa NodeJS</p>
          </div>
          <div>
              <p>Servidor BD</p>
              {{site_data.db_server}}
          </div>
          <div>
              <p>Nombre BD</p>
              {{site_data.db_name}}
          </div>
          <div>
              <p>Usuario BD</p>
              {{site_data.db_user}}
          </div>
          <div>
              <p>Contraseña BD</p>
              {{site_data.db_password}}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      site_data: this.$store.state.selected_site,
    };
  },
};
</script>

<style scoped>
.wrap {
  width: 80%;
  background-color: white;
}
p {
  font-weight: bold;
}
.content-wrapper {
    text-align:center;
}
</style>
