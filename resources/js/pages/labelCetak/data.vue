
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
                               <b-table striped hover bordered :items="labels.data" :fields="fields" show-empty>
                                   
                                   <template #cell(warna)="row">
                                        <div :key="row.index" :style="{'background-color' : row.item.warna, 'widht' : '10px', 'height' : '10px'}">

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
                                                    <p v-if="labels.data"><i class="fa fa-bars"></i> {{ labels.data.length }} item dari {{ labels.total }} total data</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <b-pagination
                                                            v-model="page"
                                                            :total-rows="labels.total"
                                                            :per-page="labels.per_page"
                                                            aria-controls="labels"
                                                            v-if="labels.data && labels.data.length > 0"
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
        this.get_label()
    },
    data() {
        return {
            fields: [
                {key: 'nama', sortable: true},
                {key: 'posisi', sortable: true},           
                {key: 'warna', sortable: true},  
                {key: 'aksi', sortable: false}, //TAMBAHKAN CODE INI
            ],
            searching: '',
           
        }
    },

    computed : {
        ...mapState('label_stores', {
            labels : state=> state.labels
        }),
       page : {
           get(){
                return this.$store.state.label_stores.page
           },
           set(val){
               this.$store.commit('label_stores/SET_PAGE', val)
           }
       }

    },
    watch : {
        page(){
            this.get_label()
        },
        searching(){
            this.get_label(this.searching)
        }
    },
    methods : {
        ...mapActions('label_stores', ['get_label', 'edit_label', 'remove_label']),
        hapus(param){
            this.remove_label(param);
        },
        edit(param){
             this.$router.push({
                  name : 'label.edit',
                  params : {id : param}
              })
        },
    }

   
}
</script>