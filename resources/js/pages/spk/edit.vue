<template>
<div class="container-fluid">


        <div class="row">

<div class="alert alert-success alert-dismissible" v-if="pesan_aktif">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Data Tersimpan!</strong>
</div>

            <div class="col-3 ">
                    <div class="noprint">
                     <recent-kost></recent-kost>
                     </div>
            </div>

        <div class="col-9">
        <div class="card">
                    <div class="card-header noprint">
                    <div class="card-title">                               
                      <button class="btn btn-default float-left mr-3" @click="$router.go(-1)">KEMBALI</button>                             
             <label-cetak></label-cetak>   
                  
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
                   <b-button-group class="float-right">
                      <b-button variant="outline-secondary" @click="simpan">
                        <b-icon icon="book" aria-hidden="true" variant="danger"></b-icon> Update
                      </b-button>
                      <b-button  variant="outline-secondary" @click="cetak('printArea')">
                       <b-icon icon="printer" aria-hidden="true" variant="success"></b-icon> Print & Update
                      </b-button>
                  </b-button-group>

                    </div>
                </div>
               
                <div class="card-body" id="printArea" style="height:364px">
                      <page size="A5">  
                        <div class="area_print">
                                 <tabel :produks="data_produk" :bahans="data_bahan" :pemesans="data_pemesan"></tabel>         
                         </div>
                    </page>
                </div>
        </div>    <!-- //tutup card -->  


               
    </div>  <!-- //tutup col -->  
    <div class="col-12">
          <footer-spk></footer-spk>   
    </div>
  
    </div>  <!-- //tutup row -->   



</div>
</template>

<script>   
import footerSpk from './footerSPK.vue';
import moment from "moment"
moment.locale('id');  

  import _ from 'lodash'
import {mapActions, mapState, mapMutations} from 'vuex'
  import tabel from './tabel.vue'
    import recentKost from './recentJob.vue'
    import labelCetak from './labelCetak.vue' 
    export default {
      name : 'editSpk',
    created(){
        this.get_data_produk();
        this.get_data_bahan();
        this.cari_pemesan();  
        
         if (this.$route.name == 'spk.edit') {           
            this.edit_spk(this.$route.params.id).then((res) => {                
              
            })
        }  
    },
    data() {
        return {
            pesan_aktif : false
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
                spk : state=> state.spk
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
                         nama_asli : o.nama_asli
                     }
                  
                }); 
            }
    },
    methods : {
        ...mapActions('produk_stores', ['get_data_produk']),
                  ...mapMutations('spk_stores', ['CLEAR_FORM']),
                ...mapActions('bahan_stores', ['get_data_bahan']),
                ...mapActions('pemesan_stores', ['cari_pemesan']),
                ...mapActions('spk_stores', ['submit_spk', 'edit_spk', 'update_spk']),                 
                simpan(){                                                              
                    if(this.karyawan.nama) {
                    var kirim = {
                        nama : this.karyawan.nama,
                        ket : 'Mengedit SPK',
                        waktu : moment().format('YYYY-MM-DD HH:mm:ss')
                    };
                    this.spk.user.push(kirim);                                              
                    this.update_spk( this.$route.params.id );   
                     this.pesan_aktif = true;    
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
                    if(this.karyawan.nama) {
                    var kirim = {
                        nama : this.karyawan.nama,
                        ket : 'Mengedit SPK',
                        waktu : moment().format('YYYY-MM-DD HH:mm:ss')
                    };
                    this.spk.user.push(kirim);                                              
                    this.update_spk( this.$route.params.id );   
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
    destroyed() {
        this.CLEAR_FORM()
    },


    components : {
        tabel, recentKost,footerSpk, labelCetak, 
        
    }

}
</script>
