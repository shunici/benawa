
<template>
    <div class="container mt-3">

             
                <div class="row">  
                    <div class="col-md mt-3">                   
                        <input type="text" v-model="searching" class="form-control" placeholder="Pencarian kostumer......">
                    </div>  
                    <div class="col-md mt-3">
                          <div class="form-inline">
                            <label class="mr-2">Tampil</label>
                            <select class="form-control"  v-model="perHalaman">
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="300">300</option>
                                        <option value="500">500</option>
                                        <option value="750">750</option>
                                        <option value="1000">1000</option>
                                        <option value="1500">1500</option>
                                        <option value="2000">2000</option>
                                        <option value="3000">3000</option>
                                        <option value="5000">5000</option>
                                        <option value="10000">10000</option>
                            </select>
                            <label class="ml-2">Perpage</label>
                        </div>
                    </div>  

                    <div class="col-md">
                        <div class="form-inline">
                            <label for="example-datepicker1">Mulai Tanggal</label>
                            <b-form-datepicker id="example-datepicker1" @input="mulai_tgl" class="mb-2" locale="id"></b-form-datepicker>
                        </div>
                    </div>   
                    <div class="col-md">                        
                        <div class="form-inline">
                            <label for="example-datepicker2">Akhir Tanggal</label>
                            <b-form-datepicker id="example-datepicker2" @input="akhir_tgl" class="mb-2" locale="id"></b-form-datepicker>
                        </div>
                    </div>   

                    <div class="col-md mt-3">                   
                        <input type="number" v-model="no_nota" class="form-control" placeholder="Pencarian no nota...">
                    </div>  

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

                <b-form-group>
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

                </div>
                <!-- //tutup row -->
                    <div class="form-check form-check-inline mt-2">
                    <label class="form-check-label">
                        <input v-on:change="query_karyawan($event)"   class="form-check-input" type="radio" name="desainer" id="" value=""> Kosongkan
                    </label>
                    </div>        
                    <span v-for="(row, index) in karyawan" :key="index+'karyawan'">
                        <div class="form-check form-check-inline mt-2"  v-if="row.nama" >
                        <label class="form-check-label">
                            <input v-on:change="query_karyawan($event)"   class="form-check-input" type="radio" name="desainer" id="" :value="row.nama"> {{row.nama}}
                        </label>
                        </div>                                   
                    </span>
        <div class="row mt-4">   
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-uppercase"><b>Data Cetakan {{query.kategori ? query.kategori : "semua kategori" }}</b></h3>
                    </div>
                    <div class="card-body">

                           <b-table striped hover responsive  bordered :items="spks.data" :fields="visibleFields" show-empty>
                                
                                 <template #cell(tgl)="row">
                                    <div :key="row.index">
                                        {{tgl_show(row.item.tgl)}}
                                    </div>
                                </template>
                                    <template #cell(costDesain)="row">
                                    <div :key="row.index + 'cost'">
                                            {{row.item.costDesain}}  | {{row.item.costName}} 
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
                    <th class="border-0">|</th>                
                     <th class="border-0">Nomor Nota</th>
                    <th class="border-0">:</th>
                    <th class="border-0">{{row.item.no_nota}}</th>                   
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

                                     <table class="table">
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
                                                   <span v-if="data.ukuranP">   {{data.ukuranP}} <div v-if="data.ukuranL">x</div> {{data.ukuranL}}</span>
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
                                        <button class="btn btn-success btn-sm" @click="cs_set(row.item.id)"> Ubah Status</button>
                                        <!-- <button class="btn btn-danger btn-sm" @click="hapus(row.item.id)" >Hapus</button> -->
                                    </div>
                                </template>                              

                            <template v-slot:custom-foot v-if="fields[2].visible">    
                                 <tr class="bg-secondary" >                                        
                                        <th colspan="2">Grand Total</th>
                                       
                                        <th colspan="2" class="text-right" > Rp {{rupiah(total)}},-</th>
                                        
                                        <th colspan="3">{{total | terbilang}} Rupiah</th>                                      
                                    </tr>
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
                <!-- //tutup card -->              
        </div>
        <!-- //tutup row -->
      

    </div>
</template>
<script>

import moment from "moment"
moment.locale('id'); 
import { mapActions, mapState } from 'vuex'
export default {
    created() {
        this.$store.state.spk_stores.query.status = 'csd';
        this.get_spk();
             
    },
    data() {
        return {
            fields: [
                {key: 'no_nota', label : 'Nota', sortable: true , visible: true}, 
                {key: 'nama_pemesan', label : 'Pemesan', sortable: true , visible: true}, 
                {key: 'costDesain', label : 'Cost', sortable: true, visible: false},                                    
                {key: 'kategori', label : 'Kategori', sortable: true, visible: true}, 
                {key: 'tgl', label : 'Tgl Msk', sortable: true, visible: true},                                      
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
            total : state => state.total
        }),
        ...mapState('karyawan_stores', {
            karyawans : state=> state.karyawans,        
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
             karyawan (){
                 return _.map(this.karyawans.data, function(o) {
                     if(o.jabatan == 'desainer') {                   
                        return {
                                nama: o.nama,
                                jabatan : o.jabatan,                        
                            }
                      }else {
                            return {
                                nama: '',
                                jabatan : '',                        
                            }

                      }                    

                }); 
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
        ...mapActions('spk_stores', ['get_spk', 'spk_cs', 'edit_spk', 'remove_spk']),    
        rupiah (num){
            var tes = '';
            if(num) {
            tes = num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
            }
            return tes ;

            
        },
        edit(param){
             this.$router.push({
                  name : 'transaksi.edit',
                  params : {id : param}
              })
        },   
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
        query_karyawan(e)  {
            var nama = e.target.value;       
             this.$store.state.spk_stores.query.desainer = nama;
            this.get_spk();
        }, 
        tgl_show(data)  {
                var tgl = data? data : moment();
            return moment(tgl).format('ddd, DD-MMM-YY');
         },         
        waktu_show(data)  {
                var tgl = data? data : moment();
            return moment(tgl).format('LLLL');
         }, 
        cs_set(param){                                        
              let person = prompt("Status cetakan ini kembali ke cetakan masuk ? :", "ya");
              if (person == null || person == "") {
               
              } else {
                 this.spk_cs(param);             
                 
              }
             
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
          
        hapus(param){                                        
              let person = prompt("Yakin anda menghapus file ini ? :", "ya");
              if (person == null || person == "") {
               
              } else {
                 this.remove_spk(param);
              }
             
        }, 

       
    },
    destroyed(){
         this.$store.state.spk_stores.query.status = '';
         this.get_spk();
    }

   
}
</script>
