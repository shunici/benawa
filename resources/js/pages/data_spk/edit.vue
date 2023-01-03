<template>
    <div>
        <form-DataSPK ref="formDataSPK" :isi_pesan="isi_pesan"></form-DataSPK>
     <button class="btn btn-info" v-on:click.prevent="proses()">Update</button>
  
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'
    import formDataSPK from './form.vue'

    export default {


        data() {
            return {
                isi_pesan : 'Data Berhasil diupdate'
            }
        },
        methods : {
            proses() {
                this.$refs.formDataSPK.proses();
            }
        },

        components : {
            formDataSPK
        }
    }
</script>

