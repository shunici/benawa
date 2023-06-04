

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)


//pages
const Home = require('./pages/home.vue').default;

import indexProduk from './pages/produk/index.vue'
import dataProduk from './pages/produk/data.vue'
import addProduk from './pages/produk/add.vue'
import editProduk from './pages/produk/edit.vue'

import indexBahan from './pages/bahan/index.vue'
import dataBahan from './pages/bahan/data.vue'
import addBahan from './pages/bahan/add.vue'
import editBahan from './pages/bahan/edit.vue'

import indexData_spk from './pages/data_spk/index.vue'
import data_spk from './pages/data_spk/data.vue'
import addData_spk from './pages/data_spk/add.vue'
import editData_spk from './pages/data_spk/edit.vue'

import indexPemesan from './pages/pemesan/index.vue'
import dataPemesan from './pages/pemesan/data.vue'
import addPemesan from './pages/pemesan/add.vue'
import editPemesan from './pages/pemesan/edit.vue'

import indexSpk from './pages/spk/index.vue'
// import dataSpk from './pages/spk/data.vue'
// import addSpk from './pages/spk/add.vue'
import editSpk from './pages/spk/edit.vue'

import transaksi_data from './pages/transaksi/data.vue'
import transaksi_csd from './pages/transaksi/csd.vue'
import transaksi_edit from './pages/transaksi/edit.vue'

import kostumer from './pages/kostumer/kostumer.vue'

import indexLabel from './pages/labelCetak/index.vue'
import dataLabel from './pages/labelCetak/data.vue'
import addLabel from './pages/labelCetak/add.vue'
import editLabel from './pages/labelCetak/edit.vue'


import indexAlert from './pages/alert/index.vue'
import dataAlert from './pages/alert/data.vue'
import addAlert from './pages/alert/add.vue'
import editAlert from './pages/alert/edit.vue'



import indexKaryawan from './pages/karyawan/index.vue'
import dataKaryawan from './pages/karyawan/data.vue'
import addKaryawan from './pages/karyawan/add.vue'
import editKaryawan from './pages/karyawan/edit.vue'

import agenda from './pages/agenda/data.vue'


import indexInfo from './pages/info/index.vue'
import dataInfo from './pages/info/data.vue'
import addInfo from './pages/info/add.vue'
import editInfo from './pages/info/edit.vue'


const routes = [   
    {
        path: '/home',
        name: 'home',
        component: Home,   
        meta: { title: 'home' }                    
    },    
    {
        path: '/agenda',
        name: 'agenda',
        component: agenda,   
        meta: { title: 'Agenda' }                    
    },    
    
    {
        path: '/kostumer/:id_kostumer?',
        name: 'kostumer',
        component: kostumer,
        meta: { title: 'data kostumer' }
    },
    {
        path: '/karyawan',
        name: 'karyawan',
        component: indexKaryawan,       
        children: [
            {
                path: '',
                name: 'karyawan.data',
                component: dataKaryawan,
                meta: { title: 'Manage karyawan' }
            },
            {
                path: 'add',
                name: 'karyawan.add',
                component: addKaryawan,
                meta: { title: 'add karyawan' }
            },
            {
                path: 'edit/:id',
                name: 'karyawan.edit',
                component: editKaryawan,
                meta: { title: 'Edit karyawan' }
            }
        ]
    },        
    {
        path: '/alert',
        name: 'alert',
        component: indexAlert,       
        children: [
            {
                path: '',
                name: 'alert.data',
                component: dataAlert,
                meta: { title: 'Manage alert' }
            },
            {
                path: 'add',
                name: 'alert.add',
                component: addAlert,
                meta: { title: 'add alert' }
            },
            {
                path: 'edit/:id',
                name: 'alert.edit',
                component: editAlert,
                meta: { title: 'Edit alert' }
            }
        ]
    },           
    {
        path: '/info',
        name: 'info',
        component: indexInfo,       
        children: [
            {
                path: '',
                name: 'info.data',
                component: dataInfo,
                meta: { title: 'Manage info' }
            },
            {
                path: 'add',
                name: 'info.add',
                component: addInfo,
                meta: { title: 'add info' }
            },
            {
                path: 'edit/:id',
                name: 'info.edit',
                component: editInfo,
                meta: { title: 'Edit info' }
            }
        ]
    },    
    {
        path: '/label',
        name: 'label',
        component: indexLabel,       
        children: [
            {
                path: '',
                name: 'label.data',
                component: dataLabel,
                meta: { title: 'Manage label' }
            },
            {
                path: 'add',
                name: 'label.add',
                component: addLabel,
                meta: { title: 'add label' }
            },
            {
                path: 'edit/:id',
                name: 'label.edit',
                component: editLabel,
                meta: { title: 'Edit label' }
            }
        ]
    },   
    {
        path: '/produk',
        name: 'produk',
        component: indexProduk,       
        children: [
            {
                path: '',
                name: 'produk.data',
                component: dataProduk,
                meta: { title: 'Manage produk' }
            },
            {
                path: 'add',
                name: 'produk.add',
                component: addProduk,
                meta: { title: 'add produk' }
            },
            {
                path: 'edit/:id',
                name: 'produk.edit',
                component: editProduk,
                meta: { title: 'Edit produk' }
            }
        ]
    },  
    {
        path: '/bahan',
        name: 'bahan',
        component: indexBahan,       
        children: [
            {
                path: '',
                name: 'bahan.data',
                component: dataBahan,
                meta: { title: 'Manage bahan' }
            },
            {
                path: 'add',
                name: 'bahan.add',
                component: addBahan,
                meta: { title: 'add bahan' }
            },
            {
                path: 'edit/:id',
                name: 'bahan.edit',
                component: editBahan,
                meta: { title: 'Edit bahan' }
            }
        ]
    },
    {
        path: '/data_spk',
        name: 'data_spk',
        component: indexData_spk,       
        children: [
            {
                path: '',
                name: 'data_spk.data',
                component: data_spk,
                meta: { title: 'Manage data_spk' }
            },
            {
                path: 'add',
                name: 'data_spk.add',
                component: addData_spk,
                meta: { title: 'add data_spk' }
            },
            {
                path: 'edit/:id',
                name: 'data_spk.edit',
                component: editData_spk,
                meta: { title: 'Edit data_spk' }
            }
        ]
    },
     {
        path: '/pemesan',
        name: 'pemesan',
        component: indexPemesan,       
        children: [
            {
                path: '',
                name: 'pemesan.data',
                component: dataPemesan,
                meta: { title: 'Manage pemesan' }
            },
            {
                path: 'add',
                name: 'pemesan.add',
                component: addPemesan,
                meta: { title: 'add pemesan' }
            },
            {
                path: 'edit/:id',
                name: 'pemesan.edit',
                component: editPemesan,
                meta: { title: 'Edit pemesan' }
            }
        ]
    },
    
    {
        path: '/spk/edit/:id',
        name: 'spk.edit',
        component: editSpk,
        meta: { title: 'Edit SPK' }
    },
    {
       path: '/spk',
       name: 'spk',
       component: indexSpk, 
       meta: { title: 'Buat SPK' }      
      
   },
    {
        path: '/data-spk',
        name: 'transaksi.data',
        component: transaksi_data,
        meta: { title: 'data transaksi' }
    },
    {
        path: '/data-csd',
        name: 'transaksi.csd',
        component: transaksi_csd,
        meta: { title: 'data transaksi' }
    },
    {
        path: 'edit/:id',
        name: 'transaksi.edit',
        component: transaksi_edit,
        meta: { title: 'Edit transaksi' }
    }
]

const router = new VueRouter ({
    mode : 'history',      
    routes : routes,
    linkActiveClass : 'active',
});
router.beforeEach((to, from, next) => {
    document.title = to.meta.title

    next()
});

export default router