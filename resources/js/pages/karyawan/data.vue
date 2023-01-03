
<template>
    <div class="container" style="padding-top: 30px">
        <div class="row">







        <div class="col-md-4 offset-md-4">
            <div class="form-inline float-right">

                <input type="text" v-model="searching" class="form-control" placeholder="pencarian....">
            </div>
        </div>




            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">VueJS Datatables</h5>
                    </div>
                    <div class="card-body">
                    

                               <b-table striped hover bordered :items="karyawans.data" :fields="fields" show-empty>                                   

                                  

                                    <template #cell(aksi)="row">
                                        <div :key="row.index">
                                            <button class="btn btn-info" @click="edit(row.item.id)"> Edit</button>
                                            <button class="btn btn-danger" @click="hapus(row.item.id)" >Hapus</button>
                                        </div>
                                    </template> 

                                 </b-table>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p v-if="karyawans.data"><i class="fa fa-bars"></i> {{ karyawans.data.length }} item dari {{ karyawans.total }} total data</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <b-pagination
                                                            v-model="page"
                                                            :total-rows="karyawans.total"
                                                            :per-page="karyawans.per_page"
                                                            aria-controls="karyawans"
                                                            v-if="karyawans.data && karyawans.data.length > 0"
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
        this.get_karyawan()
    },
    data() {
        return {
            fields: [
                {key: 'nama', sortable: true},
                {key: 'posisi', sortable: true}, 
                 {key: 'jabatan', sortable: true},         
                {key: 'aksi', sortable: false}, //TAMBAHKAN CODE INI
            ],
            searching: '',
           
        }
    },

    computed : {
        ...mapState('karyawan_stores', {
            karyawans : state=> state.karyawans
        }),
       page : {
           get(){
                return this.$store.state.karyawan_stores.page
           },
           set(val){
               this.$store.commit('karyawan_stores/SET_PAGE', val)
           }
       }

    },
    watch : {
        page(){
            this.get_karyawan()
        },
        searching(){
            this.get_karyawan(this.searching)
        }
    },
    methods : {
        ...mapActions('karyawan_stores', ['get_karyawan', 'edit_karyawan', 'remove_karyawan']),
        hapus(param){
            this.remove_karyawan(param);
        },
        edit(param){
             this.$router.push({
                  name : 'karyawan.edit',
                  params : {id : param}
              })
        },
    }

   
}
</script>