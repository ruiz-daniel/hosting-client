<template>
  <Toolbar v-show="$route.path !== '/'">
    <template #left>
        <Button label="Hosting Web" icon="pi pi-home" class="p-button-success p-mr-2" v-on:click="goHome()"/>
    </template>

    <template #right>
        <Button label="Cerrar Sesión" icon="pi pi-sign-out" iconPos="right" v-on:click="logout()" />
        <!-- <Button icon="pi pi-arrow-left" class="p-mr-2" v-if="$route.path !== '/' && $route.path !== '/main'" v-on:click="goBack()" /> -->
    </template>
</Toolbar>
</template>

<script>
export default {
    methods: {
        goHome(){
            if (this.$store.state.user_data != 'no user') {
                this.$router.push({name: 'main'})
            }
            else {
                this.$router.push({name: 'index'})
            }
        },
        goBack(){
            if (this.$route.path !== "/")
                return this.$router.go(-1);
        },
        logout() {
            this.$store.commit("SET_USER_DATA", 'no user')
            this.$router.push({name:'index'})
        }
    }
}
</script>

<style>

</style>