<template>
  <div class="p-grid">
    <div class="p-col-9 p-ml-3">
      
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
