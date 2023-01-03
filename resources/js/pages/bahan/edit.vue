<template>
    <div>
        <form-produk ref="formProduk" :isi_pesan="isi_pesan"></form-produk>
     <button class="btn btn-info" v-on:click.prevent="proses()">Update</button>
  
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'
    import formProduk from './form.vue'

    export default {


        data() {
            return {
                isi_pesan : 'Data Berhasil diupdate'
            }
        },
        methods : {
            proses() {
                this.$refs.formProduk.proses();
            }
        },

        components : {
            formProduk
        }
    }
</script>

