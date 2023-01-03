<template>
  <div>
     <div show v-if="pesan" class="alert alert-success" role="alert">
       {{isi_pesan}}
      </div>


      
           <div class="form-group">
                <input type="text" placeholder="nama lain bahan" class="form-control"  v-model="form.nama_alias">
               
            </div>

           <div class="form-group">
                <input type="text" placeholder="masukkan nama bahan" class="form-control"  :class="{ 'is-invalid': errors.nama }" v-model="form.nama">
                <small id="helpId" class="text-danger" v-if="errors.nama" >{{errors.nama[0]}}</small>
            </div>
         

           <div class="form-group">
                <input type="text" placeholder="uk alias jika ada" class="form-control"  :class="{ 'is-invalid': errors.nama }" v-model="form.uk_alias">
            
            </div>
        <div class="row">
              <div class="col">              
                  <input type="text" placeholder="masukkan panjang" class="form-control"  :class="{ 'is-invalid': errors.panjang }" v-model="form.panjang">
                    <small class="text-danger" v-if="errors.panjang" >{{errors.panjang[0]}}</small>
              </div>
              x
              <div class="col">
                <input type="text" placeholder="masukkan lebar" class="form-control"  :class="{ 'is-invalid': errors.lebar }" v-model="form.lebar">
                    <small class="text-danger" v-if="errors.lebar" >{{errors.lebar[0]}}</small>
              </div>   
                <div class="col">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="satuan" id="inlineRadio1" value="cm" v-model="form.satuan">
                          <label class="form-check-label" for="inlineRadio1">cm</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="satuan" id="inlineRadio2" value="mm" v-model="form.satuan">
                          <label class="form-check-label" for="inlineRadio2">mm</label>
                        </div>                    
              </div>                                      
        </div>
        <!-- tutup row -->     
        
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="kategori" id="kateogri1" value="outdoor" v-model="form.kategori">
                          <label class="form-check-label" for="kateogri1">Outdoor</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="kategori" id="kategori2" value="indoor" v-model="form.kategori">
                          <label class="form-check-label" for="kategori2">Indoor</label>
                        </div>    
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="kategori" id="kategori3" value="merchandise" v-model="form.kategori">
                          <label class="form-check-label" for="kategori3">Merchandise</label>
                        </div>    
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="kategori" id="kategori4" value="offset" v-model="form.kategori">
                          <label class="form-check-label" for="kategori4">Offset</label>
                        </div>   
      
           <div class="form-group">
                <input type="text" placeholder="keterangan" class="form-control"  v-model="form.keterangan">
               
            </div>
       <vue-editor v-model="form.info_bahan"></vue-editor>

  </div>
</template>

<script>

import {mapState, mapActions, mapMutations} from 'vuex'

  export default {
    props : ['isi_pesan'],
name : 'formBahan',
    created(){
        if(this.$route.name == "bahan.edit") {
          this.edit_data_bahan(this.$route.params.id).then( (res) => {
            console.log('edit data')
              this.form = {
                nama_alias : res.data.nama_alias,
                 nama : res.data.nama,
                  panjang : res.data.panjang,
                  satuan : res.data.satuan,         
                  lebar : res.data.lebar,
                  uk_alias : res.data.uk_alias,
                   info_bahan : res.data.info_bahan,
                  keterangan : res.data.keterangan                 
              }
          } )
        }
    },
    data() {
      return {
        form: {
           nama_alias : '', 
         nama : '',
          panjang : '',
          kategori : '',          
          lebar : '',
          uk_alias : '',  
          keterangan : '',  
          info_bahan : ''      
        },       
        show: true,      
        pesan : false
      }
    },  
    computed : {
        ...mapState(['errors']),
    },
    methods: {
      ...mapMutations(['CLEAR_ERRORS']),
       ...mapMutations('bahan_stores', ['SET_ID_UPDATE']),
      ...mapActions('bahan_stores', ['submit_data_bahan', 'update_data_bahan', 'edit_data_bahan']),

      proses(){
      
        if(this.$route.name == "bahan.add"){     
              this.submit_data_bahan(this.form).then(() => {
                this.pesan = true   
                  setTimeout( () => this.$router.push({name : 'bahan.data'}), 1000);     
            }) 

        }else if(this.$route.name ==  "bahan.edit") {   
            this.SET_ID_UPDATE(this.$route.params.id);
            this.update_data_bahan(this.form).then(() => {             
                this.pesan = true   
                  setTimeout( () => this.$router.push({name : 'bahan.data'}), 1000);     
            }) 
        }
      }
  
    },
      destroyed : function(){
        this.CLEAR_ERRORS()
    }
  }
</script>