<template>
  <div>
    <Navbar></Navbar>
    <Toast></Toast>
    <div class="p-grid" style="margin-top:0">
      <div v-show="$route.path !== '/'" class="p-col-2 div-sidebar">
      <Sidebar></Sidebar>
    </div>
    <div class="p-col-10 div-content">
      <router-view />
    </div>
    </div>
    
    
  </div>
</template>

<script>
import Navbar from '../components/NavBar'
import Sidebar from '../components/Sidebar'
export default {
    name: "App",
    components: {
        Navbar,
        Sidebar
    },
    
}
</script>

<style>
/* .div-sidebar{
  width: 200px;
} */
.div-content {
  margin-left: 0;
  padding-left: 0;
}
.header-div{
  padding: 1.5em 0;
  background: #0786e0;
  position: relative;
  color: white;
  margin-bottom: 1rem;
}
.header-div h3 {
  margin: 0;
  
}
.container {
  padding: 0;
}
</style>