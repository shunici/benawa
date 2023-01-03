<template>
    <div>
        <form-form ref="formForm" :isi_pesan="isi_pesan"></form-form>
     
                     
                        <button class="btn btn-primary btn-sm btn-flat float-right" @click.prevent="submit">
                        <i class="fa fa-save"></i> Proses
                        </button>
                      
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'
    import formForm from './form.vue'

    export default {
   name : 'addinfo',

        data() {
            return {
                isi_pesan : 'Data Berhasil Ditambah'
            }
        },
        methods : {
            ...mapActions('info_stores', ['submit_info']),
            submit() {
                this.submit_info().then( (response) => {                     
                      this.$router.push({ name: 'info.data' })
                })
                 
            }
        },

        components : {
            formForm
        }
    }
</script>

