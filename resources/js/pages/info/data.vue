
<template>
    <div class="container">
            
            

        <div class="row"> 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Info</h5>
                    </div>
                    <div class="card-body">                  

                               <b-table striped hover bordered :items="infos.data" :fields="fields" show-empty>                                   

                                    
                                    <template #cell(deskripsi)="row">
                                        <div v-html="row.item.deskripsi" >   
                                        
                                        </div>
                                    </template> 


                                    <template #cell(aksi)="row">
                                        <div :key="row.index+'sd'">                                            
                                            <button class="btn btn-info" @click="edit(row.item.id)"> Edit</button>
                                            <button class="btn btn-danger" @click="hapus(row.item.id)" >Hapus</button>
                                        </div>
                                    </template> 

                                 </b-table>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p v-if="infos.data"><i class="fa fa-bars"></i> {{ infos.data.length }} item dari {{ infos.total }} total data</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <b-pagination
                                                            v-model="page"
                                                            :total-rows="infos.meta.total"
                                                            :per-page="infos.meta.per_page"
                                                            aria-controls="infos"
                                                            v-if="infos.data && infos.data.length > 0"
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
    name : 'infodata',
    created() {
        this.get_info();
    },
    data() {
        return {
            fields: [
                 {key: 'deskripsi', sortable: true},                                 
                {key: 'aksi', sortable: false}, //TAMBAHKAN CODE INI
            ],
            searching: '',
           
        }
    },

    computed : {
        ...mapState('info_stores', {
            infos : state=> state.infos,          

        }),
       page : {
           get(){
                return this.$store.state.info_stores.currentPage
           },
           set(val){
               
            this.$store.state.info_stores.currentPage = val
           }
       },       
       perHalaman :{
            get(){
                return this.$store.state.info_stores.perPage
           },
           set(val){
               this.$store.state.info_stores.perPage = val
           }
       },

    },
    watch : {
        page(){
            this.get_info()
        },
        perHalaman(){
           this.get_info()
        },
        searching(){
            this.get_info(this.searching)
        }
    },
    methods : {
        ...mapActions('info_stores', ['get_info', 'edit_info', 'remove_info']),       
        hapus(param){                                        
              let person = prompt("Yakin anda menghapus file ini ? :", "ya");
              if (person == null || person == "") {
               
              } else {
                        this.remove_info(param);
              }
             
        }, 
        edit(param){
             this.$router.push({
                  name : 'info.edit',
                  params : {id : param}
              })
        },
        show(param){
             this.$router.push({
                  name : 'info.show',
                  params : {id : param}
              })
        },
        query_kategori(event)  {
               this.get_info()
            },
    }

   
}
</script>
