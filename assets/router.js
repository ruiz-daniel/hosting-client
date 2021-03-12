import Vue from 'vue';
import VueRouter from 'vue-router';
import Form from './components/Form.vue';
import Main from './views/Main.vue'
import ViewSites from './components/ViewHostedSites.vue'
import SiteData from './components/SiteData.vue'
import Login from './views/Login.vue'

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'index',
        component: Login
    },
    {
        path: '/main',
        name: 'main',
        component: Main
    },
    {
        path: '/form',
        name: 'Form',
        component: Form
    },
    {
        path: '/viewsites',
        name: 'viewsites',
        component: ViewSites
    },
    {
        path: '/sitedata',
        name: 'sitedata',
        component: SiteData
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;