<template>
    <div>
        <form-produk ref="formProduk" :isi_pesan="isi_pesan"></form-produk>
     <button class="btn btn-info float-right" v-on:click.prevent="proses()">Proses</button>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'
    import formProduk from './form.vue'

    export default {


        data() {
            return {
                isi_pesan : 'Data Berhasil Ditambah'
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

