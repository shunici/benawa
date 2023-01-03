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

   name : 'editinfo',
        data() {
            return {
                isi_pesan : 'Data Berhasil diupdate'
            }
        },
        methods : {

            ...mapActions('info_stores', ['edit_info', 'update_info']),
            submit() {
                this.update_info(this.$route.params.id)                   
                    this.$router.push({ name: 'info.data' })
            }
        },

        components : {
            formForm
        }
    }
</script>

