<template>
<div class="container-fluid">



 
<h2 class="text-center text-uppercase mt-3">Agenda Kerja admin </h2>

<div class="row mb-3 mt-3 d-flex justify-content-center text-center">
    <div class="col-12">
        
<div class="form-check form-check-inline" v-b-tooltip.hover.bottom="'Pekerjaan yang sedang berlangsung'">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" v-model="cekBox.progress" name="" id="" > On Progress
    </label>
</div>

<div class="form-check form-check-inline" v-b-tooltip.hover.bottom="'Pekerjaan yang sedang dipending'">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" v-model="cekBox.pending" name="" id=""> Pending
    </label>
</div>
<div class="form-check form-check-inline" v-b-tooltip.hover.bottom="'Pekerjaan selesai, harap dihapus agar tidak ada penumpukan'">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" v-model="cekBox.selesai" name="" id=""> Selesai
    </label>
</div>
<div class="form-check form-check-inline" v-b-tooltip.hover.bottom="'Menandai kostumer yang sedang antri'">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" v-model="cekBox.antrian" name="" id=""> Antrian
    </label>
</div>
<div class="form-check form-check-inline" v-b-tooltip.hover.bottom="'Jika ingin mengopi text gunakan mode ini'">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" v-model="cekBox.drag" name="" id=""> Mode Seret
    </label>
</div>
<div class="form-check form-check-inline" v-b-tooltip.hover.bottom="'Gunakan fitur ini untuk hapus atau edit'">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" v-model="cekBox.aksi" name="" id=""> Aksi
    </label>
</div>
<div class="form-check form-check-inline" v-b-tooltip.hover.bottom="'Pemberitahuan waktu dibuat suatu tugas'">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" v-model="cekBox.waktu" name="" id=""> Waktu
    </label>
</div>
<div class="form-check form-check-inline" v-b-tooltip.hover.bottom="'Estimasi Cetakan ambil Jika Ada'">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" v-model="cekBox.estimasi" name="" id=""> Estimasi
    </label>
</div>
<div class="form-check form-check-inline" v-b-tooltip.hover.bottom="'Pemberitahuan Pesan dari Operator ke admin atau sebaliknya'">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" v-model="cekBox.alert" name="" id=""> Alert
    </label>
</div>

 
<b-button class="float-right btn btn-success" @click="segarkan">
  <b-icon icon="arrows-move"></b-icon> Refresh
</b-button>
<b-icon v-if="refresh_aktif" class="float-right" icon="arrow-clockwise" animation="spin-pulse" font-scale="3"></b-icon>
 
    </div> <!-- col12 -->

              <div class="alert alert-primary alert-dismissible fade show" role="alert" v-if="pesan">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  <span class="sr-only">Close</span>
                </button>
                <strong>Data Berhasil {{edit_mode ? "Dibuat" : "Diupdate"}} </strong> 
              </div>  
                      
</div>

               <alert-info></alert-info>                                                
                <b-button 
                  :class="visible ? null : 'collapsed'"
                  :aria-expanded="visible ? 'true' : 'false'"
                  aria-controls="collapse-2"
                  @click="mode_insert"
                 class=" btn btn-secondary m-1 mt-3 mb-3">Buat Tugas Baru</b-button>

  <!-- Element to collapse -->
  <b-collapse id="collapse-2" v-model="visible">
    <b-card>
     

     <div class="form-group">
       <label for="jd">Judul</label>
       <input id="jd" type="text" v-model="agenda.nama" class="form-control" placeholder="Title" v-on:keyup.enter="insert">              
     </div>
     <div class="form-group">
       <label for="des">Deskripsi</label>
     <vue-editor v-model="agenda.deskripsi"></vue-editor>
     </div>
     <div class="form-group">
       <label for="es">Estimasi (Opsional)</label>
           <b-form-datepicker id="tanggal" v-model="waktu"     :locale="'id'"  class="mb-2"></b-form-datepicker>                                      
     </div>
           <b-time v-model="value" :locale="'id'"></b-time>
      <h4 class="mt-2">{{tgl_show(agenda.estimasi)}} | {{pkl_show(agenda.estimasi)}} </h4>
     <div class="form-group mt-3">
       <label for="w">Warna Papan</label> <br>
          <span @click="pilih_warna('')" class="btn m-0">No Color</span>
         <span class="btn m-0" v-for="(item, index) in warna" :key="index+'warna'">
           <b-icon @click="pilih_warna(item)" icon="bookmark-fill" aria-hidden="true" :style="{'color' : item}" ></b-icon>
          </span> 
          <div style="widht : 100%; height : 100px" :style="{'background-color' : agenda.warna}"></div>
     </div>

<h4 class="mt-5"><b>Label Cetakan</b></h4>

    <div class="form-check form-check-inline">
      <label class="form-check-label">
        <input v-model="agenda.label.nama" class="form-check-input" type="radio" name="label" id="" value=""> Kosongkan
      </label>
    </div>    
    <div class="form-check form-check-inline" v-for="(item, index) in labels.data" :key="index+'labl'">
      <label class="form-check-label" v-on:change="onChange($event)">
        <input class="form-check-input" v-model="agenda.label.nama" type="radio" name="label" :id="item.warna" :value="item.nama"> {{item.nama}}
      </label>
    </div>  

                         
          
<div class="form-group">
   <PhotoCapture v-model="imageBase64" />
</div>         

    <button class="float-right btn btn-success" @click="edit_mode ? update() : insert()">{{edit_mode ? 'Update Data' : 'Buat Data'}}</button>

    </b-card>
  </b-collapse>








     

 <b-card-group deck>  
     
   
    <b-card  header-tag="header" footer-tag="footer" v-if="cekBox.progress">
      <template #header>      
        <h6 class="float-left mt-2 text-uppercase "> <b>progress</b> <span class="badge badge-warning"> {{progress.length}}</span> </h6>           
      </template>

      <b-card-text>
        <draggable v-model="item_progress"  group="items" v-bind="dragOptions"  @change="log">    
          <div v-for="(item, index) in progress" :key="index + 'progress'" >   
        <div :style="{'background-color' : item.warna}"  class="list-group-item table-hover list-group-item-action text-left"        
          v-b-toggle="index+'c'" >             
          <span class="badge badge-secondary">{{index+1}}</span>
         <span class="text-uppercase"><b>{{item.nama}}</b></span>                 
  
         
            
                        
                   <b-button-group class="float-right" v-if="cekBox.aksi">
                      <b-button class="btn btn-default btn-sm" variant="outline-secondary"  @click="edit(item.id)">
                        <b-icon icon="pencil-square" aria-hidden="true"></b-icon> 
                      </b-button>
                      <b-button class="btn btn-default btn-sm"  variant="outline-secondary" @click="hapus(item.id)">
                       <b-icon icon="trash-fill" aria-hidden="true"></b-icon> 
                      </b-button>
                  </b-button-group>
                    <span v-if="item.label.nama" :style="{'background-color' : item.label.warna, 'font-size' : '12px'}" class="badge  text-uppercase float-right"> {{item.label.nama}}</span>     <br> 
                       <p v-if="cekBox.waktu" v-b-tooltip.hover.top=" 'dibuat pada hari ' + tgl_show(item.created_at) +' ' + pkl_show(item.created_at)">dibuat {{dibuat(item.created_at)}}  </p>                                                                                 
                    <timer-waktu v-if="item.estimasi && cekBox.estimasi" :estimasi="item.estimasi"></timer-waktu>
                         <button v-if="item.deskripsi"  class=" btn btn-default btn-sm float-right"> Selengkapnya...</button>
                    <p>Created by {{item.user1}} | <span v-if="item.user2">Handled by {{item.user2}} {{dibuat(item.updated_at)}} </span>   </p>               
            
        </div>
        <b-collapse :id="index+'c'"  class="mt-2">           
          <span v-html="item.deskripsi"></span>
                        <img v-if="item.foto" :src="item.foto" alt="Girl in a jacket" width="500"> 
    <button v-b-tooltip.hover.top="'Definisikan diri anda, kleim tugas ini. bila admin berotasi, kleim kembali tugas ini atau tanyakan kepada user terakhir'" @click="handling(item.id)" class="btn btn-success btn-sm float-right"> Handle</button> <br>
           <p class="border-0 text-left">Dibuat pada hari {{tgl_show(item.created_at)}} - {{pkl_show(item.created_at)}} | Estimasi  {{tgl_show(item.estimasi)}} - {{pkl_show(item.estimasi)}}</p>   

           
        </b-collapse>
        </div> <!-- looping -->
        </draggable> 

      </b-card-text>           
    </b-card> <!-- progress -->

    <b-card  header-tag="header" footer-tag="footer" v-if="cekBox.pending">
      <template #header>      
        <h6 class="float-left mt-2 text-uppercase "> <b>pending</b> <span class="badge badge-warning"> {{pending.length}}</span> </h6>           
      </template>

      <b-card-text>
        <draggable v-model="item_pending"  group="items" v-bind="dragOptions"  @change="log">    
          <div v-for="(item, index) in pending" :key="index + 'pending'" >   
        <div :style="{'background-color' : item.warna}"  class="list-group-item table-hover list-group-item-action text-left"        
          v-b-toggle="index+'c'" >             
          <span class="badge badge-secondary">{{index+1}}</span>
         <span class="text-uppercase"><b>{{item.nama}}</b></span>                 
  
         
            
                        
                   <b-button-group class="float-right" v-if="cekBox.aksi">
                      <b-button class="btn btn-default btn-sm" variant="outline-secondary"  @click="edit(item.id)">
                        <b-icon icon="pencil-square" aria-hidden="true"></b-icon> 
                      </b-button>
                      <b-button class="btn btn-default btn-sm"  variant="outline-secondary" @click="hapus(item.id)">
                       <b-icon icon="trash-fill" aria-hidden="true"></b-icon> 
                      </b-button>
                  </b-button-group>
                    <span v-if="item.label.nama" :style="{'background-color' : item.label.warna, 'font-size' : '12px'}" class="badge  text-uppercase float-right"> {{item.label.nama}}</span>     <br> 
                       <p v-if="cekBox.waktu" v-b-tooltip.hover.top=" 'dibuat pada hari ' + tgl_show(item.created_at) +' ' + pkl_show(item.created_at)">dibuat {{dibuat(item.created_at)}}  </p>                                                                                 
                    <timer-waktu v-if="item.estimasi && cekBox.estimasi" :estimasi="item.estimasi"></timer-waktu>
                         <button v-if="item.deskripsi"  class=" btn btn-default btn-sm float-right"> Selengkapnya...</button>
                    <p>Created by {{item.user1}} | <span v-if="item.user2">Handled by {{item.user2}} {{dibuat(item.updated_at)}} </span>   </p>               
            
        </div>
        <b-collapse :id="index+'c'"  class="mt-2">     
          <span v-html="item.deskripsi"></span>
              <img v-if="item.foto" :src="item.foto" alt="Girl in a jacket" width="500"> 
    <button v-b-tooltip.hover.top="'Definisikan diri anda, kleim tugas ini. bila admin berotasi, kleim kembali tugas ini atau tanyakan kepada user terakhir'" @click="handling(item.id)" class="btn btn-success btn-sm float-right"> Handle</button> <br>
           <p class="border-0 text-left">Dibuat pada hari {{tgl_show(item.created_at)}} - {{pkl_show(item.created_at)}} | Estimasi  {{tgl_show(item.estimasi)}} - {{pkl_show(item.estimasi)}}</p>   

           
        </b-collapse>
        </div> <!-- looping -->
        </draggable> 

      </b-card-text>  
    </b-card> <!-- pending -->
    
    <b-card  header-tag="header" footer-tag="footer" v-if="cekBox.selesai">
      <template #header>      
        <h6 class="float-left mt-2 text-uppercase "> <b>selesai</b> <span class="badge badge-warning"> {{selesai.length}}</span> </h6>           
      </template>

      <b-card-text>
        <draggable v-model="item_selesai"  group="items" v-bind="dragOptions"  @change="log">    
          <div v-for="(item, index) in selesai" :key="index + 'selesai'" >   
        <div :style="{'background-color' : item.warna}"  class="list-group-item table-hover list-group-item-action text-left"        
          v-b-toggle="index+'c'" >             
          <span class="badge badge-secondary">{{index+1}}</span>
         <span class="text-uppercase"><b>{{item.nama}}</b></span>                 
  
         
            
                        
                   <b-button-group class="float-right" v-if="cekBox.aksi">
                      <b-button class="btn btn-default btn-sm" variant="outline-secondary"  @click="edit(item.id)">
                        <b-icon icon="pencil-square" aria-hidden="true"></b-icon> 
                      </b-button>
                      <b-button class="btn btn-default btn-sm"  variant="outline-secondary" @click="hapus(item.id)">
                       <b-icon icon="trash-fill" aria-hidden="true"></b-icon> 
                      </b-button>
                  </b-button-group>
                    <span v-if="item.label.nama" :style="{'background-color' : item.label.warna, 'font-size' : '12px'}" class="badge  text-uppercase float-right"> {{item.label.nama}}</span>     <br> 
                       <p v-if="cekBox.waktu" v-b-tooltip.hover.top=" 'dibuat pada hari ' + tgl_show(item.created_at) +' ' + pkl_show(item.created_at)">dibuat {{dibuat(item.created_at)}}  </p>                                                                                 
                    <timer-waktu v-if="item.estimasi && cekBox.estimasi" :estimasi="item.estimasi"></timer-waktu>
                         <button v-if="item.deskripsi"  class=" btn btn-default btn-sm float-right"> Selengkapnya...</button>
                    <p>Created by {{item.user1}} | <span v-if="item.user2">Handled by {{item.user2}} {{dibuat(item.updated_at)}} </span>   </p>               
            
        </div>
        <b-collapse :id="index+'c'"  class="mt-2">           
          <span v-html="item.deskripsi"></span>
                        <img v-if="item.foto" :src="item.foto" alt="Girl in a jacket" width="500"> 
    <button v-b-tooltip.hover.top="'Definisikan diri anda, kleim tugas ini. bila admin berotasi, kleim kembali tugas ini atau tanyakan kepada user terakhir'" @click="handling(item.id)" class="btn btn-success btn-sm float-right"> Handle</button> <br>
           <p class="border-0 text-left">Dibuat pada hari {{tgl_show(item.created_at)}} - {{pkl_show(item.created_at)}} | Estimasi  {{tgl_show(item.estimasi)}} - {{pkl_show(item.estimasi)}}</p>   

           
        </b-collapse>
        </div> <!-- looping -->
        </draggable> 

      </b-card-text>  
    </b-card> <!-- selesai -->
    
    <b-card  header-tag="header" footer-tag="footer" v-if="cekBox.antrian">
      <template #header>      
        <h6 class="float-left mt-2 text-uppercase "> <b>antrian</b> <span class="badge badge-warning"> {{antrian.length}}</span> </h6>           
      </template>

      <b-card-text>
        <draggable v-model="item_antrian"  group="items" v-bind="dragOptions"  @change="log">    
          <div v-for="(item, index) in antrian" :key="index + 'antrian'" >   
        <div :style="{'background-color' : item.warna}"  class="list-group-item table-hover list-group-item-action text-left"        
          v-b-toggle="index+'c'" >             
          <span class="badge badge-secondary">{{index+1}}</span>
         <span class="text-uppercase"><b>{{item.nama}}</b></span>                 
  
         
            
                        
                   <b-button-group class="float-right" v-if="cekBox.aksi">
                      <b-button class="btn btn-default btn-sm" variant="outline-secondary"  @click="edit(item.id)">
                        <b-icon icon="pencil-square" aria-hidden="true"></b-icon> 
                      </b-button>
                      <b-button class="btn btn-default btn-sm"  variant="outline-secondary" @click="hapus(item.id)">
                       <b-icon icon="trash-fill" aria-hidden="true"></b-icon> 
                      </b-button>
                  </b-button-group>
                    <span v-if="item.label.nama" :style="{'background-color' : item.label.warna, 'font-size' : '12px'}" class="badge  text-uppercase float-right"> {{item.label.nama}}</span>     <br> 
                       <p v-if="cekBox.waktu" v-b-tooltip.hover.top=" 'dibuat pada hari ' + tgl_show(item.created_at) +' ' + pkl_show(item.created_at)">dibuat {{dibuat(item.created_at)}}  </p>                                                                                 
                    <timer-waktu v-if="item.estimasi && cekBox.estimasi" :estimasi="item.estimasi"></timer-waktu>
                         <button v-if="item.deskripsi"  class=" btn btn-default btn-sm float-right"> Selengkapnya...</button>
                    <p>Created by {{item.user1}} | <span v-if="item.user2">Handled by {{item.user2}} {{dibuat(item.updated_at)}} </span>   </p>               
            
        </div>
        <b-collapse :id="index+'c'"  class="mt-2">           
          <span v-html="item.deskripsi"></span>
                        <img v-if="item.foto" :src="item.foto" alt="Girl in a jacket" width="500"> 
    <button v-b-tooltip.hover.top="'Definisikan diri anda, kleim tugas ini. bila admin berotasi, kleim kembali tugas ini atau tanyakan kepada user terakhir'" @click="handling(item.id)" class="btn btn-success btn-sm float-right"> Handle</button> <br>
           <p class="border-0 text-left">Dibuat pada hari {{tgl_show(item.created_at)}} - {{pkl_show(item.created_at)}} | Estimasi  {{tgl_show(item.estimasi)}} - {{pkl_show(item.estimasi)}}</p>   

           
        </b-collapse>
        </div> <!-- looping -->
        </draggable> 

      </b-card-text>  
    </b-card> <!-- antrian -->
  </b-card-group>


<footer-component></footer-component>    

  </div>
</template>
<script>
import {PhotoCapture} from 'vue-media-recorder'
import alertInfo from './alert.vue';
import moment from "moment"
moment.locale('id'); 
import footerComponent from '../../components/footerComponent.vue';
import timerWaktu from '../../components/timer.vue'
import {mapActions, mapState, mapMutations} from 'vuex'

       import draggable from 'vuedraggable'
       export default {
        name: "agenda-kerja",
        display: "Two Lists",
        order: 1,
        components: {
            draggable,  footerComponent, timerWaktu, alertInfo, PhotoCapture
        },
        data() {
            return {                                  
                perPage: 10,
                currentPage: 2,               
                refresh_aktif : false,                                           
                searching : '',
                visible : false,  //collapse card edit isert
                edit_mode : false,
                pesan : false,
                tampil : '', //utk foto  
            
                value : '', //ini waktu 
                waktu : '',
                   imageBase64: '', 
            };
        },
        watch : {          
          waktu() { //properti waktu di hendel watch waktu memberikan ke vue state
            this.agenda.estimasi = this.waktu;            
          },    
          value () {
              let waktu_estimasi = this.waktu + ' ' + this.value;
              this.agenda.estimasi = waktu_estimasi;
          },
          imageBase64 (){         
            this.agenda.foto = this.imageBase64;         
          }
        },
        created (){                                       
            setInterval(() =>   this.get_agenda() , 600000); //fungsi jalan setiap 10 menit
        },
        computed : {   
        ...mapState('label_stores', {
                labels : state=> state.labels, //ini  di muat di footer
            }), 
        ...mapState('karyawan_stores', {        
            karyawan : state=> state.karyawan,
        }),      
        ...mapState('agenda_stores', {
                agendas : state=> state.agendas,
                agenda : state=> state.agenda,
                cekBox : state => state.cekBox,
                waktu_mundur : state => state.waktu_mundur,
                warna : state=> state.warna,    
                progress : state=> state.progress, 
                pending : state=> state.pending,  
                 selesai : state=> state.selesai,             
                  antrian : state=> state.antrian,  
            }),  
            item_progress : {
                      get() {
                          return this.$store.state.agenda_stores.progress
                      },
                      set(value) {
                          this.$store.commit('agenda_stores/assign_progress', value)
                      }
            }, 
            item_pending : {
                      get() {
                          return this.$store.state.agenda_stores.pending
                      },
                      set(value) {
                          this.$store.commit('agenda_stores/assign_pending', value)
                      }
            },
            item_selesai : {
                      get() {
                          return this.$store.state.agenda_stores.selesai
                      },
                      set(value) {
                          this.$store.commit('agenda_stores/assign_selesai', value)
                      }
            },
            item_antrian : {
                      get() {
                          return this.$store.state.agenda_stores.antrian
                      },
                      set(value) {
                          this.$store.commit('agenda_stores/assign_antrian', value)
                      }
            },
          
          dragOptions() { //fungsi nya pabila cekbox di klik maka drag tidk jalan
            return {
              animation: 0,
              group: "description",
              disabled: !this.cekBox.drag,
              ghostClass: "ghost"
          };
        },

        },
         methods: {      
           ...mapActions('agenda_stores', ['get_agenda', 'gabung_agenda', 'submit_agenda', 'edit_agenda', 'update_agenda', 'remove_agenda']),          
             ...mapMutations('agenda_stores', ['SET_ID_UPDATE']),
              ...mapActions('alert_stores', ['get_alert']),                       
            log: function() {                 
                        let post_progress = {};
                        post_progress.progress = this.progress.map( (todo1, index )=> {
                            return {
                                id : todo1.id,
                                posisi: index,
                                nama: todo1.nama,                             
                                papan : 'progress'
                            }
                        },this);                                           

                        let post_pending = {};
                        post_pending.pending = this.pending.map( (todo2, index) => {
                            return {
                                id : todo2.id,
                                posisi: index,
                                nama: todo2.nama,                                                           
                                papan : 'pending'
                            }
                        },this);   

                        let post_selesai = {};
                        post_selesai.selesai = this.selesai.map( (todo2, index) => {
                            return {
                                id : todo2.id,
                                posisi: index,
                                nama: todo2.nama,                                                           
                                papan : 'selesai'
                            }
                        },this);   

                        let post_antrian = {};
                        post_antrian.antrian = this.antrian.map( (todo2, index) => {
                            return {
                                id : todo2.id,
                                posisi: index,
                                nama: todo2.nama,                                                           
                                papan : 'antrian'
                            }
                        },this);   

                          let list1 = post_progress.progress;
                          let list2 = post_pending.pending;
                           let list3 = post_selesai.selesai;
                            let list4 = post_antrian.antrian;
                       
                          let gabungan = list1.concat(list2, list3, list4);
                  
                          //pengabungan semua
                          let gabung = {};
                          gabung = gabungan.map( (tes, index) => {
                            return {
                                id : tes.id,
                                posisi: index,
                                nama: tes.nama,                                
                                papan : tes.papan
                            }
                          },this);                                                                                  
                         
                            this.gabung_agenda(gabung)                          
            },
              hapus (id){
                
              let person = prompt("Yakin anda menghapus file ini ? :", "ya");
              if (person == null || person == "") {               
              } else {
                  this.remove_agenda(id);
                   this.get_agenda();
              }
         
              },
              handling(id) { //edit scara sluruh secara diam diam untuk hndling by aja                           
                     this.edit_agenda(id);                      
              if(this.karyawan.nama) {
              this.SET_ID_UPDATE(id); //kirim id ke vuex
                          setTimeout(function () {
                      this.agenda.user2 = this.karyawan.nama; //handly by
                          this.update_agenda();
                              this.get_agenda();
                        }.bind(this), 1000)
              }else {alert('anda belum terdefini')}
                      
                          
                  
              },
              edit(id) {                 
                this.edit_mode = true;     //aktifkan tombol utk fungsi update
                this.visible = true;
                this.edit_agenda(id);             
                this.SET_ID_UPDATE(id); //kirim id ke vuex
                this.tampil = this.agenda.foto;
                this.waktu = this.agenda.estimasi;           
                
              },
              insert(){              
                if(this.karyawan.nama) {  
                  
                this.agenda.user1 = this.karyawan.nama;
                  this.submit_agenda();
                   this.get_agenda();
                    this.visible = !this.visible;
                    this.tampil = "";
                    this.pesan = true
                } else {alert('anda belum terdefinisi')}    
                setTimeout(function () { this.pesan = false }.bind(this), 3000)

               
              },
              update(){
                 this.agenda.user2 = this.karyawan.nama; //handly by
               this.update_agenda();
               this.get_agenda();
              this.edit_mode = false;
                this.visible = false;
                this.pesan = true
                setTimeout(function () { this.pesan = false }.bind(this), 3000)
                this.tampil = "";
              },
              mode_insert(){ //ketika ini diklik maka mode inset, fungsi edit akan hilang
                this.agenda.user1 = this.karyawan.nama; //pada saat membuat, inisasi user1 dari vue karyawan ke agenda vuex
                this.visible = !this.visible;
                this.edit_mode = false;                
              },
              tgl_show(data){
                 var tgl = data? data : '';
                 if(tgl) {
                  return moment(tgl).format('dddd, DD-MMM-YYYY')
                 }else { return ""}
               
              },  
              pkl_show(data){
                 var pkl = data? data : '';
                 if(pkl) {
                  return moment(pkl).format('h:mm a');
                 }else { return ""}
               
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
              pilih_warna(data){                
                this.agenda.warna = data;
              },
         onChange: function(e){
            var nama = e.target.value;
            var warna = e.target.id;
            this.agenda.label.nama = nama;
            this.agenda.label.warna = warna;                          
        },     
        segarkan(){
          this.refresh_aktif = true;
           setTimeout(function () {                      
                         this.get_agenda();
                        this.get_alert();
                        this.refresh_aktif = false;
                        }.bind(this), 2000)
         
        }
           
  }


};
</script>

  
