<template>
  <div>
    <Navbar></Navbar>
    <router-view />
  </div>
</template>

<script>
import Navbar from '../components/NavBar'
export default {
    name: "App",
    components: {
        Navbar
    },
    
}
</script>

<style>
</style>