<template>
  <div>
     <div show v-if="pesan" class="alert alert-success" role="alert">
       {{isi_pesan}}
      </div>
    <form action="#">
           <div class="form-group">
                <input type="text" placeholder="masukkan nama" class="form-control"  :class="{ 'is-invalid': errors.nama_brg }" v-model="form.nama_brg">
                <small id="helpId" class="text-danger" v-if="errors.nama_brg" >{{errors.nama_brg[0]}}</small>
            </div>
         
           <div class="form-group">
                <input type="text" placeholder="masukkan bahan" class="form-control"  :class="{ 'is-invalid': errors.bahan }" v-model="form.bahan">
                <small id="helpId" class="text-danger" v-if="errors.bahan" >{{errors.bahan[0]}}</small>
            </div>

        <div class="row">
              <div class="col">              
                  <input type="text" placeholder="masukkan panjang" class="form-control"  :class="{ 'is-invalid': errors.ukuranP }" v-model="form.ukuranP">
                    <small class="text-danger" v-if="errors.ukuranP" >{{errors.ukuranP[0]}}</small>
              </div>
              x
              <div class="col">
                <input type="text" placeholder="masukkan lebar" class="form-control"  :class="{ 'is-invalid': errors.ukuranL }" v-model="form.ukuranL">
                    <small class="text-danger" v-if="errors.ukuranL" >{{errors.ukuranL[0]}}</small>
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
                <div class="col">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="fns1" value="1" v-model="form.fns">
                          <label class="form-check-label" for="fns1">fns</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="fns2" value="0" v-model="form.fns">
                          <label class="form-check-label" for="fns2">tdk fns</label>
                        </div>                    
              </div>  
                 <div class="col">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="ls1" value="1" v-model="form.ls">
                          <label class="form-check-label" for="ls1">ls</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="ls2" value="0" v-model="form.ls">
                          <label class="form-check-label" for="ls2">tdk ls</label>
                        </div>                    
              </div>  

                <div class="col">
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
                              
              </div>  
          
        </div>
        <!-- tutup row -->   
        <br> 
           <div class="form-group">
                <input type="text" placeholder="masukkan ukuran alias" class="form-control"  :class="{ 'is-invalid': errors.uk_alias }" v-model="form.uk_alias">
                <small id="helpId" class="text-danger" v-if="errors.uk_alias" >{{errors.uk_alias[0]}}</small>
            </div> 
              <div class="form-group">
                <input type="text" placeholder="masukkan jumlah" class="form-control"  :class="{ 'is-invalid': errors.qty }" v-model="form.qty">
                <small id="helpId" class="text-danger" v-if="errors.qty" >{{errors.qty[0]}}</small>
            </div>  

  <div class="form-group">
                <input type="text" placeholder="masukkan Keterangan" class="form-control"  :class="{ 'is-invalid': errors.ket }" v-model="form.ket">
                <small id="helpId" class="text-danger" v-if="errors.ket" >{{errors.ket[0]}}</small>
            </div>  
          <div class="form-group">
                <input type="text" placeholder="masukkan Keterangan Pesan" class="form-control"  :class="{ 'is-invalid': errors.keterangan }" v-model="form.keterangan">
                <small id="helpId" class="text-danger" v-if="errors.keterangan" >{{errors.keterangan[0]}}</small>
            </div>  
    </form>
{{form}}
  </div>
</template>

<script>

import {mapState, mapActions, mapMutations} from 'vuex'

  export default {
    props : ['isi_pesan'],
    name : 'formDataSPK',

    created(){
        if(this.$route.name == "data_spk.edit") {
          this.edit_data_spk(this.$route.params.id).then( (res) => {
            console.log('edit data')
              this.form = {
                nama_brg : res.data.nama_brg,
                  ukuranP : res.data.ukuranP,
                  ukuranL : res.data.ukuranL,         
                  bahan : res.data.bahan,
                  uk_alias : res.data.uk_alias,
                  kategori : res.data.kategori,
                  satuan : res.data.satuan,
                  qty : res.data.qty,
                  fns : res.data.fns,
                  ls : res.data.ls,
                  ket : res.data.ket,
                  keterangan : res.data.keterangan,
              }
          } )
        }
    },
    data() {
      return {
        form: {
         nama_brg : '',
          ukuranP : '',
          ukuranL : '',          
          bahan : '',
          uk_alias : '',
          kategori : '',
          qty : '',
          fns : false,
          ls : false,
          ket : '',
          keterangan : ''          
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
       ...mapMutations('data_spk_stores', ['SET_ID_UPDATE']),
      ...mapActions('data_spk_stores', ['submit_data_spk', 'update_data_spk', 'edit_data_spk']),

      proses(){
      
        if(this.$route.name == "data_spk.add"){     
              this.submit_data_spk(this.form).then(() => {
                this.pesan = true   
                  setTimeout( () => this.$router.push({name : 'data_spk.data'}), 1000);     
            }) 

        }else if(this.$route.name ==  "data_spk.edit") {   
            this.SET_ID_UPDATE(this.$route.params.id);
            this.update_data_spk(this.form).then(() => {             
                this.pesan = true   
                  setTimeout( () => this.$router.push({name : 'data_spk.data'}), 1000);     
            }) 
        }
      }
  
    },
      destroyed : function(){
        this.CLEAR_ERRORS()
    }
  }
</script>