
<template>
    <div class="container" style="padding-top: 30px">
          
                <div class="row">  
                    <div class="col-md mt-3">                   
                        <input type="text" v-model="searching" class="form-control" placeholder="Pencarian......">
                    </div>  
                    <div class="col-md mt-3">
                          <div class="form-inline">
                            <label class="mr-2">Tampil</label>
                            <select class="form-control"  v-model="perHalaman">
                                   <option value="1">1</option>
                                <option value="3">3</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <label class="ml-2">Perpage</label>
                        </div>
                    </div>  



                    <div class="col-md-12 text-center">                                                                
                    <div class="form-check form-check-inline mt-2">
                    <label class="form-check-label">
                        <input v-on:change="query_kategori($event)" v-model="queri.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Outdoor"> Outdoor
                    </label>
                    </div>                      
                    <div class="form-check form-check-inline mt-2">
                    <label class="form-check-label">
                        <input v-on:change="query_kategori($event)"  v-model="queri.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Versant"> Versant
                    </label>
                    </div>                      
                    <div class="form-check form-check-inline mt-2">
                    <label class="form-check-label">
                        <input v-on:change="query_kategori($event)"  v-model="queri.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Indoor"> Indoor
                    </label>
                    </div>                  
                    <div class="form-check form-check-inline mt-2">
                    <label class="form-check-label">
                        <input v-on:change="query_kategori($event)"  v-model="queri.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Merchandise"> Merchandise
                    </label>
                    </div>                  
                    <div class="form-check form-check-inline mt-2">
                    <label class="form-check-label">
                        <input v-on:change="query_kategori($event)"  v-model="queri.kategori"  class="form-check-input" type="radio" name="kategori" id="" value=""> Semua Kategori
                    </label>
                    </div>

                    </div>

                <b-form-group>
                <b-form-checkbox
                :disabled="visibleFields.length == 1 && field.visible"
                v-for="field in fields" 
                v-model="field.visible" 
                :key="field.key"           
                name="flavour-4a"
                inline
                class="text-center">
                            {{ field.label }}
                        </b-form-checkbox>
                </b-form-group>

                </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-uppercase" >Data Bahan  {{queri.kategori ? queri.kategori : 'semua kategori'}}  </h5>
                    </div>
                    <div class="card-body">                      
                               <b-table striped hover bordered :items="bahans.data" :fields="visibleFields" show-empty>
                                         
                                     <template #cell(ukuran)="row">
                                        <div :key="row.index">
                                                <span v-if="row.item.panjang  && row.item.lebar">{{row.item.panjang}} x {{row.item.lebar}} cm</span>
                                                <span v-if="row.item.uk_alias"> {{row.item.uk_alias}} </span>
                                        </div>
                                    </template> 

                                 <template #cell(show_details)="row">
                                    <b-button size="sm" @click="row.toggleDetails" class="mr-2">
                                    {{ row.detailsShowing ? 'Senyapkan' : 'Tampilkan'}} Details
                                    </b-button>
                                </template>

                                 <template #row-details="row">                                                                                                                                                                   
                                        <div  v-html="row.item.info_bahan">                                          
                                        </div>
                    
                                    <b-button class="float-right" size="sm" @click="row.toggleDetails">Senyapkan</b-button>                          
                                </template>

                                    <template #cell(aksi)="row">
                                        <div :key="row.index">
                                            <button class="btn btn-info" @click="edit(row.item.id)"> Edit</button>
                                            <button class="btn btn-danger" @click="hapus(row.item.id)" >Hapus</button>
                                        </div>
                                    </template> 

                                 </b-table>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p v-if="bahans.data"><i class="fa fa-bars"></i> {{ bahans.data.length }} item dari {{ bahans.meta.total }} total data</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <b-pagination
                                                            v-model="page"
                                                            :total-rows="bahans.meta.total"
                                                            :per-page="bahans.meta.per_page"
                                                            aria-controls="bahans"
                                                            v-if="bahans.data && bahans.data.length > 0"
                                                            ></b-pagination>
                                                    </div>
                                                </div>
                                            </div>




                    </div>
                </div>
              
            </div>          
        </div>
    </div>
</template>
<script>
import { mapActions, mapState } from 'vuex'
export default {
    created() {
        this.get_data_bahan()
    },
    data() {
        return {
            fields: [
                  {key: 'nama_alias', label : 'Nama Alias', visible: true, sortable: true},
                  {key: 'ukuran',  label : 'Ukuran', sortable: true, visible: true},
                {key: 'nama', label : 'Bahan', visible: true, sortable: true},                                
                {key: 'kategori', label : 'Kategori', visible: true, sortable: true},
                  {key : 'show_details', label :'Info Bahan', sortable:true, visible: true, visible: true},
                {key: 'aksi', label : 'Aksi', visible: false, sortable: false}, //TAMBAHKAN CODE INI
            ],
            searching: ''
        }
    },

    computed : {
        ...mapState('bahan_stores', {
            bahans : state=> state.bahans,
            queri : state=> state.queri,
        }),
       visibleFields() {
        return this.fields.filter(field => field.visible)
      },
       page : {
           get(){
                return this.$store.state.bahan_stores.currentPage
           },
           set(val){
               
            this.$store.state.bahan_stores.currentPage = val
           }
       },   
       perHalaman :{
            get(){
                return this.$store.state.bahan_stores.perPage
           },
           set(val){
               this.$store.state.bahan_stores.perPage = val
           }
       },

    },
    watch : {
        page(){
            this.get_data_bahan();
        },
        searching(){
            this.get_data_bahan(this.searching)
        },
        perHalaman(){
          this.get_data_bahan();
        },
    },
    methods : {
        ...mapActions('bahan_stores', ['get_data_bahan', 'edit_data_bahan', 'remove_data_bahan']),
        hapus(param){                                        
              let person = prompt("Yakin anda menghapus file ini ? :", "ya");
              if (person == null || person == "") {
               
              } else {
                this.remove_data_bahan(param);
              }
             
        }, 
        edit(param){
             this.$router.push({
                  name : 'bahan.edit',
                  params : {id : param}
              })
        },        
        query_kategori(event)  {
                this.get_data_bahan();
            }, 
    }

   
}
</script>