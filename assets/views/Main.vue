<template>
  <div class="p-grid p-ml-2 p-mt-2">
      <SpecialistView v-if="$store.state.user_data.role == 'Especialista'"></SpecialistView>
  </div>
</template>

<script>
import SpecialistView from '../components/MainSpecialist'
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
  components: {
    SpecialistView,
  },
};
</script>

<style>
.p-card:hover {
  box-shadow: 10px 10px rgb(199, 194, 194);
}

</style>
