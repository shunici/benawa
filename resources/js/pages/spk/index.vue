<template>
<div class="container-fluid">


        <div class="row">

<div class="alert alert-success alert-dismissible" v-if="pesan_aktif">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Data Tersimpan!</strong>
</div>

            <div class="col-3 ">
                    <div class="noprint">
                     <recent-kost :pemesans="data_pemesan"></recent-kost>
                     </div>
            </div>

        <div class="col-9">
        <div class="card">
                    <div class="card-header noprint">
                    <div class="card-title">                               
                         <label-cetak></label-cetak>   
  
                   <b-button-group class="float-right">
                      <b-button variant="outline-secondary" @click="simpan">
                        <b-icon icon="book" aria-hidden="true" variant="danger"></b-icon> Simpan
                      </b-button>
                      <b-button  variant="outline-secondary" @click="cetak('printArea')">
                       <b-icon icon="printer" aria-hidden="true" variant="success"></b-icon> Print & Save
                      </b-button>
                  </b-button-group>
  
                
    <div class="form-check form-check-inline mt-2">
      <label class="form-check-label">
        <input v-model="spk.kategori" class="form-check-input" type="radio" name="kategori" id="" value="Outdoor"> Outdoor
      </label>
    </div>                      
    <div class="form-check form-check-inline mt-2">
      <label class="form-check-label">
        <input v-model="spk.kategori" class="form-check-input" type="radio" name="kategori" id="" value="Versant"> Versant
      </label>
    </div>                      
    <div class="form-check form-check-inline mt-2">
      <label class="form-check-label">
        <input v-model="spk.kategori" class="form-check-input" type="radio" name="kategori" id="" value="Indoor"> Indoor
      </label>
    </div>                  
    <div class="form-check form-check-inline mt-2">
      <label class="form-check-label">
        <input v-model="spk.kategori" class="form-check-input" type="radio" name="kategori" id="" value="Merchandise"> Merchandise
      </label>
    </div>

                    </div>
                </div>
               
                <div class="card-body" id="printArea" style="height:364px">
                      <page size="A5">  
                        <div class="area_print">
                                 <tabel :produks="data_produk" :bahans="data_bahan" :pemesans="data_pemesan"></tabel>         
                         </div>
                    </page>
                        <footer-spk></footer-spk>  
                        <footer-component></footer-component>
                </div>
        </div>    <!-- //tutup card -->  


               
    </div>  <!-- //tutup col -->  
  
    </div>  <!-- //tutup row -->   

    <div class="row mb-5 text-center">
       
    </div>


</div>
</template>

<script>   
import footerComponent from '../../components/footerComponent.vue';
import footerSpk from './footerSPK.vue';

import moment from "moment"
moment.locale('id');  

  import _ from 'lodash'
import {mapActions, mapState, mapMutations} from 'vuex'
  import tabel from './tabel.vue'
    import recentKost from './recentJob.vue'
    import labelCetak from './labelCetak.vue' 
    export default {
      name : 'indexCreate',
    created(){
        this.get_data_produk();
        this.get_data_bahan();
        this.cari_pemesan();   
    },

    data() {
        return {
            pesan_aktif : false,
        
        }
    },
    computed : {
        ...mapState('produk_stores', {
                produks : state=> state.produks
            }),
             ...mapState('bahan_stores', {
                bahans : state=> state.bahans
            }),
             ...mapState('spk_stores', {
                spk : state=> state.spk,
                desainer : state=> state.spk.desainer,
            }),
             ...mapState('pemesan_stores', {
                pemesan : state => state.hasil_pemesan
            }),
        ...mapState('karyawan_stores', {           
            karyawan : state=> state.karyawan,
        }),
            data_produk (){
                 return _.map(this.produks.data, function(o) {
                   return {
                        label: o.nama,
                        code : o.satuan,
                        panjang : o.panjang,
                        lebar : o.lebar,
                        satuan : o.satuan,
                        uk_alias : o.uk_alias,
                        kategori : o.kategori,
                        produk_id : o.id,
                        bahan : JSON.parse(o.bahan),
                        ket : JSON.parse(o.ket)
                    }
                    

                }); 
            },
             data_bahan (){
                 return _.map(this.bahans.data, function(o) {
                   return {
                        label: o.nama,
                        code : o.satuan,
                        panjang : o.panjang,
                        lebar : o.lebar,
                        satuan : o.satuan,
                        uk_alias : o.uk_alias,
                        kategori : o.kategori,
                        produk_id : o.id
                    }
                    

                }); 
            },
            data_pemesan (){
                 return _.map(this.pemesan.data, function(o, index) {
                     return {
                         label : o.nama,
                         code : index,
                         nama_asli : o.nama_asli,
                         telpon : o.telpon,
                           id_kostumer : o.id_kostumer
                     }
                  
                }); 
            }
    },
    methods : {
        ...mapActions('produk_stores', ['get_data_produk']),
                ...mapActions('bahan_stores', ['get_data_bahan']),
                ...mapActions('pemesan_stores', ['cari_pemesan']),
                ...mapActions('spk_stores', ['submit_spk']),
                 ...mapMutations('spk_stores', ['RANDOM_WARNA']),

                simpan(){
                    if(this.karyawan.nama) {  
                        var kirim = {
                        nama : this.karyawan.nama,
                        ket : 'Membuat SPK',
                        waktu : moment().format('YYYY-MM-DD HH:mm:ss')
                    };
                    this.spk.user.push(kirim);                   
                    this.submit_spk();                    
                     this.pesan_aktif = true;  

                     this.spk.label.warna = '',
                     this.spk.label.nama = '',
                     this.spk.status = 'cm',

                         setTimeout(()=>{
                        this.pesan();
                        },1000);                           
                    } else {alert('anda belum terdefinisi')}
                      
                      setTimeout(()=>{
                               this.spk.user = [];     

                        },1000);                                                                         
                },
                pesan(){                    
                     this.pesan_aktif = false;    
                },
                cetak(){                    
                    window.print();    
                    // this.desainer = this.karyawan.nama;         
                    if(this.karyawan.nama) {  
                        var kirim = {
                        nama : this.karyawan.nama,
                        ket : 'Membuat SPK',
                        waktu : moment().format('YYYY-MM-DD HH:mm:ss')
                    };
                    this.spk.user.push(kirim);                   
                    this.submit_spk();                    
                     this.pesan_aktif = true;    
                         setTimeout(()=>{
                        this.pesan();
                        },1000);                             
                    } else {alert('anda belum terdefinisi')} 
                      
                      setTimeout(()=>{
                               this.spk.user = [];                        
                        },1000);   
                }
        
   
    },

    components : {
        tabel, recentKost,footerSpk, labelCetak, footerComponent
        
    }

}
</script>

<style>
@media print {
    page [size="A5"] {
        margin: 0;
        box-shadow: 0;
        width: 220mm;
        height: 160mm;
     }
        .area_print {
               width: 230mm;
        height: 160mm;
        margin-top: 86px;
        margin-left: -199px;
        transform: scaleX(1.1);
          transform: scaleY(1.2);
          
        
    }

    
    .batas_nama_file {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 

    }

   
        .table-bordered th, .table-bordered td {
            border-color: rgb(0, 0, 0)  !important ;
        }

       .noprint {
        display: none;
        width: 30cm;
        -webkit-print-color-adjust: exact;
    }
   
}

    

th, tbody,
td {
    border: 1px solid black;
}

.table-bordered th, .table-bordered td {
    border-color: rgb(0, 0, 0);
}

#nama_pemesan {
    display: inline-block;
    font-size: 19px;
    transform: scale(1.1, 3);
    font-family: "Arial Black";
    padding: 18px;

}

.tinggi {
    height: 77px;
    /* ini utk penyesuai dengan nama */
}


.card {
    border: 1px solid rgba(255, 255, 255, 0.13);
}
</style>

