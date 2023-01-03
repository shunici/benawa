
import moment from "moment"
moment.locale('id');  
import axios from 'axios';

const state = () => ({   
  spks : [],
    spk : [
        {
        nama_pemesan : '', tgl: moment().format('YYYY-MM-DD HH:mm:ss'), status: '',
        data : [
            { id: 0, nama_brg : '', produk_id: null, bahan: '', bahan_id : null,  ukuranP : '', ukuranL: '', uk_alias: '', qty : null, fns:false, ls: false,  ket: '-' },
            { id: 1, nama_brg : '', produk_id: null, bahan: '', bahan_id : null, ukuranP : '', ukuranL: '', uk_alias: '', qty : null, fns:false, ls: false,  ket: '-' },
            { id: 2, nama_brg : '', produk_id: null, bahan: '', bahan_id : null, ukuranP : '', ukuranL: '', uk_alias: '', qty : null, fns:false, ls: false,  ket: '-' },
             { id: 3, nama_brg : '', produk_id: null, bahan: '', bahan_id : null, ukuranP : '', ukuranL: '', uk_alias: '', qty : null, fns:false, ls: false,  ket: '-' },
        ],
        status : '',
        warna : '',
        label : '',
        user : '',
        no_wa : '',
        produk : '',
        posisi : '',
        estimasi : '',
        deskripsi : '',
        deskripsi_voice : '', 
        created_at : '',       

      }            
    ],    
      uk_font : 0.8,

      options: [
        {label : 'spanduk',  code : '300x500', pesan: 'shun'},
        {label : 'spandcode',  code : '300x500', pesan :'sdfsdf'}
      ],

      // buat keterangan 
      ket_lain: {
        aktif : false,
        pesan : ''
      },
      show_select : null,    
      show_input : null,  
      urutan : null, 
      ttd : {nama : 'Lee Min Shun'},
      resolusi : 23.62204724393699, // default 60 resolusi, untuk mengatur ukuran tif
      uk_label : 0,    //untuk mengatur kelbihan label fns atau ls 
      bahan : {
        default : 'fr280'
      },
      mode : true, //jika true, spk dengan automatis, jika tida manual
      
    
})

const mutations = {
   BESAR_FONT(state, payload){
            state.uk_font += payload
   },
   KECIL_FONT(state, payload){
    state.uk_font -= payload
    },
    PESAN_MUNCUL(state){
        state.ket_lain.aktif = state.ket_lain.aktif ? false : true;
    },
    SHOW_INPUT(state, payload, urut ){
      state.urutan = urut;
      state.show_input = payload;
    },
    SHOW_SELECT(state, payload ){
      state.show_select = payload
    },
    SHOW_URUTAN(state, payload ){
      state.urutan = payload
    },
    ASSIGN_DATA(state, payload) {
      state.spks = payload
  },
  ASSIGN_FORM(state, payload) {
    state.spk = [
      {nama_pemesan : payload.nama_pemesan,
      tgl: payload.tgl,
      status: payload.status,
        data : [
            { id: 0, nama_brg : payload.data[0].nama_brg, produk_id: null, bahan: payload.data[0].bahan, bahan_id : null,  ukuranP : payload.data[0].ukuranP, ukuranL: payload.data[0].ukuranL, uk_alias: payload.data[0].uk_alias, qty : payload.data[0].qty, fns:payload.data[0].fns, ls: payload.data[0].ls,  ket: payload.data[0].ket },
            { id: 1, nama_brg : payload.data[1].nama_brg, produk_id: null, bahan: payload.data[1].bahan, bahan_id : null, ukuranP : payload.data[1].ukuranP, ukuranL: payload.data[1].ukuranL, uk_alias: payload.data[1].uk_alias, qty : payload.data[1].qty, fns:payload.data[1].fns, ls: payload.data[1].ls,  ket: payload.data[1].ket },
            { id: 2, nama_brg : payload.data[2].nama_brg, produk_id: null, bahan: payload.data[2].bahan, bahan_id : null, ukuranP : payload.data[2].ukuranP, ukuranL: payload.data[2].ukuranL, uk_alias: payload.data[2].uk_alias, qty : payload.data[2].qty, fns:payload.data[2].fns, ls: payload.data[2].ls,  ket: payload.data[2].ket },
             { id: 3, nama_brg : payload.data[3].nama_brg, produk_id: null, bahan: payload.data[3].bahan, bahan_id : null, ukuranP : payload.data[3].ukuranP, ukuranL: payload.data[3].ukuranL, uk_alias: payload.data[3].uk_alias, qty : payload.data[3].qty, fns:payload.data[3].fns, ls: payload.data[3].ls,  ket: payload.data[3].ket },
        ]          
      } 
    ]
},

}

const actions = {
    besar_uk_font({commit}) {
        commit('BESAR_FONT', 0.1);    
    },
    kecil_uk_font({commit}) {
        commit('KECIL_FONT', 0.1);    
    },
    pesan_aktif({commit}) {
       commit('PESAN_MUNCUL');
    },

    get_spk({ commit, state }, payload) {
      let search = typeof payload != 'undefined' ? payload:''
      return new Promise((resolve, reject) => {
          axios.get(`/api/spk?page=${state.page}&q=${search}`)
          .then((response) => {                           
              commit('ASSIGN_DATA', response.data)
              resolve(response.data)
          })
      })
  },

    submit_spk ({commit, dispatch, state}) {      
      return new Promise((resolve, reject) => {
        axios.post(`/api/spk`, state.spk[0])
        .then((response) => {       
              dispatch('get_spk').then(() => {
                resolve(response.data)
            })
                    
        })
       })
    },
    edit_spk({ commit }, payload) {
      return new Promise((resolve, reject) => {
          axios.get(`/api/spk/${payload}/edit`)
          .then((response) => {           
              console.log('tag', response.data.data)
              commit('ASSIGN_FORM', response.data.data)
              resolve(response.data)
          })
      })
    },
    remove_spk({ dispatch }, payload) {
      return new Promise((resolve, reject) => {
          axios.delete(`/api/spk/${payload}`)
          .then((response) => {              
              dispatch('get_spk').then(() => resolve())
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