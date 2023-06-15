import axios from 'axios';

const state = () => ({
    infos: [],
    info : {
      deskripsi : ''
    }, 
    id: '',                         
    perPage: 100,
    currentPage: 1,  
    queri : {
        kategori : '',
    }, 

    warnaBG : [
        '#f2d7d5', 
        '#ebdef0',
        '#d4e6f1',
        '#d6eaf8',
        '#a3e4d7',
        '#abebc6',
        '#f9e79f',
        '#fad7a0',
        '#edbb99',
    ],
    icon : [
        'chat-dots-fill',
        'chat-dots',
        'chat-left-quote',
        'check2-square',
        'circle-square',
        'flag-fill',
        'gear',
        'lightning',        
        'telephone-fill',
        'sticky-fill',
        'shield-fill-x',      
        'power',
        'printer',       
        'exclamation-square-fill',
        'exclamation-triangle',
        'exclamation-triangle-fill',
        'eye',
        'camera-video',
        'camera',
        'bookmark-star',
    ]
})

const mutations = {
    ASSIGN_DATA(state, payload) {
        state.infos = payload
    },
    ASSIGN_FORM(state, payload) {
        state.info = {
           deskripsi : payload.deskripsi    
        }
    },
    CLEAR_FORM(state) {
        state.info = {             
            deskripsi : '',
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
    get_info({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            axios.get(`/api/info?page=${state.page}&q=${search}`)
            .then((response) => {                        
                commit('ASSIGN_DATA', response.data)
                resolve(response.data)
            })
        })
    },
    submit_info({ dispatch, commit, state }) {
        return new Promise((resolve, reject) => {
            axios.post(`/api/info`, state.info)
            .then((response) => {
                
                dispatch('get_info').then(() => {
                    resolve(response.data)
                    commit('CLEAR_FORM'); 
                })
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true })
                }
            })
        })
    }, 
    edit_info({ commit }, payload) {
        return new Promise((resolve, reject) => {
            axios.get(`/api/info/${payload}/edit/`)
            .then((response) => {
                commit('ASSIGN_FORM', response.data.data);                
                resolve(response.data)
            })
        })
    },
    update_info({ commit, state }, payload) {
        return new Promise((resolve, reject) => {
            axios.post(`/api/info/update/${payload}`, state.info)
            .then((response) => {
                commit('CLEAR_FORM');  
                resolve(response.data);
                
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true })
                }
            })
        })
    } ,
    remove_info({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            axios.delete(`/api/info/${payload}`)
            .then((response) => {
                dispatch('get_info').then(() => resolve(response.data))
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