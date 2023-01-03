<template>
    <div>
   <b-button v-b-modal.modal-1 class="btn btn-warning float-left mr-3 ml-3">BUAT LABEL</b-button> 
    
    
                            
 <b-modal id="modal-1" title="Status Cetak" size="xl" ok-only>

    <h4 ><b>Status Cetak</b></h4>
    <div class="form-check form-check-inline">
      <label class="form-check-label">
        <input v-model="spk.status" class="form-check-input" type="radio" name="status" id="" value="cm"> Cetakan Masuk
      </label>
    </div>    
    <div class="form-check form-check-inline">
      <label class="form-check-label">
        <input v-model="spk.status" class="form-check-input" type="radio" name="status" id="" value="cp"> Cetakan Pending
      </label>
    </div>    
    <div class="form-check form-check-inline">
      <label class="form-check-label">
        <input v-model="spk.status" class="form-check-input" type="radio" name="status" id="" value="cs"> Cetakan Selesai
      </label>
    </div>     
   
    <div class="form-check form-check-inline">
      <label class="form-check-label">
        <input v-model="spk.status" class="form-check-input" type="radio" name="status" id="" value="csd"> Cetakan Sudah Diambil
      </label>
    </div>      

  <br>
<h4 class="mt-5"><b>Label Cetakan</b></h4>

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
    </div> <br>

      <h4 class="mt-3"><b>Info Deskripsi</b></h4>
      
       <div class="form-group">
        <textarea class="form-control" name="" id="" cols="30" rows="10" v-model="spk.text"></textarea>
       </div>


                       



  </b-modal>



    </div>
</template>




<script>   
  import _ from 'lodash'
import {mapActions, mapState} from 'vuex' 

import moment from "moment"
moment.locale('id');  
  
    export default {
      name : 'labelStatus',
    created(){
        this.get_label();
        
    },
    data() {
        return {
            pesan_aktif : false,           
        }
    },
    computed : {
        ...mapState('spk_stores', {
                spk : state=> state.spk
            }),
        ...mapState('label_stores', {
                labels : state=> state.labels
            }),
    },
    methods : {
        ...mapActions('label_stores', ['get_label']),   
         onChange: function(e){
            var nama = e.target.value;
            var warna = e.target.id;
            this.spk.label.nama = nama;
            this.spk.label.warna = warna;                          
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
        
   
    },
}
</script>