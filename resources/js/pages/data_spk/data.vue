
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
                      

                               <b-table striped hover bordered :items="data_spks.data" :fields="fields" show-empty>
                                   
                                    <template #cell(aksi)="row">
                                        <div :key="row.index">
                                            <button class="btn btn-info" @click="edit(row.item.id)"> Edit</button>
                                            <button class="btn btn-danger" @click="hapus(row.item.id)" >Hapus</button>
                                        </div>
                                    </template> 

                                 </b-table>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p v-if="data_spks.data"><i class="fa fa-bars"></i> {{ data_spks.data.length }} item dari {{ data_spks.total }} total data</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <b-pagination
                                                            v-model="page"
                                                            :total-rows="data_spks.total"
                                                            :per-page="data_spks.per_page"
                                                            aria-controls="data_spks"
                                                            v-if="data_spks.data && data_spks.data.length > 0"
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
        this.get_data_spk()
    },
    data() {
        return {
            fields: [
                {key: 'nama_brg', label : 'Nama Barang', sortable: true},
                {key: 'ukuranP', label : 'Panjang', sortable: true},
                {key: 'ukuranL', label : 'Lebar', sortable: true},
                {key: 'uk_alias', label : 'Uk Alias', sortable: true},
                {key: 'bahan', label : 'Bahan', sortable: true},
                {key: 'kategori', label : 'Kategori', sortable: true},
                {key: 'qty', label : 'Jumlah', sortable: true},
                {key: 'keterangan', label : 'Keterangan', sortable: true},
                {key: 'aksi', sortable: false}, //TAMBAHKAN CODE INI
            ],
            searching: ''
        }
    },

    computed : {
        ...mapState('data_spk_stores', {
            data_spks : state=> state.data_spks
        }),
       page : {
           get(){
                return this.$store.state.data_spk_stores.page
           },
           set(val){
               this.$store.commit('data_spk_stores/SET_PAGE', val)
           }
       }

    },
    watch : {
        page(){
            this.get_data_spk()
        },
        searching(){
            this.get_data_spk(this.searching)
        }
    },
    methods : {
        ...mapActions('data_spk_stores', ['get_data_spk', 'edit_data_spk', 'remove_data_spk']),
        hapus(param){
            this.remove_data_spk(param);
        },
        edit(param){
             this.$router.push({
                  name : 'data_spk.edit',
                  params : {id : param}
              })
        }
    }

   
}
</script>