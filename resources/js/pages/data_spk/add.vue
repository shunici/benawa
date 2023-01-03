<template>
    <div>
        <data-spk ref="data_spk" :isi_pesan="isi_pesan"></data-spk>
     <button class="btn btn-info float-right" v-on:click.prevent="proses()">Proses</button>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'
    import dataSpk from './form.vue'

    export default {


        data() {
            return {
                isi_pesan : 'Data Berhasil Ditambah'
            }
        },
        methods : {
            proses() {
                this.$refs.data_spk.proses();
            }
        },

        components : {
            dataSpk
        }
    }
</script>

