<template>
    <div>
        <form-form ref="formForm" :isi_pesan="isi_pesan"></form-form>
     
                        <div class="form-group">
                        <button class="btn btn-primary btn-sm btn-flat" @click.prevent="submit">
                        <i class="fa fa-save"></i> Proses
                        </button>
                         </div>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'
    import formForm from './form.vue'

    export default {


        data() {
            return {
                isi_pesan : 'Data Berhasil Ditambah'
            }
        },
        methods : {
            ...mapActions('label_stores', ['submit_label']),
            submit() {
                this.submit_label().then( (response) => {
                     
                      this.$router.push({ name: 'label.data' })
                })
                 
            }
        },

        components : {
            formForm
        }
    }
</script>

