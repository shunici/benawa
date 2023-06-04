
<template>
    <div class="container" style="padding-top: 30px">
        <div class="row">









        <div class="col-md-4 offset-md-4">
            <div class="form-inline float-right">
                <label class="mr-2">Search</label>
                <input type="text" v-model="searching" class="form-control">
            </div>
        </div>




            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">VueJS Datatables</h5>
                    </div>
                    <div class="card-body">
                      

                               <b-table striped hover bordered :items="pemesans.data" :fields="fields" show-empty>
                                   


                                         <template #cell(inisial)="row">
                                        <div v-for="(item, index) in konversi(row.item.inisial) " :key="index">
                                           <h6>{{item.nama}}</h6>  
                                        </div>
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
                                                    <p v-if="pemesans.data"><i class="fa fa-bars"></i> {{ pemesans.data.length }} item dari {{ pemesans.total }} total data</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <b-pagination
                                                            v-model="page"
                                                            :total-rows="pemesans.total"
                                                            :per-page="pemesans.per_page"
                                                            aria-controls="pemesans"
                                                            v-if="pemesans.data && pemesans.data.length > 0"
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
        this.get_data_pemesan()
    },
    data() {
        return {
            fields: [
                 {key: 'id', sortable: true},
                {key: 'nama', sortable: true},
                {key: 'inisial', sortable: true},
                {key: 'kategori', sortable: true},
                {key: 'telpon', sortable: true},                
                {key: 'aksi', sortable: false}, //TAMBAHKAN CODE INI
            ],
            searching: ''
        }
    },

    computed : {
        ...mapState('pemesan_stores', {
            pemesans : state=> state.pemesans
        }),
       page : {
           get(){
                return this.$store.state.pemesan_stores.page
           },
           set(val){
               this.$store.commit('pemesan_stores/SET_PAGE', val)
           }
       }

    },
    watch : {
        page(){
            this.get_data_pemesan()
        },
        searching(){
            this.get_data_pemesan(this.searching)
        }
    },
    methods : {
        ...mapActions('pemesan_stores', ['get_data_pemesan', 'edit_data_pemesan', 'remove_data_pemesan']),
        hapus(param){
            this.remove_data_pemesan(param);
        },
        edit(param){
             this.$router.push({
                  name : 'pemesan.edit',
                  params : {id : param}
              })
        },
        konversi(param){
               return JSON.parse(param);
        }
    }

   
}
</script>