<template>
    <div>
        <form-pemesan ref="formPemesan" :isi_pesan="isi_pesan"></form-pemesan>
     <button class="btn btn-info" v-on:click.prevent="proses()">Update</button>
  
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'
    import formPemesan from './form.vue'

    export default {


        data() {
            return {
                isi_pesan : 'Data Berhasil diupdate'
            }
        },
        methods : {
            proses() {
                this.$refs.formPemesan.proses();
            }
        },

        components : {
            formPemesan
        }
    }
</script>

