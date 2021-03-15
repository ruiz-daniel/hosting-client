<template>
  <Toolbar v-show="$route.path !== '/'">
    <template #left>
        <Button label="Hosting Web" icon="pi pi-home" class="p-button-success p-mr-2" v-on:click="goHome()"/>
    </template>

    <template #right>
        <span class="pi pi-user"></span>
        <span>{{$store.state.user_data.username}}</span>
        <!-- <Button icon="pi pi-arrow-left" class="p-button-warning p-mr-2" v-if="$route.path !== '/' && $route.path !== '/main'" v-on:click="goBack()" /> -->
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
    }
}
</script>

<style scoped>
.p-toolbar{
    background-color: #0786e0;
}
span {
    font-size: 20px;
}


</style>