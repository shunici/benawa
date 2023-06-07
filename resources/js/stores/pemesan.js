import axios from 'axios';

const state = () => ({
    pemesans: [],
    hasil_pemesan : [],
    page: 1,
    id: ''
})

const mutations = {
    ASSIGN_DATA(state, payload) {
        state.pemesans = payload
    },
    SET_PAGE(state, payload) {
        state.page = payload
    },
    SET_ID_UPDATE(state, payload) {
        state.id = payload
    },
    MUAT_DATA (state, payload) {
        state.hasil_pemesan = payload
    }
}

const actions = {
    get_data_pemesan({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            axios.get(`/api/pemesan?page=${state.page}&q=${search}`)
            .then((response) => {
                
                commit('ASSIGN_DATA', response.data.data)              
                resolve(response.data)
            })
        })
    },
    submit_data_pemesan({ dispatch, commit }, payload) {
        return new Promise((resolve, reject) => {
            axios.post(`/api/pemesan/create`, payload)
            .then((response) => {
                console.log(response)
                dispatch('get_data_pemesan').then(() => {
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
    edit_data_pemesan({ commit }, payload) {
        return new Promise((resolve, reject) => {
            axios.get(`/api/pemesan/edit/${payload}`)
            .then((response) => {
                console.log(response)
                resolve(response.data)
            })
        })
    },
    update_data_pemesan({ commit, state }, payload) {
        return new Promise((resolve, reject) => {
            axios.post(`/api/pemesan/update/${state.id}`, payload)
            .then((response) => {
                console.log(response);
                resolve(response.data)
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true })
                }
            })
        })
    } ,
    remove_data_pemesan({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            axios.delete(`/api/pemesan/delete/${payload}`)
            .then((response) => {
                dispatch('get_data_pemesan').then(() => resolve(response.data))
            })
        })
    },
    cari_pemesan ({commit}) {
        return new Promise((resolve, reject) => {
            axios.get(`/api/cari_pemesan`)
            .then((response) => {
                console.log(response.data.data);
                commit('MUAT_DATA', response.data)              
                resolve(response.data)
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