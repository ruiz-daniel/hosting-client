import Vue from 'vue';
import VueRouter from 'vue-router';
import Form from './components/Form.vue';
import Main from './views/Main.vue'
import ViewSites from './components/ViewHostedSites.vue'
import SiteData from './components/SiteData.vue'
import Login from './views/Login.vue'
import ManageUsers from './components/ManageUsers.vue'
import InsertUser from './components/InsertUser.vue'
import EditUser from './components/EditUser.vue'
import ChangePassword from './components/ChangePassword.vue'
import ChangeUsername from './components/ChangeUsername.vue'

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
    },
    {
        path: '/manageusers',
        name: 'manageusers',
        component: ManageUsers
    },
    {
        path: '/insertuser',
        name: 'insertuser',
        component: InsertUser
    },
    {
        path: '/edituser',
        name: 'edituser',
        component: EditUser
    },
    {
        path: '/changepassword',
        name: 'changepassword',
        component: ChangePassword
    },
    {
        path: '/changeusername',
        name: 'changeusername',
        component: ChangeUsername
    }

];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;