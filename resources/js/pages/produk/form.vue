<template>
  <div>
     <div show v-if="pesan" class="alert alert-success" role="alert">
       {{isi_pesan}}
      </div>

           <div class="form-group">
                <input type="text" placeholder="masukkan nama" class="form-control"  :class="{ 'is-invalid': errors.nama }" v-model="form.nama">
                <small id="helpId" class="text-danger" v-if="errors.nama" >{{errors.nama[0]}}</small>
            </div>
                
        <div class="form-group">
                <input type="text" placeholder="masukkan ukuran alias" class="form-control"  :class="{ 'is-invalid': errors.uk_alias }" v-model="form.uk_alias">
                <small id="helpId" class="text-danger" v-if="errors.uk_alias" >{{errors.uk_alias[0]}}</small>
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
        <br>
          <div class="form-group">                        
                <label for="">Bahan</label>
                <select class="form-control" name="" id="" v-model="terpilih_bahan">                  
                  <option v-for="(bahan, index) in bahans.data" :key="index" :value="{id : bahan.id, nama : bahan.nama, panjang : bahan.panjang,lebar : bahan.lebar, uk_alias : bahan.uk_alias, kategori : bahan.kategori}">
                  
                  {{bahan.nama}}</option>               
                </select>          
                 <button class="btn btn-info"  v-on:click.prevent="tambah()">Tambah Bahan</button>
            </div>
          <div class="form-group">
            <!-- lopping array untuk bahan yang dikirim -->
                <div v-for="(row, index) in form.bahan" :key="index"> 
                    <h6>
                        bahan {{row.nama}} <div v-if="row.panjang || row.lebar"> ukuran {{row.panjang}} x {{row.lebar}} </div><div v-if="row.uk_alias"> ukuran {{row.ukuran_alias}}</div>                         
                        <span class=" btn btn-danger badge badge-danger" @click="hapus(index)">Hapus</span>
                    </h6>
                </div>
          </div>
                                                              
                    <div class="form-check form-check-inline mt-2">
                    <label class="form-check-label">
                        <input  v-model="form.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Outdoor"> Outdoor
                    </label>
                    </div>                      
                    <div class="form-check form-check-inline mt-2">
                    <label class="form-check-label">
                        <input   v-model="form.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Versant"> Versant
                    </label>
                    </div>                      
                    <div class="form-check form-check-inline mt-2">
                    <label class="form-check-label">
                        <input   v-model="form.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Indoor"> Indoor
                    </label>
                    </div>                  
                    <div class="form-check form-check-inline mt-2">
                    <label class="form-check-label">
                        <input   v-model="form.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Merchandise"> Merchandise
                    </label>
                    </div>   

             <div class="form-group">                        
                <label for="">Keterangan</label>
                   <input type="text" v-model="keterangan" class="form-control">
                 <button class="btn btn-info"  v-on:click.prevent="tambah_ket()">Tambah Keterangan</button>
            </div>
          <div class="form-group">
            <!-- lopping array untuk bahan yang dikirim -->
                <div v-for="(row, index) in form.ket" :key="index"> 
                    <h6>
                       <h6>{{row}}</h6>
                        <span class=" btn btn-danger badge badge-danger" @click="hapus_ket(index)">Hapus</span>
                    </h6>
                </div>
          </div>
    <vue-editor v-model="form.info_produk"></vue-editor>

  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import {mapState, mapActions, mapMutations} from 'vuex'

  export default {
    props : ['isi_pesan'],
name : 'formProduk',
    created(){
      
      this.get_data_bahan();
        if(this.$route.name == "produk.edit") {
          this.edit_data_produk(this.$route.params.id).then( (res) => {            
              this.form = {
                nama : res.data.nama,
                  panjang : res.data.panjang,
                  satuan : res.data.satuan,         
                  lebar : res.data.lebar,
                  uk_alias : res.data.uk_alias,
                  kategori : res.data.kategori,
                  bahan :  res.data.bahan ? JSON.parse(res.data.bahan) : [],
                  ket :  res.data.ket ? JSON.parse(res.data.ket) : [],
                  info_produk : res.data.info_produk
              }
          } )
        }
    },
    data() {
      return {
        keterangan : '',
        terpilih_bahan :{},
        form: {
         nama : '',
          panjang : '',
          satuan : '',          
          lebar : '',
          uk_alias : '',
          kategori : '',
          bahan : [], 
          ket : [],
          info_produk : ''

        },       
        show: true,      
        pesan : false
      }
    },  
    computed : {
        ...mapState(['errors']),
         ...mapState('bahan_stores', {
            bahans : state=> state.bahans
        }), 
    },
    methods: {
      ...mapMutations(['CLEAR_ERRORS']),
       ...mapMutations('produk_stores', ['SET_ID_UPDATE']),
      ...mapActions('produk_stores', ['submit_data_produk', 'update_data_produk', 'edit_data_produk']),
        ...mapActions('bahan_stores', ['get_data_bahan', ]),
        tambah(){ 
          this.form.bahan.push({
            id : this.terpilih_bahan.id, nama : this.terpilih_bahan.nama, panjang : this.terpilih_bahan.panjang, lebar : this.terpilih_bahan.lebar, uk_alias : this.terpilih_bahan.uk_alias, kategori : this.terpilih_bahan.kategori
          })
           
        },     
        hapus(param) {
            this.form.bahan.splice(param, 1);
        },
        tambah_ket(){
          this.form.ket.push(this.keterangan);
          this.keterangan = '';
        },
        hapus_ket(param) {
           this.form.ket.splice(param, 1);
        },
      proses(){
        var konver_bahan = JSON.stringify(this.form.bahan); // mengubah menjadi string agar masuk ke database
         var konver_ket = JSON.stringify(this.form.ket);
        //kita saring form nya terutama dibagian array bahan yang akan di buat string
        let form = new FormData();
        form.append('nama', this.form.nama);
        form.append('panjang', this.form.panjang);
        form.append('lebar', this.form.lebar);
        form.append('uk_alias', this.form.uk_alias);
         form.append('kategori', this.form.kategori);
        form.append('bahan', konver_bahan);
        form.append('ket', konver_ket);
            form.append('info_produk', this.form.info_produk);
        console.log(form);

        if(this.$route.name == "produk.add"){     
              this.submit_data_produk(form).then(() => {
                this.pesan = true   
                  setTimeout( () => this.$router.push({name : 'produk.data'}), 1000);     
            })          
        }else if(this.$route.name ==  "produk.edit") {             
            this.SET_ID_UPDATE(this.$route.params.id);
            this.update_data_produk(form).then(() => {             
                this.pesan = true   
                  setTimeout( () => this.$router.push({name : 'produk.data'}), 1000);     
            }) 
        }
      }
  
    },
      destroyed : function(){
        this.CLEAR_ERRORS()
    }
  }
</script>