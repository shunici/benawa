import axios from 'axios';

const state = () => ({
    labels: [],
    label : {
        nama : '',
        posisi : '',
        warna : ''
    },
    page: 1,
    id: ''
})

const mutations = {
    ASSIGN_DATA(state, payload) {
        state.labels = payload
    },
    ASSIGN_FORM(state, payload) {
        state.label = {
            nama : payload.nama,
            posisi : payload.posisi,            
            warna : payload.warna,  
        }
    },
    SET_PAGE(state, payload) {
        state.page = payload
    },
    SET_ID_UPDATE(state, payload) {
        state.id = payload
    }
}

const actions = {
    get_label({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            axios.get(`/api/label?page=${state.page}&q=${search}`)
            .then((response) => {        
                console.log(response.data.data)       
                commit('ASSIGN_DATA', response.data)
                resolve(response.data)
            })
        })
    },
    submit_label({ dispatch, commit, state }) {
        return new Promise((resolve, reject) => {
            axios.post(`/api/label`, state.label)
            .then((response) => {
                console.log(response)
                dispatch('get_label').then(() => {
                    resolve(response.data)
                })
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true })
                }
            })
        })
    },
    edit_label({ commit }, payload) {
        return new Promise((resolve, reject) => {
            axios.get(`/api/label/${payload}/edit/`)
            .then((response) => {
                commit('ASSIGN_FORM', response.data.data)
                resolve(response.data)
            })
        })
    },
    update_label({ commit, state }, payload) {
        return new Promise((resolve, reject) => {
            axios.post(`/api/label/update/${payload}`, state.label)
            .then((response) => {
                resolve(response.data)
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true })
                }
            })
        })
    } ,
    remove_label({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            axios.delete(`/api/label/${payload}`)
            .then((response) => {
                dispatch('get_label').then(() => resolve(response.data))
            })
        })
    }
}

export default {
    namespaced: true,
    state,
    actions,
    mutations
}