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

            ...mapActions('karyawan_stores', ['edit_karyawan', 'update_karyawan']),
            submit() {
                this.update_karyawan(this.$route.params.id)                   
                    this.$router.push({ name: 'karyawan.data' })
            }
        },

        components : {
            formForm
        }
    }
</script>

