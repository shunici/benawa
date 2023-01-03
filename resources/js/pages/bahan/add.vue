<template>
    <div>
        <form-Bahan ref="formBahan" :isi_pesan="isi_pesan"></form-Bahan>
     <button class="btn btn-info float-right" v-on:click.prevent="proses()">Proses</button>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'
    import formBahan from './form.vue'

    export default {


        data() {
            return {
                isi_pesan : 'Data Berhasil Ditambah'
            }
        },
        methods : {
            proses() {
                this.$refs.formBahan.proses();
            }
        },

        components : {
            formBahan
        }
    }
</script>

