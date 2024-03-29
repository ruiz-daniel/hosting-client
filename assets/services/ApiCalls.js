import axios from 'axios'
import NProgress from 'nprogress'

const apiClient = axios.create({
    baseURL: ''
})

// Interceptors to initiate and stop progress bar during axios requests
apiClient.interceptors.request.use(config => {
    NProgress.start()
    return config
})

apiClient.interceptors.response.use(response => {
    NProgress.done()
    return response
})

/**
 * All methods for http request get a function as a parameter
 * so they can call that function after receiving a response from the server.
 * This is done due to axios requests being asynchronus and to avoid processing
 * data before it has been received from the server.
 * It also helps properly notify the app after a request has been successful
 */

export default {
    // Get data for comboboxes............
    getPackets(fn) {
        apiClient.request({
            method: 'get',
            url: '/eppackets'
        }).then(response=>{
            fn(response.data)
        });
    },
    getWebServers(fn) {
        apiClient.request({
            method: 'get',
            url: '/epwebservers'
        }).then(response=>{
            fn(response.data)
        });
    },
    getDbServers(fn) {
        apiClient.request({
            method: 'get',
            url: '/epdbservers'
        }).then(response=>{
            fn(response.data)
        });
    },
    getTemplates(fn) {
        apiClient.request({
            method: 'get',
            url: '/eptemplates'
        }).then(response=>{
            fn(response.data)
        });
    },
    //.................................

    registerNewSite(fn, submit_data) {
        apiClient.request({
            method: "post",
            url: '/epcommit',
            data: submit_data
        }).then(response =>{
            fn(true)
        }).catch(error => {
            NProgress.done()
            fn(false)
        });
    },

    updateSite(fn, data) {
        apiClient.request({
            method: "post",
            url: '/epupdate',
            data: data
        }).then(response =>{
            fn()
        });
    },

    getSites(fn) {
        apiClient.request({
            method: 'post',
            url: '/epgetsites'
        }).then(response => {
            fn(response.data)
        });
    },

    getSiteData(fn, data) {
        axios.request({
          method: 'post',
          url: '/epsitedata',
          data: {
            'site_id': data.id,
            'site_name': data.site_name,
            'alias': data.alias,
            'client': data.client_name
          }
        }).then(response=> {
          fn(response.data)
        })
    },

    deleteSite(fn, data) {
        apiClient.request({
            method: "post",
            url: '/epdelete',
            data: data
        }).then(response =>{
            fn()
        });
    },

    login(fn, data) {
        apiClient.request({
            method: "post",
            url: '/eplogin',
            data: {
                'username': data.username,
                'password': data.password
            },
        }).then(response =>{
            fn(response.data)
        });
    },

    getUsers(fn, data) {
        apiClient.request({
            method: "post",
            url: '/epgetusers',
        }).then(response =>{
            fn(response.data)
        });
    },

    addUser(fn, data) {
        apiClient.request({
            method: "post",
            url: '/epadduser',
            data: {
                'username': data.username,
                'password': data.password,
                'role': data.role
            },
        }).then(response =>{
            fn(true)
        }).catch(error => {
            fn(false)
        });
    },

    updateUser(fn, data) {
        apiClient.request({
            method: "post",
            url: '/epupdateuser',
            data: {
                'id': data.id,
                'username': data.username,
                'role': data.role
            },
        }).then(response =>{
            fn(true)
        }).catch(error => {
            NProgress.done()
            fn(false)
        });
    },

    updatePassword(fn, data) {
        apiClient.request({
            method: "post",
            url: '/epupdatepassword',
            data: {
                'id': data.id,
                'password': data.password
            },
        }).then(response =>{
            fn(true)
        }).catch(error => {
            fn(false)
        });
    },

    deleteUser(fn, data) {
        apiClient.request({
            method: "post",
            url: '/epdeleteuser',
            data: {
                'id': data.id
            },
        }).then(response =>{
            fn(true)
        }).catch(error => {
            fn(false)
        });
    },

    getUserRoles(fn) {
        apiClient.request({
            method: "get",
            url: '/epuserroles',
        }).then(response =>{
            fn(response.data)
        }).catch(error => {
            fn(false)
        });
    },

    changePassword(fn, data) {
        apiClient.request({
            method: "post",
            url: '/epchangepassword',
            data: {
                username: data.username,
                old_password: data.old_password,
                password: data.password
            }
        }).then(response => {
            fn(response.data)
        }).catch(error => {
            fn(false)
        });
    },

    checkPassword(fn, data) {
        apiClient.request({
            method: "post",
            url: '/epcheckpassword',
            data: {
                username: data.username,
                password: data.password
            }
        }).then(response => {
            fn(response.data)
        })
    },

    changeUsername(fn, data) {
        apiClient.request({
            method: "post",
            url: '/epchangeusername',
            data: {
                old_username: data.old_username,
                username: data.username,
                password: data.password
            }
        }).then(response => {
            fn(response.data)
        })
    },

    getUsernames(fn) {
        apiClient.request({
            method: "post",
            url: '/epgetusernames',
        }).then(response => {
            fn(response.data)
        }).catch(error => {
            fn(false)
        });
    },

    getSitesStats(fn) {
        apiClient.request({
            method: "post",
            url: '/epsitesstats'
        }).then(response=> {
            fn(response.data)
        })
    }
}