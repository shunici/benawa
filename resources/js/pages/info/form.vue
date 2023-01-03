<template>
  <div>
     <div show v-if="pesan" class="info info-success" role="info">
       {{isi_pesan}}
      </div>

    <!-- <div class="form-group">
      <label for="">Deskripsi</label>
      <input type="text" class="form-control" v-model="info.deskripsi">
    </div> -->

    <vue-editor v-model="info.deskripsi"></vue-editor>

                     
 
  </div>
</template>

<script>

import {mapState, mapActions, mapMutations} from 'vuex'

  export default {
    props : ['isi_pesan'],
    name : 'forminfo',
    created(){            
        if(this.$route.name == "info.edit") {
          this.edit_info(this.$route.params.id).then( (res) => {
           
           
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
         ...mapState('info_stores', {
            info : state=> state.info,
            warnaBG : state=> state.warnaBG,
              icon : state=> state.icon,             
        }), 
    },
    methods: {
      ...mapMutations(['CLEAR_ERRORS']),
       ...mapMutations('info_stores', ['SET_ID_UPDATE']),
      ...mapActions('info_stores', ['submit_info', 'update_info', 'edit_info']),
       
        
  
    },
      destroyed : function(){
        this.CLEAR_ERRORS()
    }
  }
</script>

