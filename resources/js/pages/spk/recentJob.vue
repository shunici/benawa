<template>
    <div>

  
<div class="card">
  <div class="card-header bg-success text-white" data-toggle="collapse" data-target="#outdoor" aria-expanded="true" aria-controls="outdoor" >
    Outdoor
  </div>
  <ul class="list-group list-group-flush collapse  float-letf" v-for="(row, index) in data_spks.data" :key="index" id="outdoor" >
    <li class="list-group-item btn text-left" v-if="row.kategori == 'outdoor'" :class="{active : is_aktif == index}" @click="klikAktif(index, row.nama_brg, row.uk_alias, row.bahan, row.fns, row.ls, row.ket, row.keterangan)">{{row.bahan}} {{row.ket}}   <span class="badge badge-warning"> {{row.kategori}}</span> </li>    
  </ul>
</div>

<div class="card">
  <div class="card-header bg-info text-white" data-toggle="collapse" data-target="#indoor" aria-expanded="true" aria-controls="indoor" >
    Indoor
  </div>
  <ul class="list-group list-group-flush collapse  float-letf" v-for="(row, index) in data_spks.data" :key="index" id="indoor" >
    <li class="list-group-item btn text-left" v-if="row.kategori == 'indoor'" :class="{active : is_aktif == index}" @click="klikAktif(index, row.nama_brg, row.uk_alias, row.bahan, row.fns, row.ls, row.ket, row.keterangan)">{{row.bahan}} {{row.ket}}   <span class="badge badge-warning"> {{row.kategori}}</span> </li>    
  </ul>
</div>

<div class="card">
  <div class="card-header bg-warning text-dark" data-toggle="collapse" data-target="#merchandise" aria-expanded="true" aria-controls="merchandise" >
    merchandise
  </div>
  <ul class="list-group list-group-flush collapse  float-letf" v-for="(row, index) in data_spks.data" :key="index" id="merchandise" >
    <li class="list-group-item btn text-left" v-if="row.kategori == 'merchandise'" :class="{active : is_aktif == index}" @click="klikAktif(index, row.nama_brg, row.uk_alias, row.bahan, row.fns, row.ls, row.ket, row.keterangan)">{{row.bahan}} {{row.ket}}   <span class="badge badge-warning"> {{row.kategori}}</span> </li>    
  </ul>
</div>

<div class="card">
  <div class="card-header bg-danger text-white" data-toggle="collapse" data-target="#offset" aria-expanded="true" aria-controls="offset" >
    offset
  </div>
  <ul class="list-group list-group-flush collapse  float-letf" v-for="(row, index) in data_spks.data" :key="index" id="offset" >
    <li class="list-group-item btn text-left" v-if="row.kategori == 'offset'" :class="{active : is_aktif == index}" @click="klikAktif(index, row.nama_brg, row.uk_alias, row.bahan, row.fns, row.ls, row.ket, row.keterangan)">{{row.bahan}} {{row.ket}}   <span class="badge badge-warning"> {{row.kategori}}</span> </li>    
  </ul>
</div>

<div class="card">
  <div class="card-header bg-dark text-white"  data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
  Font Keterangan
  </div>
  <ul class="list-group list-group-flush collapse"  id="collapsefive" >
      <input type="text" v-model="ttd.nama" class="form-control">
      <button class="btn btn-success"  v-on:click="besar_font">+</button> 
      <button class="btn btn-warning"  v-on:click="kecil_font">-</button>
      <button class="btn btn-default"  v-on:click="aktif_pesan">Pesan</button>
  </ul>
</div>


<div class="card">
  <div class="card-header">

        <div class="form-check  mt-1"  @click="mode_spk(true)">
            <label for="1aa" class="form-check-label">
                <input class="form-check-input" checked type="radio" name="mode_spk" id="1aa" value="0">Automatis
            </label>
        </div>
        <div class="form-check  mt-1" @click="mode_spk(false)">
            <label for="2aa" class="form-check-label">
                <input class="form-check-input" type="radio" name="mode_spk" id="2aa" value="4">Manual
            </label>
        </div>
      
    <div class="p-12 bg-gray-100 border border-gray-300" @dragover="dragover" @dragleave="dragleave" @drop="drop">
    <input style="display:none" type="file" multiple name="fields[assetsFieldHandle][]" id="assetsFieldHandle" 
      class="w-px h-px opacity-0 overflow-hidden absolute" @change="onChange" ref="file" accept=".pdf,.jpg,.jpeg,.png" />
  
    <label for="assetsFieldHandle" class="block cursor-pointer" style="width:100%; height:100%">
     kita tahu bahwa keadaan ini memang sangat sulit, tapi biarbagaimanapun juga kita harus punya rasionalisasi sehingga ada solusi disetiap langkah yang akan kita ambil.
    </label>
    <ul class="mt-4" v-if="this.filelist.length" v-cloak>
      <li class="text-sm p-1" v-for="(file, index) in filelist" :key="index">
        <input type="text" name="" id="" v-model="spk.nama_pemesan" >
      <button type="button" class="btn btn-primary btn-block" @click="remove(filelist.indexOf(file))" title="Remove file">x</button>
      </li>
    </ul>
  </div>

    <div class="form-group">
      <label for="tel">No Telp</label> <button class="float-right btn btn-sm" @click="clear_phone">Clear Phone</button>
      <input type="text" class="form-control" v-model="spk.no_wa">
    </div>
    
    <div class="form-group">
      <label for="id">Id Kostumer</label> 
      <input type="text" class="form-control" v-model="spk.id_kostumer">
    </div>

    <span>  

    <div class="form-check form-check-inline" v-for="(item, index) in nama_array" :key="index+'labl'">
      <label class="form-check-label" v-on:change="cari_array_nama($event)">
        <input class="form-check-input"  type="radio" name="nama_perc" :id="item.nama" :value="item.id_kostumer"> <span class="text-uppercase">{{item.nama}}</span>
        <span class="badge badge-warning"> {{item.id_kostumer}}</span>
      </label>
    </div>  
    </span>
  </div>
</div>










    </div>
</template>

<script>
import { mapActions, mapState, mapMutations } from 'vuex'
    export default {
      name : 'recentData',
      props : ['pemesans'],
         delimiters: ['${', '}'], // Avoid Twig conflicts
        data(){
            return {              
                is_aktif : false,    
                       filelist: [], // Store our uploaded files          
                       nama_array : [],
                       id_pemesan_foto : '',
            }
        },
        created(){
            this.get_data_spk();
        },
        computed : {
          ...mapState('data_spk_stores', {
                    data_spks : state=> state.data_spks,
                    recent_job : state=>state.recent_job
                }),
              ...mapState('spk_stores', {
                    spk : state=> state.spk,
                    urutan : state => state.urutan,
                      ttd : state => state.ttd                  
                }),
                
        },
        watch : {
          id_pemesan_foto () {
              this.edit_data_pemesan(this.id_pemesan_foto).then( (res) => {                       
              this.spk.foto = '/storage/pemesan/' +  res.data.foto
          } )
          }
        },
        methods : {
          ...mapActions('pemesan_stores', ['edit_data_pemesan']),
          ...mapActions('spk_stores', ['besar_uk_font', 'kecil_uk_font', 'pesan_aktif']),
          ...mapActions('data_spk_stores', ['get_data_spk']),
            ...mapMutations('spk_stores', ['RANDOM_WARNA']),
            besar_font(){
                this.besar_uk_font();
               
            },
             kecil_font(){
                this.kecil_uk_font();
               
            },
            aktif_pesan(){
                this.pesan_aktif();
            },
            
            klikAktif(param, nama_brg, uk_alias, bahan, fns, ls, ket, keterangan){
                this.is_aktif = param;
                this.recent_job.nama_brg = nama_brg;
                this.recent_job.bahan = bahan
                this.recent_job.ket = ket;
                this.recent_job.keterangan = keterangan;

               if(this.urutan != null) {                 
                 let id = this.urutan;
                 this.spk.data[id].nama_brg = nama_brg; 
                  this.spk.data[id].bahan = bahan;
                 this.spk.data[id].uk_alias = uk_alias;
                 this.spk.data[id].fns = fns;
                 this.spk.data[id].ls = ls;
                  this.spk.data[id].ket = ket ? ket : "";
                  this.spk.data[id].qty = 1; 
               }

            },

            //khusus gambar drop
              onChange() {
              this.spk.id_kostumer = '';
              this.spk.foto = '';
                this.spk.user = [];
               this.filelist = [...this.$refs.file.files];   

                      
                      //untuk perncarian nama dan push array nama radio buton
                      this.nama_array = []; //kosongkan dulu arraynya
                  this.RANDOM_WARNA(); //berikan warna pada tr table              
                var nama_pemesan = this.filelist[0].name.toLowerCase().replace(/\s+/g, ' ').trim();
                this.pemesans.forEach(sis => {     //mencari 1 sisi                                  
                        var nm = sis.label.toLowerCase().replace(/\s+/g, ' ').trim();                        
                        if(nm.includes(nama_pemesan)){
                             this.nama_array.push({
                              nama : sis.nama_asli,
                               id_kostumer : sis.id_kostumer,
                              telpon : sis.telpon,
                             
                           }); 
                        }
                        //label nama inisial, nama asli artinya nama yang benar
                }); 


                return this.$store.state.spk_stores.spk.nama_pemesan = this.filelist[0].name
            },
            remove(i) {
            this.filelist.splice(i, 1);
            return this.$store.state.spk_stores.spk.nama_pemesan = ""
            },
            dragover(event) {
            event.preventDefault();
            // Add some visual fluff to show the user can drop its files
            if (!event.currentTarget.classList.contains('bg-green-300')) {
                event.currentTarget.classList.remove('bg-gray-100');
                event.currentTarget.classList.add('bg-green-300');
            }
            },
            dragleave(event) {
            // Clean up
            event.currentTarget.classList.add('bg-gray-100');
            event.currentTarget.classList.remove('bg-green-300');
            
             
            },
            drop(event) {
            event.preventDefault();
            this.$refs.file.files = event.dataTransfer.files;

            this.onChange(); // Trigger the onChange event manually
            // Clean up
            event.currentTarget.classList.add('bg-gray-100');
            event.currentTarget.classList.remove('bg-green-300');
             
            },  
         cari_array_nama: function(e){
            // var telpon = e.target.value; 
            var id = e.target.value; 
            var nama = e.target.id;        
            this.spk.nama_pemesan = nama;
            // this.spk.no_wa = telpon; 
             this.spk.id_kostumer = id;    
             this.id_pemesan_foto = id;                      
        },  
        clear_phone(){
          this.spk.no_wa = "";
        } , //mode spk     
           mode_spk(param){                  
                 this.$store.state.spk_stores.mode = param
           },



        } //tutup method
    }
</script>

<style scoped>
    #filePhoto {
    position: absolute; 
    width: 100%;
    height: 500px;  
    z-index: 1;
    opacity: 0; 
    cursor: pointer;          
}
   


[v-cloak] {
  display: none;
}


</style>

