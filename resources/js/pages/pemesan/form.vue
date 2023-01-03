<template>
  <div>
     <div show v-if="pesan" class="alert alert-success" role="alert">
       {{isi_pesan}}
      </div>
    <form action="#">
           <div class="form-group">
                <input type="text" placeholder="masukkan nama" class="form-control"  :class="{ 'is-invalid': errors.nama }" v-model="form.nama">
                <small id="helpId" class="text-danger" v-if="errors.nama" >{{errors.nama[0]}}</small>
            </div>
              <div class="form-group">
                <input type="number" placeholder="masukkan telpon" class="form-control"  :class="{ 'is-invalid': errors.telpon }" v-model="form.telpon">
                <small id="helpId" class="text-danger" v-if="errors.telpon" >{{errors.telpon[0]}}</small>
            </div>
         
         

        <div class="row">
           <div class="col">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="kategori" id="kateogri1" value="umum" v-model="form.kategori">
                          <label class="form-check-label" for="kateogri1">Umum</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="kategori" id="kategori2" value="percetakan" v-model="form.kategori">
                          <label class="form-check-label" for="kategori2">Percetakan</label>
                        </div>                    
              </div>            
        </div>
        <!-- tutup row -->     
        <br>
           <div class="form-group">                        
                <label for="">Inisial</label>
                   <input type="text" v-model="inisial" class="form-control">
                 <button class="btn btn-info"  v-on:click.prevent="tambah()">Tambah</button>
            </div>
          <div class="form-group">
            <!-- lopping array untuk bahan yang dikirim -->
                <div v-for="(row, index) in form.inisial" :key="index"> 
                    <h6>                       
                        <div class="d-inline-block">{{row.nama}}</div>                        
                        <span class=" btn btn-danger badge badge-danger" @click="hapus(index)">Hapus</span>
                    </h6>
                </div>
          </div> 
    </form>
    
  </div>
</template>

<script>

import {mapState, mapActions, mapMutations} from 'vuex'

  export default {
    props : ['isi_pesan'],
    name : 'formPemesan',
    created(){
        if(this.$route.name == "pemesan.edit") {
          this.edit_data_pemesan(this.$route.params.id).then( (res) => {
            console.log('edit data')
              this.form = {
                nama : res.data.nama,
                  inisial : res.data.inisial ? JSON.parse(res.data.inisial) : [],
                  telpon : res.data.telpon,         
                  kategori : res.data.kategori                
              }
          } )
        }
    },
    data() {
      return {
        inisial : '',
        form: {
         nama : '',
          inisial : [],
          telpon : '',          
          kategori : ''          
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
       ...mapMutations('pemesan_stores', ['SET_ID_UPDATE']),
      ...mapActions('pemesan_stores', ['submit_data_pemesan', 'update_data_pemesan', 'edit_data_pemesan']),

      proses(){          
          //pada array diatas akan dibuat id nya di controllernya, id berfungsi untuk menyamakan dengan pemesan
        if(this.$route.name == "pemesan.add"){     
              this.submit_data_pemesan(this.form).then(() => {
                this.pesan = true   
                  setTimeout( () => this.$router.push({name : 'pemesan.data'}), 1000);     
            }) 

        }else if(this.$route.name ==  "pemesan.edit") {   
            this.SET_ID_UPDATE(this.$route.params.id);
            this.update_data_pemesan(this.form).then(() => {             
                this.pesan = true   
                  setTimeout( () => this.$router.push({name : 'pemesan.data'}), 1000);     
            }) 
        }
      },
      tambah(){
     
        
        this.form.inisial.push({
          pemesan_id : null, nama : this.inisial
        });
        this.inisial  = '';
      },
      hapus(param){
          this.form.inisial.splice(param, 1);     
      }
  
    },
      destroyed : function(){
        this.CLEAR_ERRORS()
    }
  }
</script>