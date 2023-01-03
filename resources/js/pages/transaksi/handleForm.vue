<template>
    <div>
   <b-button v-b-modal="dataid + 'handle'" @click="muat_edit()" v-b-tooltip.hover.top="'Tugas ini akan dihandle oleh anda'" variant="outline-secondary"> 
    <b-icon icon="bookmark" aria-hidden="true" variant="success"></b-icon> 
       </b-button> 
    
    
                            
 <b-modal ref="my-modals-colep" :id="dataid + 'handle'" title="Tangani Tugas ini" size="xl" ok-only>
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
    <vue-editor v-model="editor"></vue-editor>


<div class="form-group">
   <PhotoCapture v-model="imageBase64" />
</div>



  <template #modal-footer>                     
      <b-button size="sm" variant="success" @click="update">
       Proses
      </b-button>      
    </template>
    


  </b-modal>



    </div>
</template>




<script>   
import {PhotoCapture} from 'vue-media-recorder'
  import _ from 'lodash'
import {mapActions, mapState} from 'vuex'  
  import moment from "moment"
moment.locale('id');  
    export default {
      name : 'handleForm',
      props: ['dataid'],
   
    data() {
        return {
            pesan_aktif : false,
            editor : 'Mengambil alih tugas ini',
               imageBase64: '',  
        }
    }, 
    components:{
        PhotoCapture        
    },
    computed : {
        ...mapState('spk_stores', {
                spk : state=> state.spk
            }),
        ...mapState('label_stores', {
                labels : state=> state.labels
            }),
        ...mapState('karyawan_stores', {           
            karyawan : state=> state.karyawan,
        }),
    },
    methods : {
       ...mapActions('spk_stores', ['get_spk', 'edit_spk', 'update_spk']),
        ...mapActions('label_stores', ['get_label']),   
         onChange: function(e){
            var nama = e.target.value;
            var warna = e.target.id;
            this.spk.label.nama = nama;
            this.spk.label.warna = warna;                          
        },    
         muat_edit(){           
                this.edit_spk(this.dataid).then((res) => {                                  
                        this.spk.label = res.data.label;                     
                    });

         },    
         update(){    
               if(this.karyawan.nama) {                
            var kirim = {
            nama : this.karyawan.nama,
            ket : this.editor,
            waktu : moment().format('YYYY-MM-DD HH:mm:ss')
            };
            this.spk.user.push(kirim);                   
                      
           this.update_spk(this.dataid);
           this.get_spk();
           this.$refs['my-modals-colep'].hide();
               }else {alert('anda belum terdefinisi')}   
         },                            
        
   
    },
    watch: {            
    imageBase64 (){         
      this.spk.foto = this.imageBase64;        
    }
    } 
}
</script>