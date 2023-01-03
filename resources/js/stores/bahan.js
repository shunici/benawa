import axios from 'axios';

const state = () => ({
    bahans: [],
    page: 1,
    id: '',
    queri : {
        kategori : '',
    },                     
    perPage: 100,
    currentPage: 1, 
})

const mutations = {
    ASSIGN_DATA(state, payload) {
        state.bahans = payload
    },
    SET_PAGE(state, payload) {
        state.page = payload
    },
    SET_ID_UPDATE(state, payload) {
        state.id = payload
    }
}

const actions = {
    get_data_bahan({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            axios.get(`/api/bahan`, {
                params : {                                                
                    q : search,                                
                    kueri : state.queri.kategori,                                            
                    page : state.currentPage, 
                    per_page: state.perPage, 
                }
            })
            .then((response) => {
                commit('ASSIGN_DATA', response.data)              
                resolve(response.data)
            })
        })
    },
    submit_data_bahan({ dispatch, commit }, payload) {
        return new Promise((resolve, reject) => {
            axios.post(`/api/bahan/create`, payload)
            .then((response) => {
                console.log(response)
                dispatch('get_data_bahan').then(() => {
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
    edit_data_bahan({ commit }, payload) {
        return new Promise((resolve, reject) => {
            axios.get(`/api/bahan/edit/${payload}`)
            .then((response) => {
                console.log(response)
                resolve(response.data)
            })
        })
    },
    update_data_bahan({ commit, state }, payload) {
        return new Promise((resolve, reject) => {
            axios.post(`/api/bahan/update/${state.id}`, payload)
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
    remove_data_bahan({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            axios.delete(`/api/bahan/delete/${payload}`)
            .then((response) => {
                dispatch('get_data_bahan').then(() => resolve(response.data))
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