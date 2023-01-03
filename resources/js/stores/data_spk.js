import axios from 'axios';

const state = () => ({
    data_spks: [],
    page: 1,
    id: '',
    recent_job : {
        nama_brg : '',
        bahan : '',
        ket : '',
        keterangan : ''
      },    
})

const mutations = {
    ASSIGN_DATA(state, payload) {
        state.data_spks = payload
    },
    SET_PAGE(state, payload) {
        state.page = payload
    },
    SET_ID_UPDATE(state, payload) {
        state.id = payload
    },
    RECENT_JOB (state, payload) {
        state.recent_job = payload
    }

}

const actions = {
    get_data_spk({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            axios.get(`/api/data_spk?page=${state.page}&q=${search}`)
            .then((response) => {
                commit('ASSIGN_DATA', response.data.data)              
                resolve(response.data)
            })
        })
    },
    submit_data_spk({ dispatch, commit }, payload) {
        return new Promise((resolve, reject) => {
            axios.post(`/api/data_spk/create`, payload)
            .then((response) => {
                console.log(response)
                dispatch('get_data_spk').then(() => {
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
    edit_data_spk({ commit }, payload) {
        return new Promise((resolve, reject) => {
            axios.get(`/api/data_spk/edit/${payload}`)
            .then((response) => {
                console.log(response)
                resolve(response.data)
            })
        })
    },
    update_data_spk({ commit, state }, payload) {
        return new Promise((resolve, reject) => {
            axios.post(`/api/data_spk/update/${state.id}`, payload)
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
    remove_data_spk({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            axios.delete(`/api/data_spk/delete/${payload}`)
            .then((response) => {
                dispatch('get_data_spk').then(() => resolve(response.data))
            })
        })
    },
    kirim_recent({commit}, payload) {
        commit('RECENT_JOB', payload );    
    }


}

export default {
    namespaced: true,
    state,
    actions,
    mutations
}