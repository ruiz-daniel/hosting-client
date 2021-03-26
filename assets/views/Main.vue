<template>
  <div class="p-grid p-ml-2 p-mt-2">
      <SpecialistView v-if="$store.state.user_data.role == 'Especialista'"></SpecialistView>
  </div>
</template>

<script>
import SpecialistView from '../components/MainSpecialist'
export default {
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
