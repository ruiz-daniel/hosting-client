<template>
  <Toolbar>
    <template #left>
        <Button label="Hosting Web" icon="pi pi-home" class="p-button-success p-mr-2" v-on:click="goHome()"/>
    </template>

    <template #right>
        <Button icon="pi pi-arrow-left" class="p-mr-2" v-if="$route.path !== '/'" v-on:click="goBack()" />
    </template>
</Toolbar>
</template>

<script>
export default {
    methods: {
        goHome(){
            this.$router.push({name: 'index'})
        },
        goBack(){
            if (this.$route.path !== "/")
                return this.$router.go(-1);
        }
    }
}
</script>

<style>

</style>