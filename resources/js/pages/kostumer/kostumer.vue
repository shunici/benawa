
<template>
    <div class="mt-3">    
        <h1>{{nama_pemesan}}</h1>         
                <div class="row">  
                    <!-- <div class="col-md ">                   
                        <input type="text" v-model="searching" class="form-control" placeholder="Pencarian kostumer......">
                    </div>   -->
                       <b-button v-b-toggle.collapse-2 class="m-1">Filter</b-button>
                    <b-collapse id="collapse-2">                     
                                  
                                        <div class="form-inline">
                                            <label class="mr-2">Tampil</label>
                                            <select class="form-control"  v-model="perHalaman">
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                        <option value="150">150</option>
                                                        <option value="200">200</option>
                                                        <option value="250">250</option>
                                                        <option value="300">300</option>
                                            </select>
                                            <label class="ml-2">Perpage</label>
                                        </div>
                            

                                 
                                        <div class="form-inline">
                                            <label for="example-datepicker1">Mulai Tanggal</label>
                                            <b-form-datepicker id="example-datepicker1" @input="mulai_tgl" class="mb-2" locale="id"></b-form-datepicker>
                                        </div>
                                 
                                                    
                                        <div class="form-inline">
                                            <label for="example-datepicker2">Akhir Tanggal</label>
                                            <b-form-datepicker id="example-datepicker2" @input="akhir_tgl" class="mb-2" locale="id"></b-form-datepicker>
                                        </div>
                                 
                                    
                    </b-collapse>                

                    <div class="col-md-12 text-center">                                                                
                    <div class="form-check form-check-inline mt-2">
                    <label class="form-check-label">
                        <input v-on:change="query_kategori($event)" v-model="query.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Outdoor"> Outdoor
                    </label>
                    </div>                      
                    <div class="form-check form-check-inline mt-2">
                    <label class="form-check-label">
                        <input v-on:change="query_kategori($event)"  v-model="query.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Versant"> Versant
                    </label>
                    </div>                      
                    <div class="form-check form-check-inline mt-2">
                    <label class="form-check-label">
                        <input v-on:change="query_kategori($event)"  v-model="query.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Indoor"> Indoor
                    </label>
                    </div>                  
                    <div class="form-check form-check-inline mt-2">
                    <label class="form-check-label">
                        <input v-on:change="query_kategori($event)"  v-model="query.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Merchandise"> Merchandise
                    </label>
                    </div>                  
                    <div class="form-check form-check-inline mt-2">
                    <label class="form-check-label">
                        <input v-on:change="query_kategori($event)"  v-model="query.kategori"  class="form-check-input" type="radio" name="kategori" id="" value=""> Semua Kategori
                    </label>
                    </div>

                    </div>

                <b-form-group class="text-center">
                <b-form-checkbox
                :disabled="visibleFields.length == 1 && field.visible"
                v-for="field in fields" 
                v-model="field.visible" 
                :key="field.key"           
                name="flavour-4a"
                inline
                class="text-center">
                            {{ field.label }}
                        </b-form-checkbox>
                </b-form-group>
                        <div class="col-md text-center">
                                                                                     
                    <div class="form-check form-check-inline mt-2">
                    <label class="form-check-label">
                        <input v-on:change="query_status($event)" v-model="query.status"  class="form-check-input" type="radio" name="status" id="" value="cm"> Cetakan Masuk
                    </label>
                    </div>                      
                    <div class="form-check form-check-inline mt-2">
                    <label class="form-check-label">
                        <input v-on:change="query_status($event)"  v-model="query.status"  class="form-check-input" type="radio" name="status" id="" value="csd"> Cetakan Sudah Diambil
                    </label>
                    </div>   
                    
                        </div>

                </div>
                <!-- //tutup row -->
        <div class="row mt-4">   
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-uppercase"><b>Cetakan Masuk (CM) {{query.kategori ? query.kategori : "semua kategori" }}</b> </h4>                        
                    </div>
                   

                           <b-table striped hover responsive  bordered :items="spks.data" :fields="visibleFields" show-empty>
                                 
                                 <template #cell(cetakan_masuk)="row">
                                    <div :key="row.index">
                                        {{row.index + 1}}
                                    </div>
                                </template>
                                 <template #cell(tgl)="row">
                                    <div :key="row.index">
                                        {{tgl_show(row.item.tgl)}}
                                    </div>
                                </template>

                                 <template #cell(show_details)="row">
                                    <b-button size="sm" @click="row.toggleDetails" class="mr-2">
                                    {{ row.detailsShowing ? 'Senyapkan' : 'Tampilkan'}} Details
                                    </b-button>
                                </template>

                                 <template #row-details="row">              
                                      
                                     
              <table class="border-0 table-sm  table-responsive">
                <thead class="border-0">
                  <tr class="border-0">
                     <th class="border-0">Nama Pemesan</th>
                    <th class="border-0">:</th>
                    <th class="border-0">{{row.item.nama_pemesan}}</th>                                                                   
                  </tr>
                  <tr class="border-0">                   
                     <th class="border-0">Tanggal Masuk</th>
                    <th class="border-0">:</th>             
                    <td class="border-0">{{waktu_show(row.item.created_at)}}</td>   
                                         
                  </tr>
                  <tr class="border-0">                   
                     <th class="border-0">Keterangan</th>
                    <th class="border-0">:</th>             
                    <td class="border-0">{{row.item.text}}</td>   
                                         
                  </tr>
                
                </thead>               
              </table> 

                                     <table class="table" style="font-size: 8px;">
                                         <thead>
                                             <tr>
                                                 <th>No</th>
                                                 <th>Nama Barang</th>
                                                 <th>Bahan</th>
                                                 <th>Ukuran</th>
                                                 <th>QTY</th>
                                                 <td>Ket</td>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <tr v-for="(data, index) in row.item.data" :key="index"> 
                                                 <td v-if="data.nama_brg" >{{index+1}}</td>
                                                 <td v-if="data.nama_brg" scope="row">{{data.nama_brg}}</td>
                                                 <td v-if="data.nama_brg">{{data.bahan}}</td>
                                                 <td v-if="data.nama_brg">
                                                   <span v-if="data.ukuranP">   {{data.ukuranP}} <span v-if="data.ukuranL">x</span> {{data.ukuranL}}</span>
                                                   <span v-else>{{data.uk_alias}}</span>
                                                 </td>
                                                 <td v-if="data.nama_brg">{{data.qty}}</td>
                                                 <td v-if="data.nama_brg">{{data.ket}}</td>
                                             </tr>                                          
                                         </tbody>
                                     </table>

                      
                        <span class="badge  mr-1 mt-1" v-for="(san, sun) in row.item.user" :key=" 'in' + sun"
                        v-b-tooltip.hover.top="ket(san.nama, san.ket, san.waktu )" :style="{backgroundColor: randomColor(sun+1)}">
                            {{san.nama}}
                        </span>
                        <br>
                                    <b-button class="float-right" size="sm" @click="row.toggleDetails">Senyapkan</b-button>
                          
                                </template>
                                <template #cell(aksi)="row">
                                    <div :key="row.index">
                                        <button v-if="query.status == 'cm' " class="btn btn-success btn-sm" @click="csd_set(row.item.id)"> Ubah Status</button>                                                                                
                                        <button v-if="query.status == 'csd' " class="btn btn-success btn-sm" @click="cm_set(row.item.id)"> Ubah Status</button>           
                                    </div>
                                </template>                              

                                </b-table>

                            <div class="row">
                                <div class="col-md-6">
                                    <p v-if="spks.data"><i class="fa fa-bars"></i> {{ spks.data.length }} item dari {{ spks.meta.total }} total data</p>
                                </div>
                                <div class="col-md-6">
                                    <div class="pull-right">
                                        <b-pagination
                                            v-model="page"
                                            :total-rows="spks.meta.total"
                                            :per-page="spks.meta.per_page"
                                            aria-controls="spks"
                                            v-if="spks.data && spks.data.length > 0"
                                            ></b-pagination>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>              
                  
        </div>
        <!-- //tutup row -->
      
    <p><i>Data Automatis Terhapus setelah 3 hari. Kritik Saran Hubungi Shun</i></p>
    </div>
</template>
<script>
import Swal from 'sweetalert2'

import moment from "moment"
moment.locale('id'); 
import { mapActions, mapState } from 'vuex'
export default {
    created() {        
        this.$store.state.spk_stores.query.id_kostumer = this.$route.params.id_kostumer;
        this.$store.state.spk_stores.query.status = 'cm';
         this.edit_data_pemesan(this.$route.params.id_kostumer).then( (res) => {
             this.nama_pemesan = res.data.nama;
          } )
            
    },
    mounted(){
           setTimeout(function () {
               this.get_spk();  
               
            }.bind(this), 900)
    },
    data() {
        return {
            nama_pemesan : '',
            fields: [                
                {key: 'cetakan_masuk', label : 'CM', sortable: true , visible: true},   
                {key: 'tgl', label : 'Tgl', sortable: true, visible: true}, 
                {key: 'kategori', label : 'Kategori', sortable: true, visible: true},                        
                {key : 'show_details', label :'Detail', sortable:true, visible: true},
                {key: 'aksi', label : 'aksi', sortable: false, visible: true}, 
            ],
            searching: '',
            colorCache  : {}, //tuk keperluan warna random
        }
    },

    computed : {
        ...mapState('spk_stores', {
            spks : state=> state.spks,
            query : state=> state.query,
            hasil_data : state=> state.hasil_data,
        }),
       page : {
           get(){
                return this.$store.state.spk_stores.currentPage
           },
           set(val){
               this.$store.commit('spk_stores/SET_CURRENTPAGE', val)
           }
       },
       perHalaman :{
            get(){
                return this.$store.state.spk_stores.perPage
           },
           set(val){
               this.$store.state.spk_stores.perPage = val
           }
       },
       no_nota :{
            get(){
                return this.$store.state.spk_stores.no_nota
           },
           set(val){
               this.$store.state.spk_stores.no_nota = val
           }
       },
       visibleFields() {
        return this.fields.filter(field => field.visible)
      },
           

    },
    watch : {
        no_nota(){
            this.get_spk()
        },
        page(){
            this.get_spk()
        },
        perHalaman(){
            this.get_spk()
        },
        searching(){
            this.get_spk(this.searching)
        }
    },
    methods : {
        ...mapActions('pemesan_stores', ['edit_data_pemesan']),
        ...mapActions('spk_stores', ['get_spk', 'spk_csd','spk_cm' , 'edit_spk', 'remove_spk']),              
        mulai_tgl(param){
          this.$store.state.spk_stores.mulai_tgl = param
          this.get_spk()
        },
        akhir_tgl(param){
           this.$store.state.spk_stores.akhir_tgl = param
           this.get_spk()
        },
        query_kategori(event)  {

            this.get_spk();
        }, 
        query_status(event)  {            
            this.get_spk();
        }, 
        tgl_show(data)  {
                var tgl = data? data : moment();
            return moment(tgl).format('D-M-Y');
         },         
        waktu_show(data)  {
                var tgl = data? data : moment();
            return moment(tgl).format('LLLL');
         }, 
        csd_set(param){                                        
            Swal.fire({
            title: 'Pindahkan Cetakan',
            text: "Ke Cetakan Sudah Diambil",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oke, Pindahkan!'
            }).then((result) => {
            if (result.isConfirmed) {
               this.spk_csd(param);   
            }
            })
             
        },   
        cm_set(param){                                        
            Swal.fire({
            title: 'Pindahkan Cetakan',
            text: "Ke Cetakan Masuk",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oke, Pindahkan!'
            }).then((result) => {
            if (result.isConfirmed) {
               this.spk_cm(param);   
            }
            })
             
        }, 
        pkl_show (data){          
            var tgl = data? data : '';
            if(tgl) {
              return moment(tgl).format('h:mm a')   
            }else{ return "-"}        
        },  
        ket(nama, ket, waktu) { //keterangan pada handling
          return `${nama} ${ket} pkl : ${this.pkl_show(waktu)}`;
        },
         randomColor(id) {
            const r = () => Math.floor(256 * Math.random());
            return this.colorCache[id] || (this.colorCache[id] = `rgb(${r()}, ${r()}, ${r()})`);
          },
          

       
    },
    destroyed(){
         this.$store.state.spk_stores.query.status = '';
         this.get_spk();
    }

   
}
</script>
