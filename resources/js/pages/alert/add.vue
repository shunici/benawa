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
   name : 'addalert',

        data() {
            return {
                isi_pesan : 'Data Berhasil Ditambah'
            }
        },
        methods : {
            ...mapActions('alert_stores', ['submit_alert']),
            submit() {
                this.submit_alert().then( (response) => {
                     
                      this.$router.push({ name: 'alert.data' })
                })
                 
            }
        },

        components : {
            formForm
        }
    }
</script>

