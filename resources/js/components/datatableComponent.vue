<template>
    <div class="row">            

        <div class="col-md-12">            
            <b-table striped hover :items="items" :fields="fields">  
               <template #cell(actions)="row">                  
                  <button class="btn btn-info" @click="editData(row)">Edit</button>         
                    <button class="btn btn-danger btn-sm" @click="openDeleteModal(row)">Delete</button>
                </template>
            </b-table> 

        </div>     


    <b-modal v-model="deleteModal" :title="title">
        <p>Kamu yakin ingin menghapus data ini?</p>
        <template v-slot:modal-footer>
            <div class="w-100 float-right">
                <b-button
                    variant="secondary"
                    size="sm"
                    @click="deleteModal=false"
                >
                    Close
                </b-button>
                <!-- JIKA TOMBOL DELETE DITEKAN, MAKA FUNGSI deleteModalButton AKAN DIJALANKAN -->
                <b-button
                    variant="primary"
                    size="sm"
                    @click="deleteModalButton"
                >
                    Delete
                </b-button>
            </div>
        </template>
    </b-modal>



    </div>
</template>

<script>
import _ from 'lodash'
export default {
    props: {
        items: {
            type: Array,
            required: true
        },
        fields: {
            type: Array,
            required: true
        },
        title: {
        type: String,
        default: "Delete Modal"
        }            
    },
    data() {
        return {       
            deleteModal: false,
            selected: null,   
            id_sementara:null    
        }
    },
    watch: {
      
    },
    methods: {
       openDeleteModal(row) {   
            this.deleteModal = true;
            this.selected = row.item;
            this.id_sementara = row.index;
            //id sementara untuk keperluan hapus data secara tampilan

        },
        deleteModalButton() {
            this.$emit('delete', this.selected, this.id_sementara)
            // console.log(this.selected.id); cek id
            this.deleteModal = false
        },
        editData(row) {
            this.$emit('edit', row.item)                     
        }
       
    }
}
</script>


