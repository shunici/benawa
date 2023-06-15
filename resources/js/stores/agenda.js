import axios from 'axios';

const state = () => ({
    agendas: [],
    agenda : {
        nama : '',
        deskripsi : '',
        estimasi : '',
        posisi : '',
        warna : '',
        label : {
                nama : '',
                warna : '',
        },
        papan : 'progress',
        foto : '', //base46
        user1 : '', //pembuat
        user2 : '', //handled
    },
    page: 1,
    id: '',       
    cekBox : {
      progress : true,
      pending : true,   
      selesai : true, 
      antrian : true,
      aksi : false,
      waktu : true,
      estimasi : true,
      alert : true,
      drag : true, //mode seret
    },         
    waktu_mundur : {
            years: 0,
            months: 0,
            days: 0,
            hours: 0,
            minutes: 0,
            seconds: 0,
            acara : ''
    },  
    warna : [
        '#f2d7d5  ', 
        '#ebdef0',
        '#d4e6f1',
        '#d6eaf8',
        '#a3e4d7',
        '#abebc6',
        '#f9e79f',
        '#fad7a0',
        '#edbb99',
    ],
    progress : [],
    pending : [],
    selesai : [],
    antrian : []
})

const mutations = {
    ASSIGN_DATA(state, payload) {
        state.agendas = payload
    },
    ASSIGN_FORM(state, payload) {
        state.agenda = {
            nama : payload.nama,
            deskripsi : payload.deskripsi, 
            estimasi : payload.estimasi, 
            posisi : payload.posisi, 
            papan : payload.papan,   //progress /pending / selesai        
            warna : payload.warna,  
            foto : payload.foto,  
            label : {
                nama : payload.label.nama,
                warna : payload.label.warna,
            }, 
            user1 : payload.user1, 
            user2 : payload.user2, 
        }
    },
    CLEAR_FORM(state) {
        state.agenda = {                           
                    nama : '',
                    deskripsi : '',
                    estimasi : '',
                    posisi : '',
                    warna : '',
                    label : {
                            nama : '',
                            warna : '',
                    },
                    papan : 'progress',
                    foto : '', //base46
                    user1 : '', //pembuat
                    user2 : '', //finishing prosesnya ini pada saat drag selesai
        }
    },
    SET_PAGE(state, payload) {
        state.page = payload
    },
    SET_ID_UPDATE(state, payload) {
        state.id = payload
    },
    assign_progress(state, payload) {
        state.progress = payload
    },
    assign_pending(state, payload) {
        state.pending = payload
    },
    assign_selesai(state, payload) {
        state.selesai = payload
    },
    assign_antrian(state, payload) {
        state.antrian = payload
    },
}

const actions = {
    get_agenda({ commit, state, dispatch }, payload) {
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            axios.get(`/api/agenda?page=${state.page}&q=${search}`)
            .then((response) => {                              
                commit('ASSIGN_DATA', response.data);
                dispatch('filter_agenda');
                resolve(response.data)
            })
        })
    },
    filter_agenda({commit, state}) {        
        let progress = state.agendas.data.filter(function (e) {
            if(e.papan == "progress") {
               return e.papan == "progress";
            }                             
        });        
        commit('assign_progress', progress);
           
        let pending = state.agendas.data.filter(function (e) {
            if(e.papan == "pending") {
               return e.papan == "pending";
            }                             
        });        
        commit('assign_pending', pending);
          
        let selesai = state.agendas.data.filter(function (e) {
            if(e.papan == "selesai") {
               return e.papan == "selesai";
            }                             
        });        
        commit('assign_selesai', selesai);

        let antrian = state.agendas.data.filter(function (e) {
            if(e.papan == "antrian") {
               return e.papan == "antrian";
            }                             
        });        
        commit('assign_antrian', antrian);

    },
    gabung_agenda ({}, payload) {      
      return new Promise((resolve, reject) => {
        axios.post(`/api/gabung-agenda`, payload)
        .then((response) => {       
             
                    
        })
       })
    },
    submit_agenda({ dispatch, commit, state }) {
        return new Promise((resolve, reject) => {
            axios.post(`/api/agenda`, state.agenda)
            .then((response) => {               
                dispatch('get_agenda').then(() => {
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
    edit_agenda({ commit }, payload) {
        return new Promise((resolve, reject) => {
            axios.get(`/api/agenda/${payload}/edit/`)
            .then((response) => {
                commit('ASSIGN_FORM', response.data.data)
                resolve(response.data)
            })
        })
    },
    update_agenda({ commit,dispatch, state }) {
        return new Promise((resolve, reject) => {
            axios.post(`/api/agenda/update/${state.id}`, state.agenda)
            .then((response) => {
                dispatch('get_agenda').then(() => resolve(response.data));
                commit('CLEAR_FORM');
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true })
                }
            })
        })
    } ,
    remove_agenda({ dispatch, commit }, payload) {
        return new Promise((resolve, reject) => {
            axios.delete(`/api/agenda/${payload}`)
            .then((response) => {
                commit('CLEAR_FORM');
                dispatch('get_agenda').then(() => resolve(response.data));
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