import axios from 'axios';

const state = () => ({
    produks: [],
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
        state.produks = payload
    },
    SET_ID_UPDATE(state, payload) {
        state.id = payload
    }
}

const actions = {
    get_data_produk({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            axios.get(`/api/produk`, {
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
    submit_data_produk({ dispatch, commit }, payload) {
        return new Promise((resolve, reject) => {
            axios.post(`/api/produk/create`, payload)
            .then((response) => {
                console.log(response)
                dispatch('get_data_produk').then(() => {
                    resolve(response.data)
                })
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true });
                    alert('gagal')
                }
            })
        })
    },
    edit_data_produk({ commit }, payload) {
        return new Promise((resolve, reject) => {
            axios.get(`/api/produk/edit/${payload}`)
            .then((response) => {
                console.log(response)
                resolve(response.data)
            })
        })
    },
    update_data_produk({ commit, state }, payload) {
        return new Promise((resolve, reject) => {
            axios.post(`/api/produk/update/${state.id}`, payload)
            .then((response) => {
                console.log(response.data)
                resolve(response.data)
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true })

                }
            })
        })
    } ,
    remove_data_produk({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            axios.delete(`/api/produk/delete/${payload}`)
            .then((response) => {
                dispatch('get_data_produk').then(() => resolve(response.data))
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