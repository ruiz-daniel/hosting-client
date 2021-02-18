import axios from 'axios'

const apiClient = axios.create({
    baseURL: ''
})

export default {
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

    registerNewSite(fn, submit_data) {
        apiClient.request({
            method: "post",
            url: '/epcommit',
            data: submit_data
        }).then(response =>{
            fn()
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
            method: 'get',
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
    }
}