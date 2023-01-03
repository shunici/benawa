
<template>
    <div class="container">
            
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


                </div>

        <div class="row"> 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Alaert</h5>
                    </div>
                    <div class="card-body">                  

                               <b-table striped hover bordered :items="alerts.data" :fields="fields" show-empty>                                   

                                  
                                    <template #cell(text)="row">
                                        <span :key="row.index">   
                                            {{row.item.text}}   
                                        </span>
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
                                                    <p v-if="alerts.data"><i class="fa fa-bars"></i> {{ alerts.data.length }} item dari {{ alerts.total }} total data</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <b-pagination
                                                            v-model="page"
                                                            :total-rows="alerts.meta.total"
                                                            :per-page="alerts.meta.per_page"
                                                            aria-controls="alerts"
                                                            v-if="alerts.data && alerts.data.length > 0"
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
    name : 'alertdata',
    created() {
        this.get_alert()
    },
    data() {
        return {
            fields: [
                 {key: 'posisi', sortable: true},  
                {key: 'kategori', sortable: true},
                {key: 'text', sortable: true, tdClass: 'ellipsis'},                                               
                {key: 'bgColor', sortable: true},                           
                {key: 'kategori', sortable: true},                                  
                {key: 'aksi', sortable: false}, //TAMBAHKAN CODE INI
            ],
            searching: '',
           
        }
    },

    computed : {
        ...mapState('alert_stores', {
            alerts : state=> state.alerts,
             queri : state=> state.queri,

        }),
       page : {
           get(){
                return this.$store.state.alert_stores.currentPage
           },
           set(val){
               
            this.$store.state.alert_stores.currentPage = val
           }
       },       
       perHalaman :{
            get(){
                return this.$store.state.alert_stores.perPage
           },
           set(val){
               this.$store.state.alert_stores.perPage = val
           }
       },

    },
    watch : {
        page(){
            this.get_alert()
        },
        perHalaman(){
           this.get_alert()
        },
        searching(){
            this.get_alert(this.searching)
        }
    },
    methods : {
        ...mapActions('alert_stores', ['get_alert', 'edit_alert', 'remove_alert']),       
        hapus(param){                                        
              let person = prompt("Yakin anda menghapus file ini ? :", "ya");
              if (person == null || person == "") {
               
              } else {
                        this.remove_alert(param);
              }
             
        }, 
        edit(param){
             this.$router.push({
                  name : 'alert.edit',
                  params : {id : param}
              })
        },
        show(param){
             this.$router.push({
                  name : 'alert.show',
                  params : {id : param}
              })
        },
        query_kategori(event)  {
               this.get_alert()
            },
    }

   
}
</script>
