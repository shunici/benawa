<template>
  <div>
     <div show v-if="pesan" class="alert alert-success" role="alert">
       {{isi_pesan}}
      </div>
           <div class="form-group">
                <input type="text" placeholder="masukkan nama" class="form-control"   v-model="karyawan.nama">
               
            </div>
           <div class="form-group">
                <input type="number" placeholder="masukkan Posisi" class="form-control"  v-model="karyawan.posisi">               
            </div>

        <div class="form-check form-check-inline text-uppercase">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="karyawan" id="" v-model="karyawan.jabatan" value="desainer"> desainer
          </label>
        </div>
        <div class="form-check form-check-inline text-uppercase">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="karyawan" id="" v-model="karyawan.jabatan" value="operator"> operator
          </label>
        </div>
        <div class="form-check form-check-inline text-uppercase">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="karyawan" id="" v-model="karyawan.jabatan" value="admin"> admin
          </label>
        </div>
        <div class="form-check form-check-inline text-uppercase">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="karyawan" id="" v-model="karyawan.jabatan" value="finishing"> finishing
          </label>
        </div>
       
       
    

        


 
  </div>
</template>

<script>

import {mapState, mapActions, mapMutations} from 'vuex'

  export default {
    props : ['isi_pesan'],
    name : 'formKaryawan',
    created(){
      
      
        if(this.$route.name == "karyawan.edit") {
          this.edit_karyawan(this.$route.params.id).then( (res) => {
            
           
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
         ...mapState('karyawan_stores', {
            karyawan : state=> state.karyawan
        }), 
    },
    methods: {
      ...mapMutations(['CLEAR_ERRORS']),
       ...mapMutations('karyawan_stores', ['SET_ID_UPDATE']),
      ...mapActions('karyawan_stores', ['submit_karyawan', 'update_karyawan', 'edit_karyawan']),
         
  
    },
      destroyed : function(){
        this.CLEAR_ERRORS()
    }
  }
</script>