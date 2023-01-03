<template>
  <div>
     <div show v-if="pesan" class="alert alert-success" role="alert">
       {{isi_pesan}}
      </div>


        <div :style="{'background-color' : alert.bgColor}" class="alert alert-primary alert-dismissible fade show mt-5" role="alert" v-if="alert.text">
   <b-icon :icon="alert.icon" aria-hidden="true" ></b-icon>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>          
            <strong>{{alert.text}}</strong>
        </div>
   



    <div class="form-check form-check-inline mt-2">
      <label class="form-check-label">
        <input  v-model="alert.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Outdoor"> Outdoor
      </label>
    </div>                      
    <div class="form-check form-check-inline mt-2">
      <label class="form-check-label">
        <input   v-model="alert.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Versant"> Versant
      </label>
    </div>                      
    <div class="form-check form-check-inline mt-2">
      <label class="form-check-label">
        <input   v-model="alert.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Indoor"> Indoor
      </label>
    </div>                  
    <div class="form-check form-check-inline mt-2">
      <label class="form-check-label">
        <input   v-model="alert.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Merchandise"> Merchandise
      </label>
    </div>      
    <div class="form-check form-check-inline mt-2">
      <label class="form-check-label">
        <input v-model="alert.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="admin"> Agenda Kerja Admin
      </label>
    </div>

           <div class="form-group">
            <label for="txt">Isi Pesan</label>              
                <textarea name="" id="txt" cols="20" rows="2" class="form-control" v-model="alert.text"></textarea> 
            </div>
           <div class="form-group">
               <label for="txtt">Voice Text</label>                  
                  <textarea name="" id="txtt" cols="20" rows="2" class="form-control"  v-model="alert.voiceText"></textarea>             
            </div>
           <div class="form-group">
               <label for="dd">Posisi</label>                  
                <input type="text" v-model="alert.posisi" class="form-control">
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
       
         <div class="uploader mt-5 mb-3" @paste="onPaste">                                                                
                                    <img class="img-thumbnail" v-if="tampil" :src="tampil" />                                                 
                                <input  type="file" id="filePhoto"   />                                
                            </div>  
    

        


 
  </div>
</template>

<script>

import {mapState, mapActions, mapMutations} from 'vuex'

  export default {
    props : ['isi_pesan'],
    name : 'formalert',
    created(){            
        if(this.$route.name == "alert.edit") {
          this.edit_alert(this.$route.params.id).then( (res) => {
              this.tampil = res.data.foto
           
          } )
        }
    },
    data() {
      return {            
        show: true,      
        pesan : false,
        tampil : ''
      }
    },  
    computed : {
        ...mapState(['errors']),
         ...mapState('alert_stores', {
            alert : state=> state.alert,
            warnaBG : state=> state.warnaBG,
              icon : state=> state.icon,
             
        }), 
    },
    methods: {
      ...mapMutations(['CLEAR_ERRORS']),
       ...mapMutations('alert_stores', ['SET_ID_UPDATE']),
      ...mapActions('alert_stores', ['submit_alert', 'update_alert', 'edit_alert']),
         
         onPaste(event) {
            const items = (event.clipboardData || event.originalEvent.clipboardData).items;
            let blob = null;

            for (const item of items) {
              if (item.type.indexOf('image') === 0) {
                blob = item.getAsFile();
              }
            }

            // load image if there is a pasted image
            if (blob !== null) {
              const reader = new FileReader();
              reader.onload = (evt) => {                               
                 this.tampil = evt.target.result; //utk tampil
                 this.alert.foto = evt.target.result;

              };
              reader.readAsDataURL(blob);
            }
          }, //tutup onpaste 
          pilih(data, posisi){        
            if(posisi == 'icon') { //utk text
              this.alert.icon = data;
            }    
            if(posisi == 'bg') { //tuk bg
              this.alert.bgColor = data;
            }
            
          },
  
    },
      destroyed : function(){
        this.CLEAR_ERRORS()
    }
  }
</script>

<style scoped>

    #filePhoto {
     display: none;
background-color: aqua;
    position: absolute; 
padding: 2px;
  width: 100%;
  height: 100%;
    z-index: 1;
    opacity: 0; 
    cursor: pointer;   
    left: 0;
    
}
.uploader {
  position: relative;
    height: 200px;
    border: 0.5px solid grey;
  border-style: dashed;
    
}
</style>