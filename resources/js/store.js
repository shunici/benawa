import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
import produk_stores from './stores/produk'
import bahan_stores from './stores/bahan'
import spk_stores from './stores/spk'
import data_spk_stores from './stores/data_spk'
import pemesan_stores from './stores/pemesan'
import label_stores from './stores/labelCetak'
import alert_stores from './stores/alert'
import karyawan_stores from './stores/karyawan'
import agenda_stores from './stores/agenda'
import info_stores from './stores/info'


const store = new Vuex.Store({  
    modules : {
        produk_stores, info_stores,
        spk_stores, bahan_stores, data_spk_stores, pemesan_stores,
        label_stores, alert_stores, karyawan_stores, agenda_stores
    },


     state: {
        errors: []
     },
     
     mutations: {       
         SET_ERRORS(state, payload) {
             state.errors = payload
         },
         CLEAR_ERRORS(state) {
             state.errors = []
         }
     }
})


export default store