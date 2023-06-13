
import moment from "moment"
moment.locale('id');  
import axios from 'axios';
import { assignWith } from "lodash";

const state = () => ({   
  spks : [],
    spk : 
        {
        nama_pemesan : '',        
        tgl: moment().format('YYYY-MM-DD HH:mm:ss'),
        status: 'cm', 
        data : [
            { id: 0, nama_brg : '', produk_id: null, bahan: '', bahan_id : null,  ukuranP : '', ukuranL: '', uk_alias: '', qty : null, fns:false, ls: false,  ket: null },
            { id: 1, nama_brg : '', produk_id: null, bahan: '', bahan_id : null, ukuranP : '', ukuranL: '', uk_alias: '', qty : null, fns:false, ls: false,  ket: null },
            { id: 2, nama_brg : '', produk_id: null, bahan: '', bahan_id : null, ukuranP : '', ukuranL: '', uk_alias: '', qty : null, fns:false, ls: false,  ket: null },
             { id: 3, nama_brg : '', produk_id: null, bahan: '', bahan_id : null, ukuranP : '', ukuranL: '', uk_alias: '', qty : null, fns:false, ls: false,  ket: null },
        ],           
        warna : '',
        label : {
          warna : 'white',
          nama : ''
        },
        user : [], // [{nama : '', ket : '', waktu : ''}]
        desainer : '',
        id_kostumer : '',
        no_wa : '',
        kategori : 'Outdoor',
        posisi : '',        
        text : '',
        text_voice : false, //bolean  
        no_nota : '',  
        foto : '',//skenan_kostumer
        foto_spk : '', //buat gambar
                 
      },          
      cekBox : {
        cm : true,
        cp : true,
        cs : true,
        csd :true,
        waktu : true,
        estimasi :true,
        
      },      
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
      query : {
        id_kostumer : '',
        kategori : '',
        desainer : '',
        status : 'cm',
        tgl1 : '',
        tgl2 : '',
      }, //query kategori
      mode : true, //jika true, spk dengan automatis, jika tida manual
      cm : [],
      cp : [],
      cs : [],
      csd : [],                      
      perPage: 100,
      currentPage: 1,      
      mulai_tgl : '',
      akhir_tgl : '',
      warna : [],
      no_nota : '',
      hasil_data : [], //queri khusus data, tobe continued
      
    
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
    state.spk = {
      nama_pemesan : payload.nama_pemesan,
      tgl: payload.tgl,
      status: payload.status,             
      warna : payload.warna,           
      label : {
        warna : payload.label.warna,
        nama : payload.label.nama
      },
      user : payload.user,
      desainer : payload.desainer, 
      id_kostumer : payload.id_kostumer,
      no_wa : payload.no_wa,
      kategori : payload.kategori,
      posisi : payload.posisi,        
      text : payload.text,
      text_voice : payload.text_voice, //bolean 
      no_nota : payload.no_nota, 
      foto : payload.foto, 
        data : [
            { id: 0, nama_brg : payload.data[0].nama_brg, produk_id: null, bahan: payload.data[0].bahan, bahan_id : null,  ukuranP : payload.data[0].ukuranP, ukuranL: payload.data[0].ukuranL, uk_alias: payload.data[0].uk_alias, qty : payload.data[0].qty, fns:payload.data[0].fns, ls: payload.data[0].ls,  ket: payload.data[0].ket },
            { id: 1, nama_brg : payload.data[1].nama_brg, produk_id: null, bahan: payload.data[1].bahan, bahan_id : null, ukuranP : payload.data[1].ukuranP, ukuranL: payload.data[1].ukuranL, uk_alias: payload.data[1].uk_alias, qty : payload.data[1].qty, fns:payload.data[1].fns, ls: payload.data[1].ls,  ket: payload.data[1].ket },
            { id: 2, nama_brg : payload.data[2].nama_brg, produk_id: null, bahan: payload.data[2].bahan, bahan_id : null, ukuranP : payload.data[2].ukuranP, ukuranL: payload.data[2].ukuranL, uk_alias: payload.data[2].uk_alias, qty : payload.data[2].qty, fns:payload.data[2].fns, ls: payload.data[2].ls,  ket: payload.data[2].ket },
             { id: 3, nama_brg : payload.data[3].nama_brg, produk_id: null, bahan: payload.data[3].bahan, bahan_id : null, ukuranP : payload.data[3].ukuranP, ukuranL: payload.data[3].ukuranL, uk_alias: payload.data[3].uk_alias, qty : payload.data[3].qty, fns:payload.data[3].fns, ls: payload.data[3].ls,  ket: payload.data[3].ket },
        ]          
      
      }
},

CLEAR_FORM (state) {
  state.spk = 
  {
  nama_pemesan : '',        
  tgl: moment().format('YYYY-MM-DD HH:mm:ss'),
  status: 'cm', 
  data : [
      { id: 0, nama_brg : '', produk_id: null, bahan: '', bahan_id : null,  ukuranP : '', ukuranL: '', uk_alias: '', qty : null, fns:false, ls: false,  ket: null },
      { id: 1, nama_brg : '', produk_id: null, bahan: '', bahan_id : null, ukuranP : '', ukuranL: '', uk_alias: '', qty : null, fns:false, ls: false,  ket: null },
      { id: 2, nama_brg : '', produk_id: null, bahan: '', bahan_id : null, ukuranP : '', ukuranL: '', uk_alias: '', qty : null, fns:false, ls: false,  ket: null },
       { id: 3, nama_brg : '', produk_id: null, bahan: '', bahan_id : null, ukuranP : '', ukuranL: '', uk_alias: '', qty : null, fns:false, ls: false,  ket: null },
  ],           
  warna : '',
  label : {
    warna : 'white',
    nama : ''
  },
  user : '',
  no_wa : '',
  foto : '',
  foto_spk : '',
  kategori : 'Outdoor',
  posisi : '',        
  text : '',
  text_voice : false, //bolean  
  no_nota : '',  
  }
},


SET_PERPAGE(state, payload) {
  state.perPage = payload
},


SET_CURRENTPAGE(state, payload) {
  state.currentPage = payload
},


assign_cm(state, payload) {
  state.cm = payload
},
assign_cp(state, payload) {
  state.cp = payload
},
assign_cs(state, payload) {
  state.cs = payload
},
assign_csd(state, payload) {
  state.csd = payload
},

RANDOM_WARNA(state) {  
  var warna_terpilih = state.warna[Math.floor(Math.random() * state.warna.length)];
  state.spk.warna =  warna_terpilih ;  
},

ASSIGN_WARNA(state, payload) {
  state.warna = payload
},


MUAT_DATA (state, payload) {
  state.hasil_data = payload
}

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

    get_spk({ commit, state, dispatch }, payload) {
      let search = typeof payload != 'undefined' ? payload:''
      return new Promise((resolve, reject) => {
          axios.get(`/api/spk`, {
            params : {           
              q : search,
              no_nota : state.no_nota, 
              status : state.query.status, 
              desainer : state.query.desainer, 
              kategori : state.query.kategori,                
              mulai_tgl : state.mulai_tgl,
              akhir_tgl : state.akhir_tgl,                
              page : state.currentPage, 
              per_page: state.perPage,  
              id_kostumer: state.query.id_kostumer,                       
            }
          })
          .then((response) => {                         
              commit('ASSIGN_DATA', response.data);
              dispatch('filter_spk');
              dispatch('query_data');              
              resolve(response.data)
          })
      })
  }, 
  spk_csd({dispatch }, payload) {
    return new Promise((resolve, reject) => {
        axios.post(`/api/spk/csd/${payload}`)
        .then((response) => {                       
             dispatch('get_spk');
            resolve(response.data)
        })
    })
  },  
  spk_cs({dispatch }, payload) {
    return new Promise((resolve, reject) => {
        axios.post(`/api/spk/cs/${payload}`)
        .then((response) => {                       
             dispatch('get_spk');
            resolve(response.data)
        })
    })
  },  
  spk_cm({dispatch }, payload) {
    return new Promise((resolve, reject) => {
        axios.post(`/api/spk/cm/${payload}`)
        .then((response) => {                       
             dispatch('get_spk');
            resolve(response.data)
        })
    })
  },   
  spk_cs({dispatch }, payload) {
    return new Promise((resolve, reject) => {
        axios.post(`/api/spk/cs/${payload}`)
        .then((response) => {                       
             dispatch('get_spk');
            resolve(response.data)
        })
    })
  },  

  
  get_warna({ commit}) {  
    return new Promise((resolve, reject) => {
        axios.get(`/api/ambil-warna`)
        .then((response) => {                              
            commit('ASSIGN_WARNA', response.data.warna);            
            commit('RANDOM_WARNA');            
            resolve(response.data)
        })
    })
},

  filter_spk({commit, state}) {        
    let cm = state.spks.data.filter(function (e) {
        if(e.status == "cm") {
           return e.status == "cm";
        }                             
    });            
    let item_cm = cm; //pagination
    let return_cm =   item_cm.slice((state.currentPage - 1) * state.perPage,
    state.currentPage * state.perPage,);     
    commit('assign_cm', return_cm);

       
    let cp = state.spks.data.filter(function (e) {
        if(e.status == "cp") {
           return e.status == "cp";
        }                             
    });             
    let item_cp = cp; //pagination
    let return_cp =   item_cp.slice((state.currentPage - 1) * state.perPage,
    state.currentPage * state.perPage,);     
    commit('assign_cp', return_cp);
       
      
    let cs = state.spks.data.filter(function (e) {
        if(e.status == "cs") {
           return e.status == "cs";
        }                             
    });            
    let item_cs = cs; //pagination
    let return_cs =   item_cs.slice((state.currentPage - 1) * state.perPage,
    state.currentPage * state.perPage,);     
    commit('assign_cs', return_cs);
       

    let csd = state.spks.data.filter(function (e) {
        if(e.status == "csd") {
           return e.status == "csd";
        }                             
    });           
    let item_csd = csd; //pagination
    let return_csd =   item_csd.slice((state.currentPage - 1) * state.perPage,
    state.currentPage * state.perPage,);     
    commit('assign_csd', return_csd);
       

},
searching_spk({commit, state}, payload) { 
             
    let cm = state.spks.data.filter(function (e) {
      if(e.status == "cm") {
         return e.status == "cm";
      }                             
  });    

  let data_cm = cm;
  if (payload != '') {
      data_cm = data_cm.filter((item) => {
      return item.nama_pemesan
        .toUpperCase()
        .includes(payload.toUpperCase())
      })      
        commit('assign_cm', data_cm);
    }	 else {
      commit('assign_cm', cm);
    } 

    /////////////////////////////
    let cp = state.spks.data.filter(function (e) {
      if(e.status == "cp") {
         return e.status == "cp";
      }                             
  });    

  let data_cp = cp;
  if (payload != '') {
      data_cp = data_cp.filter((item) => {
      return item.nama_pemesan
        .toUpperCase()
        .includes(payload.toUpperCase())
      })      
        commit('assign_cp', data_cp);
    }	 else {
      commit('assign_cp', cp);
    } 
    ////////////////////////
    let cs = state.spks.data.filter(function (e) {
      if(e.status == "cs") {
         return e.status == "cs";
      }                             
  });    

  let data_cs = cs;
  if (payload != '') {
      data_cs = data_cs.filter((item) => {
      return item.nama_pemesan
        .toUpperCase()
        .includes(payload.toUpperCase())
      })      
        commit('assign_cs', data_cs);
    }	 else {
      commit('assign_cs', cs);
    } 



},


searching_nota({commit, state}, payload) { 
             
  let cm = state.spks.data.filter(function (e) {
    if(e.status == "cm") {
       return e.status == "cm";
    }                             
});    

let data_cm = cm;
if (payload != '') {
    data_cm = data_cm.filter((item) => {
      if(item.no_nota == payload) {
        return item.no_nota   
      }           
    })      
      commit('assign_cm', data_cm);
  }	 else {
    commit('assign_cm', cm);
  } 

  /////////////////////////////
  let cp = state.spks.data.filter(function (e) {
    if(e.status == "cp") {
       return e.status == "cp";
    }                             
});    

let data_cp = cp;
if (payload != '') {
    data_cp = data_cp.filter((item) => {
      if(item.no_nota == payload) {
        return item.no_nota   
      }           
    })    
      commit('assign_cp', data_cp);
  }	 else {
    commit('assign_cp', cp);
  } 
  ////////////////////////
  let cs = state.spks.data.filter(function (e) {
    if(e.status == "cs") {
       return e.status == "cs";
    }                             
});    

let data_cs = cs;
if (payload != '') {
    data_cs = data_cs.filter((item) => {
      if(item.no_nota == payload) {
        return item.no_nota   
      }           
    })     
      commit('assign_cs', data_cs);
  }	 else {
    commit('assign_cs', cs);
  } 



},
    
  gabung_spk ({dispatch}, payload) {      
    return new Promise((resolve, reject) => {
      axios.post(`/api/gabung-spk`, payload)
      .then((response) => {       
            dispatch('get_spk');
            resolve(response.data);
                  
      })
     })
  },
    submit_spk ({commit, dispatch, state}) {      
      return new Promise((resolve, reject) => {
        axios.post(`/api/spk`, state.spk)
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
              
              commit('ASSIGN_FORM', response.data.data)
              resolve(response.data)
          })
      })
    },   
    update_spk({ commit, state, dispatch }, payload) {
      return new Promise((resolve, reject) => {
          axios.post(`/api/spk/update/${payload}`, state.spk)
          .then((response) => {
              dispatch('get_spk');
              resolve(response.data)
          })
          .catch((error) => {
              if (error.response.status == 422) {
                  commit('SET_ERRORS', error.response.data.errors, { root: true })
              }
          })
      })
  } ,
    remove_spk({ dispatch }, payload) {
      return new Promise((resolve, reject) => {
          axios.delete(`/api/spk/${payload}`)
          .then((response) => {              
              dispatch('get_spk').then(() => resolve())
          })
      })
  },
  updatelabel ({dispatch, state}) {      
    return new Promise((resolve, reject) => {
      axios.post(`/api/spk-updatelabel`, state.spk)
      .then((response) => {       
       dispatch('get_spk');
       resolve(response.data)
                  
      })
     })
  },
  handle_spk ({dispatch}, payload) {     //handel siapa aja yang mengerjakan     
    return new Promise((resolve, reject) => {
      axios.post(`/api/spk-handlespk/${payload.id}`, payload)
      .then((response) => {            
       dispatch('get_spk');
       resolve(response.data)
                  
      })
     })
  },
  query_data ({commit}) {
      return new Promise((resolve, reject) => {
          axios.get(`/api/query_data`)
          .then((response) => {
              console.log(response.data.data);
              commit('MUAT_DATA', response.data)              
              resolve(response.data)
          })
      })
  },  
  jadikan_csd({dispatch}) {      
    return new Promise((resolve, reject) => {
      axios.post(`/api/jadikan-csd`)
      .then((response) => {       
            dispatch('get_spk');
            resolve(response.data);
                  
      })
     })
  }, 
  jadikan_cs({dispatch}) {      
    return new Promise((resolve, reject) => {
      axios.post(`/api/jadikan-cs`)
      .then((response) => {       
            dispatch('get_spk');
            resolve(response.data);
                  
      })
     })
  },

  
   
}

export default {
    namespaced: true,
    state,
    actions,
    mutations
}