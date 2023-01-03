
<template>
    <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                                 
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
        <input v-on:change="query_kategori($event)" class="form-check-input" type="radio" name="kategori" id="" value="Dtf"> Dtf Sablon
      </label>
    </div>



                </ol>
              
     
            </nav>
              


 
<h2 class="text-center">Data Cetakan {{query.kategori}}</h2>

<div class="row mb-3 mt-3 d-flex justify-content-center text-center">
    <div class="col-12">
        
<div class="form-check form-check-inline" v-b-tooltip.hover.bottom="'SPK yang baru dibuat akan berada disini'">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="" id="" v-model="cekBox.cm"> Cetakan Masuk
    </label>
</div>

<div class="form-check form-check-inline">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="" id="" v-model="cekBox.cp"> Cetakan Pending
    </label>
</div>
<div class="form-check form-check-inline">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="" id="" v-model="cekBox.cs"> Cetakan Selesai
    </label>
</div>
<div class="form-check form-check-inline">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" v-model="drag" name="" id=""> Mode Seret
    </label>
</div>
<div class="form-check form-check-inline">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" v-model="cekBox.waktu" name="" id=""> Waktu
    </label>
</div>
<div class="form-check form-check-inline">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" v-model="cekBox.estimasi" name="" id=""> Estimasi
    </label>
</div>
<!-- <div class="form-check form-check-inline">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="" id="" v-model="cekBox.CSD"> Cetakan Sudah Diambil
    </label>
</div> -->

    </div> <!-- col12 -->
    
                     <div class="col-md-9 mt-3">
                           <input  type="text" v-model="searching" class="form-control border-end-0 border rounded-pill" placeholder="Pencarian Nama Kostumer.....">
                    </div>                                                                                 
                    <div class="col-md-3 mt-3">                                         
                        <div class="form-group form-inline" >
                            <label for="" class="mr-4">Perhalaman</label>
                            <select class="custom-select" v-model="perPage" name="" id="">                           
                                <option value="10">10</option>
                                <option value="25">25</option>     
                                  <option value="50">50</option>                           
                            </select>
                        </div>
                    </div>        
</div>

<alert-info></alert-info>     
  
<hr>

 <b-card-group deck>
    
     

    <b-card header-tag="header" footer-tag="footer"  v-if="cekBox.cm">
     <template #header>
        <h6 class="float-left mt-2 "> <b>CETAKAN MASUK</b> <span class="badge badge-warning"> {{cm.length }}</span> </h6> 
          <b-button  aria-controls="collapse-1"  @click="visible = !visible"  variant="primary" class="float-right">{{visible ? "Sembunyi" : "Detail"}}</b-button>       
      </template>
      <b-collapse id="collapse-1"  v-model="visible" >
       <draggable v-model="cm"  group="items" v-bind="dragOptions" @change="log">
        <div v-for="(item, index) in item_cm" :key="index + 'cm'" >
            <td class="list-group-item list-group-item-action  text-left m-0 table-hover"  
              v-b-toggle="index+'b'">
                <!-- <span> {{ item.id }} / {{item.posisi}} </span>  -->
                <span class="badge badge-secondary">{{index+1}}</span>
                <span><b>{{item.nama_pemesan}} </b>  </span>
                <span><b-icon icon="bookmark-fill" aria-hidden="true" :style="{'color' : item.warna}" ></b-icon></span> 
                
                
                    <span v-if="item.label.nama" :style="{'background-color' : item.label.warna, 'font-size' : '12px'}" class="badge  text-uppercase float-right "> {{item.label.nama}}</span>     <br>  
                          <p v-if="cekBox.waktu">{{tgl_show(item.created_at)}} - {{pkl_show(item.created_at)}} <br> ( {{dibuat(item.created_at)}} )</p>

                         <div  v-for="(ikem, kom) in alerts.data" :key="kom" > 
                            <span v-if="ikem.spk_id == item.id" class="badge badge-dark" :style="{'font-size' : '12px'}"  v-b-tooltip.hover.top="ikem.detil"> {{ikem.response}} </span> 
                            <span  v-if="ikem.spk_id == item.id">by  {{ikem.user2}} </span>
                             <timer-waktu v-if="ikem.spk_id == item.id && cekBox.estimasi" :estimasi="ikem.estimasi"></timer-waktu> 
                          </div>
                         
                          <br>
                            
                       
                <!-- <span class="float-right">{{item.no_nota}}   </span> -->
                 
                   
            </td>

            <b-collapse :id="index+'b'"  class="mt-2">
                <b-card> 
                   <b-button-group>
                      <b-button variant="outline-secondary" @click="edit(item.id)">
                        <b-icon icon="pencil-square" aria-hidden="true"></b-icon> Edit
                      </b-button>
                      <b-button  v-b-tooltip.hover.top="'Gunakan fitur ini untuk konfirmasi ke kostumer bila cetakan selesai atau bermasalah dst..'" variant="outline-secondary" @click="hubungi(item.nama_pemesan, item.no_wa, item.data)">
                       <b-icon icon="person-fill" aria-hidden="true" variant="success"></b-icon> Chat
                      </b-button>

                  </b-button-group>
                  
                   <b-button-group class="float-right">
                      <alert-form v-bind:id_item="item.id" v-b-tooltip.hover.top="'Fitur ini mengkonfirmasi status cetakan dari operator ke admin atau sebaliknya.'"></alert-form>
                  </b-button-group>

         <!-- <label-cetak v-bind:dataid="item.id"></label-cetak>   -->
        <br> <br>
        <h5 class="text-center" v-if="item.text"><b>{{item.text}}</b></h5>
              <table class="border-0 table-sm  table-responsive">
                <thead class="border-0">
                  <tr class="border-0">
                     <th class="border-0">Nama Pemesan</th>
                    <th class="border-0">:</th>
                    <th class="border-0">{{item.nama_pemesan}}</th>  
                    <th class="border-0">|</th>                
                     <th class="border-0">Nomor Nota</th>
                    <th class="border-0">:</th>
                    <th class="border-0">{{item.no_nota}}</th>                   
                  </tr>
                  <tr class="border-0">                   
                     <th class="border-0">Tanggal Masuk</th>
                    <th class="border-0">:</th>             
                    <td class="border-0">{{tgl_show(item.created_at)}}</td>   
                           <th class="border-0">|</th>                
                     <th class="border-0">Pukul</th>
                    <th class="border-0">:</th>
                    <td class="border-0">{{pkl_show(item.created_at)}}</td>                 
                  </tr>
                
                </thead>               
              </table>                     
              <table class="table table-bordered table-sm responsive " style="widht : 100%">
                <thead class="text-center thead-dark">
                  <tr>
                    <th  style="width:5%">No</th>
                    <th style="width:25%">NM BRG</th>
                    <th style="width: 20%">UK</th>
                    <th style="width:20%">BHN</th>
                    <th style="width: 5%">QTY</th>
                    <th style="width: 5%">FS</th>
                    <th style="width: 5%">LS</th>
                    <th style="width: 15%">KET</th>         
                  </tr>
                </thead>
                  <tbody>
                      <tr v-for="(row, andax) in item.data" :key="row.id" >                        
                           <td v-if="row.nama_brg" >    {{ andax + 1}}  </td>
                          <td v-if="row.nama_brg" class="text-left ellipsis"> <span>{{row.nama_brg}}</span>  </td>
                          <td v-if="row.nama_brg" class="text-center">   
                              <span v-if="row.ukuranP">   {{row.ukuranP}} x {{row.ukuranL}}</span>
                                          <span v-else>{{row.uk_alias}}</span>
                          </td>
                          <td v-if="row.nama_brg" class="text-center">{{row.bahan}}</td>
                              <td v-if="row.nama_brg" class="text-center">{{row.qty}} </td>
                              <td v-if="row.nama_brg" class="text-center"> <input class="largerCheckbox"  type="checkbox" v-model="row.fns"></td>
                            <td v-if="row.nama_brg" class="text-center"><input class="largerCheckbox"  type="checkbox" v-model="row.ls" ></td>
                      
                          <td v-if="row.nama_brg" class="text-left ellipsis"> <span> {{row.ket}}</span>  </td>

                      
                      </tr>
                  </tbody>
                  
                </table>  
              <table  class="table border-0 table-sm ">                 
                            <div v-for="(rows, andix) in item.data" :key="andix + 'tblbawah'" >
                            <tr style="text-align: left; vertical-align: top;"
                            v-if="rows.ket != null && rows.ket.length > 10">                                                
                              <div>Ket. No {{andix+1}} →  <strong class="text-uppercase">{{rows.ket}}</strong> </div>
                            </tr>                  
                            </div>                                                                          
              </table> 
                <div v-for="(rowsi, indax) in item.data" :key="'kets'+indax" class="d-inline">
                  <div class="d-inline" v-if="rowsi.nama_brg"> <span class="badge badge-dark">{{indax+1}}</span> {{rowsi.nama_brg}} |&ensp;</div>
                </div>
                                     

        <button class="btn btn-danger float-right mb-2 btn-sm" @click="hapus(item.id)" v-b-tooltip.hover.top="'File yang dihapus tidak akan pernah kembali'">           	
            <b-icon icon="trash-fill" aria-hidden="true"></b-icon> Hapus
        </button>
     
                    
                </b-card>
            </b-collapse>
        </div> <!-- tutuploop -->
         </draggable> 
      </b-collapse>    

        <template #footer>
                       
            <div class="float-left">
                <p><i class="fa fa-bars"></i> {{ currentPage }} item dari {{ cm.length }} total data</p>
            </div>
            <div class="float-right">                               
                    <b-pagination                       
                            v-model="currentPage"
                            :total-rows="cm.length" 
                            :per-page="perPage"
                             aria-controls="cm"
                        ></b-pagination>                               
            </div>  

        </template>                             
    </b-card> <!-- masuk -->




  </b-card-group>

<footer-component></footer-component>     

    </div>
</template>
<script>

import moment from "moment"
moment.locale('id'); 
import timerWaktu from '../../components/timer.vue'
import footerComponent from '../../components/footerComponent.vue';
import alertInfo from './alert.vue';
import alertForm from './alertForm.vue';
  import draggable from 'vuedraggable'
   import labelCetak from './labelCetak.vue' 
import { mapActions, mapState } from 'vuex'
export default {
    created() {   
     
           this.muat();
           this.get_alert();
             
    },
    data() {
        return {                       
        perPage: 10,
        currentPage: 2,
            cm : [],
            cp : [],
            cs : [],
            csd :[],
            searching : '',
            visible : true,   
            drag : true, //utk dragable                        
        }
    },
    watch: {
       
    },
    computed : {
        ...mapState('alert_stores', {
            alerts : state=> state.alerts,                     
        }), 
        ...mapState('spk_stores', {
            spks : state=> state.spks,
               spk : state=> state.spk,
            cekBox : state => state.cekBox,
                query : state=> state.query,
            
        }),      
         item_cm() {               
                let data_cm = this.cm;
              if (this.searching != '') {
                  data_cm = data_cm.filter((item) => {
                  return item.nama_pemesan
                    .toUpperCase()
                    .includes(this.searching.toUpperCase())
                  })
                    return  data_cm;
                }	

            let item = this.cm;
                let kembalikan =   item.slice((this.currentPage - 1) * this.perPage,
                this.currentPage * this.perPage,);
                return kembalikan;                     
         },       
         item_cp() {               
                let data_cp = this.cp;
              if (this.searching != '') {
                  data_cp = data_cp.filter((item) => {
                  return item.nama_pemesan
                    .toUpperCase()
                    .includes(this.searching.toUpperCase())
                  })
                    return  data_cp;
                }	

            let item = this.cp;
                let kembalikan =   item.slice((this.currentPage - 1) * this.perPage,
                this.currentPage * this.perPage,);
                return kembalikan;                     
         },            
          dragOptions() { //fungsi nya pabila cekbox di klik maka drag tidk jalan
            return {
              animation: 0,
              group: "description",
              disabled: !this.drag,
              ghostClass: "ghost"
          };
        }, 
    },
    methods : {
      ...mapActions('alert_stores', ['edit_alert', 'get_alert']),
        ...mapActions('spk_stores', ['get_spk', 'edit_spk', 'remove_spk', 'gabung_spk']),        
        hubungi (kost, wa, data) {
           
            let barang = '';
            var i =0;
           for( i;  i < data.length; i++){
                if (data[i].nama_brg) {
                  barang += data[i].nama_brg + ', ' + ' ';
                }
                
            }
              
               let teks = `Kepada Admin ${kost}, cetakan ${barang}. `

            if (wa) {
              window.location.href =  `https://wa.me/${wa}?text=${teks}`;
            }
             
        },                     
              dibuat (data){  //hanya membaca menit 
              const created = moment(data);
              const sekarang = moment();
              const diff = sekarang.diff(created);
              const diffDuration = moment.duration(diff);
              let hari  = diffDuration.days() > 0 ? diffDuration.days() + ' Hari ' : '' ;
              let jam = diffDuration.hours() > 0 ? diffDuration.hours() + ' Jam ' : '';
              let menit = diffDuration.minutes() > 0 ? diffDuration.minutes() + ' Menit ' : '';
              
              return  hari + jam + menit + ' lalu';               
              }, 
        tgl_show (data){
            var tgl = data? data : '';
            if(tgl) {
              return moment(tgl).format('dddd, DD-MMM-YYYY');   
            }else{ return "-"}                           
        },    
        pkl_show (data){          
            var tgl = data? data : '';
            if(tgl) {
              return moment(tgl).format('h:mm a')   
            }else{ return "-"}        
        },  
        estimasi (data){          
            var tgl = data? data : '';
            if(tgl) {
              return moment(tgl).fromNow();    
            }else{ return ""}        
        }, 
        hapus(param){                                        
              let person = prompt("Yakin anda menghapus file ini ? :", "ya");
              if (person == null || person == "") {
               
              } else {
                 this.remove_spk(param);
                 this.query_kategori();

              }
             
        },  
        edit(param){
             this.$router.push({
                  name : 'spk.edit',
                  params : {id : param}
              })
        }, 
          log: function() {
                
                        let post_cm = {};
                        post_cm.cm = this.cm.map( (todo1, index )=> {
                            return {
                                id : todo1.id,
                                posisi: index,
                                nama_pemesan: todo1.nama_pemesan,
                                status : 'cm'
                            }
                        });                                           

                        let post_cp = {};
                        post_cp.cp = this.cp.map( (todo2, index) => {
                            return {
                                id : todo2.id,
                                posisi: index,
                                nama_pemesan: todo2.nama_pemesan,
                                status : 'cp'
                            }
                        });     
                          let list1 = post_cm.cm;
                          let list2 = post_cp.cp;
                          let gabungan = list1.concat(list2);
                  
                          //pengabungan semua
                          let gabung = {};
                          gabung = gabungan.map( (tes, index) => {
                            return {
                                id : tes.id,
                                posisi: index,
                                nama_pemesan: tes.nama_pemesan,
                                status : tes.status
                            }
                          })                                                  
                            this.gabung_spk(gabung)
                                                
            },   
            query_kategori(event)  {
              this.muat();

            },
            muat(){
                this.get_spk().then( response => {
                        let data = response.data;
                          let cm = data.filter(function (e) {
                              if(e.status == "cm") {
                                 return e.status == "cm";
                              }
                             
                          });
                          let cp = data.filter(function (e) {                             
                              if(e.status == "cp") {
                                 return e.status == "cp";
                              }
                          });   
                          let cs = data.filter(function (e) {                           
                              if(e.status == "cs") {
                                 return e.status == "cs";
                              }
                          });      
                          let csd = data.filter(function (e) {                             
                              if(e.status == "csd") {
                                 return e.status == "csd";
                              }
                          });                                        
                     
                        this.cm = cm;
                           this.cp = cp;
                            this.cs = cs;
                            this.csd = csd;
                          //  console.log(data)
                    } );
            }

    },
        components: {
        alertForm, draggable, footerComponent, alertInfo, labelCetak, timerWaktu
        },

   
}
</script>

<style scoped>

.ellipsis {
    position: relative;
}
.ellipsis:before {
    content: '&nbsp;';
    visibility: hidden;
}
.ellipsis span {
    position: absolute;
    left: 0;
    right: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
