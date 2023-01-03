<template>
  <div>
     <div show v-if="pesan" class="alert alert-success" role="alert">
       {{isi_pesan}}
      </div>
           <div class="form-group">
                <input type="text" placeholder="masukkan nama" class="form-control"   v-model="label.nama">
               
            </div>
           <div class="form-group">
                <input type="text" placeholder="masukkan Posisi" class="form-control"  v-model="label.posisi">               
            </div>
           <div class="form-group">
                <input type="color" placeholder="warna" class="form-control"  v-model="label.warna">               
            </div>                         
 
  </div>
</template>

<script>

import {mapState, mapActions, mapMutations} from 'vuex'

  export default {
    props : ['isi_pesan'],
    name : 'formLabel',
    created(){
      
      
        if(this.$route.name == "label.edit") {
          this.edit_label(this.$route.params.id).then( (res) => {
            
           
          } )
        }
    },
    data() {
      return {            
        show: true,      
        pesan : false
      }
    },  
    computed : {
        ...mapState(['errors']),
         ...mapState('label_stores', {
            label : state=> state.label
        }), 
    },
    methods: {
      ...mapMutations(['CLEAR_ERRORS']),
       ...mapMutations('label_stores', ['SET_ID_UPDATE']),
      ...mapActions('label_stores', ['submit_label', 'update_label', 'edit_label']),
         
  
    },
      destroyed : function(){
        this.CLEAR_ERRORS()
    }
  }
</script>