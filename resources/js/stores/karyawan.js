import axios from 'axios';

const state = () => ({
    karyawans: [],
    karyawan : {
        nama : '',
        posisi : '',
        jabatan : '',

    },
    currentKaryawan : '',
    page: 1,
    id: '',
    
})

const mutations = {
    ASSIGN_DATA(state, payload) {
        state.karyawans = payload
    },
    ASSIGN_FORM(state, payload) {
        state.karyawan = {
            nama : payload.nama,
            posisi : payload.posisi,   
            jabatan : payload.jabatan,          
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
    get_karyawan({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            axios.get(`/api/karyawan?page=${state.page}&q=${search}`)
            .then((response) => {                         
                commit('ASSIGN_DATA', response.data)
                resolve(response.data)
            })
        })
    },
    submit_karyawan({ dispatch, commit, state }) {
        return new Promise((resolve, reject) => {
            axios.post(`/api/karyawan`, state.karyawan)
            .then((response) => {
                
                dispatch('get_karyawan').then(() => {
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
    edit_karyawan({ commit }, payload) {
        return new Promise((resolve, reject) => {
            axios.get(`/api/karyawan/${payload}/edit/`)
            .then((response) => {
                commit('ASSIGN_FORM', response.data.data)
                resolve(response.data)
            })
        })
    },
    update_karyawan({ commit, state }, payload) {
        return new Promise((resolve, reject) => {
            axios.post(`/api/karyawan/update/${payload}`, state.karyawan)
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
    remove_karyawan({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            axios.delete(`/api/karyawan/${payload}`)
            .then((response) => {
                dispatch('get_karyawan').then(() => resolve(response.data))
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