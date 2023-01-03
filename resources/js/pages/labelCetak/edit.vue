<template>
    <div>
        <form-form ref="formForm" :isi_pesan="isi_pesan"></form-form>
     
                <div class="form-group">
                <button class="btn btn-primary btn-sm btn-flat" @click.prevent="submit">
                <i class="fa fa-save"></i> Update
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
                isi_pesan : 'Data Berhasil diupdate'
            }
        },
        methods : {

            ...mapActions('label_stores', ['edit_label', 'update_label']),
            submit() {
                this.update_label(this.$route.params.id)                   
                    this.$router.push({ name: 'label.data' })
            }
        },

        components : {
            formForm
        }
    }
</script>

