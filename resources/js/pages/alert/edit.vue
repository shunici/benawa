<template>
    <div>
        <form-form ref="formForm" :isi_pesan="isi_pesan"></form-form>
     
              
                <button class="btn btn-primary btn-sm btn-flat float-right" @click.prevent="submit">
                <i class="fa fa-save"></i> Update
                </button>
          
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'
    import formForm from './form.vue'

    export default {

   name : 'editalert',
        data() {
            return {
                isi_pesan : 'Data Berhasil diupdate'
            }
        },
        methods : {

            ...mapActions('alert_stores', ['edit_alert', 'update_alert']),
            submit() {
                this.update_alert(this.$route.params.id)                   
                    this.$router.push({ name: 'alert.data' })
            }
        },

        components : {
            formForm
        }
    }
</script>

