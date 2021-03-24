<template>
  <div class="p-col-12">
    <div class="p-grid">
      <div class="p-col-2 p-md-3 p-shadow-10">
        <div class="card summary">
          <span class="title">Sitios hospedados</span>
          <span class="count hosted">{{ hosted_sites }}</span>
        </div>
      </div>
      <div class="p-col-2 p-md-3 p-ml-3 p-shadow-10">
        <div class="card summary">
          <span class="title">Pendientes de modificación</span>
          <span class="count moded">{{ pending_modify }}</span>
        </div>
      </div>
      <div class="p-col-2 p-md-3 p-ml-3 p-shadow-10">
        <div class="card summary">
          <span class="title">Pendientes de eliminar</span>
          <span class="count deleted">{{ pending_delete }}</span>
        </div>
      </div>
    </div>
    <div class="p-grid p-mt-3">
      <div class="p-col-5">
        <h3>Servidores Web</h3>
        <Chart type="pie" :data="webServersData" />
      </div>
      <div class="p-col-5">
        <h3>Servidores de base de datos</h3>
        <Chart type="pie" :data="dbServersData" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      hosted_sites: 1,
      pending_modify: 0,
      pending_delete: 0,

      php_node_sites: 1,
      tomcat_sites: 1,

      no_db_sites: 1,
      mysql_sites: 1,
      postgre_sites: 1,

      webServersData: {},
      dbServersData: {},
    };
  },
  methods: {
    setData(data) {
      this.hosted_sites = data.hosted;
      this.pending_modify = data.modified;
      this.pending_delete = data.deleted;
      this.php_node_sites = data.php_node;
      this.tomcat_sites = data.tomcat;
      this.no_db_sites = data.no_db;
      this.mysql_sites = data.mysql;
      this.postgre_sites = data.postgres;
      this.webServersData = {
        labels: ["Apache/PHP/Node", "Apache Tomcat"],
        datasets: [
          {
            data: [this.php_node_sites, this.tomcat_sites],
            backgroundColor: ["#66BB6A", "#f06f37"],
          },
        ],
      };
      this.dbServersData = {
        labels: ["Sin base de datos", "MySQL", "PostgreSQL"],
        datasets: [
          {
            data: [this.no_db_sites, this.mysql_sites, this.postgre_sites],
            backgroundColor: ["#ff8fc5", "#f0bb37", "#378df0"],
          },
        ],
      };
    },
  },
  mounted() {
    var setData = this.setData;
    this.$root.api.getSitesStats(function(data) {
      setData(data);
    });
  },
};
</script>

<style scoped>
.card {
  height: 60px;
}
.summary {
  position: relative;
}

.title {
  position: absolute;
  top: 20px;
  left: 10px;
  font-size: 21px;
}

.detail {
  color: gray;
  display: block;
  margin-top: 10px;
}

.count {
  color: #ffffff;
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 24px;
  padding: 7px 14px;
}
.hosted {
  background-color: #20d077;
}
.moded {
  background-color: #f9c851;
}
.deleted {
  background-color: #d02620;
}
</style>
