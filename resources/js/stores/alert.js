import axios from 'axios';

const state = () => ({
    alerts: [],
    alert : {
        kategori : '',
        text : '',
        text_detail : '',
        voiceText : '',  
        response : '',
        detil : '',      
        bgColor : '',
        icon : '',
        posisi : 1,
        spk_id : '',
        foto : '',
        user2 : '',
        estimasi : '',
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
        state.alerts = payload
    },
    ASSIGN_FORM(state, payload) {
        state.alert = {
            kategori : payload.kategori,
            text : payload.text,   
            text_detail : payload.text_detail,          
            voiceText : payload.voiceText,    
            response : payload.response,  
            detil : payload.detil,          
            bgColor : payload.bgColor,   
            icon : payload.icon,   
            posisi : payload.posisi,  
            foto : payload.foto, 
            spk_id : payload.spk_id, 
            user2 : payload.user2, 
            estimasi : payload.estimasi,      
        }
    },
    CLEAR_FORM(state) {
        state.alert = {             
            kategori : '',
            text : '',
            voiceText : '',  
            response : '',
            detil : '',      
            bgColor : '',
            icon : '',
            posisi : 1,
            spk_id : '',
            foto : '',
            user2 : '',
            estimasi : '',   
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
    get_alert({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            axios.get(`/api/alert`, {
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
    submit_alert({ dispatch, commit, state }) {
        return new Promise((resolve, reject) => {
            axios.post(`/api/alert`, state.alert)
            .then((response) => {                
                dispatch('get_alert').then(() => {
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
    jalankan_log({state}) {
          let alert_data = state.alerts.data;
          let data = {};
              data = alert_data.map( (tes, index) => {
                return {
                    id : tes.id,
                    posisi: index,
                }
              });
        return new Promise((resolve, reject) => {
            axios.post(`/api/gabung-alert`, data)
            .then((response) => {       
                 
                        
            })
           })
    },
    gabung_alert ({}, payload) {      
      return new Promise((resolve, reject) => {
        axios.post(`/api/gabung-alert`, payload)
        .then((response) => {       
             
                    
        })
       })
    },
    edit_alert({ commit }, payload) {
        return new Promise((resolve, reject) => {
            axios.get(`/api/alert/${payload}/edit/`)
            .then((response) => {
                commit('ASSIGN_FORM', response.data.data);                
                resolve(response.data)
            })
        })
    },
    cari_alert({ commit }, payload) {
        return new Promise((resolve, reject) => {
            axios.get(`/api/alert/cari/${payload}`)
            .then((response) => {
                // console.log(response.data);
                commit('ASSIGN_FORM', response.data.data);
                commit('SET_ID_UPDATE', response.data.data.id);
                resolve(response.data)
            })            
            .catch((error) => {
                commit('SET_ID_UPDATE', '');
                
            })
        })
    },
    update_alert({ commit, state }, payload) {
        return new Promise((resolve, reject) => {
            axios.post(`/api/alert/update/${payload}`, state.alert)
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
    remove_alert({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            axios.delete(`/api/alert/${payload}`)
            .then((response) => {
                dispatch('get_alert').then(() => resolve(response.data))
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