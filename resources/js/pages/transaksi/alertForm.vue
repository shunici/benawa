<template>
  <div>
   


<b-button @click="muat_edit()"  variant="outline-secondary" v-b-modal="'colep' + id_item" >
<b-icon icon="chat-right-dots-fill" aria-hidden="true" variant="success"></b-icon>
</b-button>



 <b-modal ref="my-modal"  :id="'colep' + id_item" size="lg"  title="Pesan Pop Up"  ok-only>
   
        <div :style="{'background-color' : alert.bgColor}" class="alert alert-primary alert-dismissible fade show mt-1" role="alert" v-if="alert.text">
   <b-icon :icon="alert.icon" aria-hidden="true" ></b-icon>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>          
            <strong>{{alert.text}}</strong>
        </div>
   
         

     <div class="form-group mt-3">
       <label for="sd">Pilih Icon</label> <br>
          <span @click="pilih('', 'icon')" class="btn m-0">No Color</span>
         <span class="btn m-0" v-for="(item, index) in icon" :key="index+'ic'">
           <b-icon @click="pilih(item, 'icon')" :icon="item" aria-hidden="true" ></b-icon>
          </span> 
        
     </div>

     <div class="form-group mt-3">
       <label for="w">Warna Bacgkround</label> <br>
          <span @click="pilih('', 'bg')" class="btn m-0">No Color</span>
         <span class="btn m-0" v-for="(item, index) in warnaBG" :key="index+'bg'">
           <b-icon @click="pilih(item, 'bg')" icon="bookmark-fill" aria-hidden="true" :style="{'color' : item}" ></b-icon>
          </span> 
        
     </div>
    
           <div class="form-group mt-3">
            <label for="txt">Text</label>                              
                <input type="text" class="form-control" v-model="alert.text">
            </div>
           <div class="form-group mt-3">            
                 <vue-editor v-model="alert.text_detail"></vue-editor>
            </div>
            
   <p>Label</p>
    <div class="form-check form-check-inline">
      <label class="form-check-label">
        <input v-model="spk.label.nama" class="form-check-input" type="radio" name="label" id="" value=""> Kosongkan
      </label>
    </div>    
    <div class="form-check form-check-inline" v-for="(item, index) in labels.data" :key="index+'labl'">
      <label class="form-check-label" v-on:change="onChange($event)">
        <input class="form-check-input" v-model="spk.label.nama" type="radio" name="label" :id="item.warna" :value="item.nama"> {{item.nama}}
      </label>
    </div>  

    <div class="form-group mt-3">
      <label for="lb">Custom Label</label>
        <input type="text" id="lb" class="form-control" v-model="spk.label.nama">
    </div> 
    <div class="form-group ">
      <label for="asr">warna</label>
        <input type="color" id="asr" class="form-control" v-model="spk.label.warna">
    </div>  
   
            
                          <b-form-datepicker placeholder="Buat Estimasi Waktu Ambil" id="tanggal"   v-model="waktu"  :locale="'id'"  class="mt-3"></b-form-datepicker>                                                                 
                           <b-time v-model="value" :locale="'id'"></b-time>
                           <h4>{{tgl_show(alert.estimasi)}} - {{pkl_show(alert.estimasi)}} </h4>
     
   
<div class="form-group">
   <PhotoCapture v-model="imageBase64" />
</div>

  <template #modal-footer>                     
      <b-button size="sm" variant="success" @click="id ? update() : proses()">
        {{id ? "Update" : "Buat Pesan"}}
      </b-button>      
    </template>
    
  </b-modal>

        


 
  </div>
</template>

<script>
import {PhotoCapture} from 'vue-media-recorder'
import moment from "moment"
moment.locale('id'); 
import {mapState, mapActions, mapMutations} from 'vuex'

  export default {
    props : ['id_item'],
    name : 'formalertform',
    created(){
      
     
    },
    data() {
      return {            
        show: true,                
        value : '',
        waktu : '',
          imageBase64: '',         
        
      }
    },  
    components:{
        PhotoCapture        
    },
        watch : {          
          waktu() { //properti waktu di hendel watch waktu memberikan ke vue state
            this.alert.estimasi = this.waktu;            
          },    
          value () {
              let waktu_estimasi = this.waktu + ' ' + this.value;
              this.alert.estimasi = waktu_estimasi;
          },
          imageBase64 (){         
            this.spk.foto = this.imageBase64;        
          }
        },
    computed : {
        ...mapState('karyawan_stores', {           
            karyawan : state=> state.karyawan,
        }),
        ...mapState(['errors']),
         ...mapState('alert_stores', {
            alert : state=> state.alert,
            id : state=> state.id,
             alerts : state=> state.alerts,
            warnaBG : state=> state.warnaBG,
              icon : state=> state.icon,
             
        }), 
        ...mapState('spk_stores', {          
                spk : state=> state.spk,  
        }),        
        ...mapState('label_stores', {
                labels : state=> state.labels
            }),
    },
    methods: {    
      ...mapMutations(['CLEAR_ERRORS']),
       ...mapMutations('alert_stores', ['SET_ID_UPDATE']),
      ...mapActions('alert_stores', ['get_alert','submit_alert', 'update_alert', 'edit_alert', 'cari_alert']),
       ...mapActions('spk_stores', ['get_spk', 'edit_spk', 'update_spk']),
         muat_edit(){
                this.edit_spk(this.id_item).then((res) => {                                  
                        this.alert.kategori = res.data.kategori;
                         this.alert.spk_id = res.data.id;
                         this.cari_alert(res.data.id); //cari spk_id temukan id alert

                    }) //edit_spk  

         },
          pilih(data, posisi){        
            if(posisi == 'icon') { //utk text
              this.alert.icon = data;
            }    
            if(posisi == 'bg') { //tuk bg
              this.alert.bgColor = data;
            }
            
          },          
      proses () {
          if(this.karyawan.nama) {  
          this.submit_alert();
          alert('berhasil dibuat');
                       
            var kirim = {
            nama : this.karyawan.nama,
            ket : this.alert.text,
            waktu : moment().format('YYYY-MM-DD HH:mm:ss')
            };
            this.spk.user.push(kirim); 
          this.update_spk(this.id_item);

           this.$refs['my-modal'].hide();
           this.get_alert();
             this.get_spk();

          }else {alert('anda belum terdefinisi')} 

      },        
      update () {
         if(this.karyawan.nama) {            
          this.update_alert(this.id);
          alert('berhasil diupdate');
           this.$refs['my-modal'].hide();
           this.get_alert();
             this.get_spk();
         }else {alert('anda belum terdefinisi')} 

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
         onChange: function(e){
            var nama = e.target.value;
            var warna = e.target.id;
            this.spk.label.nama = nama;
            this.spk.label.warna = warna;                          
        },    
  
    },
      destroyed : function(){
        this.CLEAR_ERRORS()
    }
  }
</script>
