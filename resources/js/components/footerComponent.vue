<template>
    <!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted noprint">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
    
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-google"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-linkedin"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-github"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        
        <!-- Grid column -->
        <div class="col-md-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>Desainer
          </h6> 
        <span v-for="(item, index) in karyawans.data" :key="index+'ds'">
        <div class="form-check mt-2" v-if="item.jabatan == 'desainer'">
          <label class="form-check-label" >
            <input v-on:change="query_kategori($event)" type="radio" class="form-check-input" v-model="karyawan.nama" name="ds" :value="item.nama" id="">
            {{item.nama}}
          </label>
        </div>
      </span>         

        </div>
        <!-- Grid column -->

     
        
        <!-- Grid column -->
        <div class="col-md-3  mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Admin</h6>
        <span v-for="(item, index) in karyawans.data" :key="index+'ad'">
        <div class="form-check mt-2" v-if="item.jabatan == 'admin'">
          <label class="form-check-label" >
            <input v-on:change="query_kategori($event)" type="radio" class="form-check-input" v-model="karyawan.nama" name="ad" :value="item.nama" id="">
            {{item.nama}}
          </label>
        </div>
        </span>

        </div>
        <!-- Grid column -->
        <div class="col-md-3 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
           OPERATOR
          </h6>
        <span v-for="(item, index) in karyawans.data" :key="index+'op'">
        <div class="form-check mt-2" v-if="item.jabatan == 'operator'">
          <label class="form-check-label" >
            <input v-on:change="query_kategori($event)" type="radio" class="form-check-input" v-model="karyawan.nama" name="op" :value="item.nama" id="">
            {{item.nama}}
          </label>
        </div>
        </span>

        </div>
        <!-- Grid column -->
        <div class="col-md-3 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Finishing
          </h6>
        <span v-for="(item, index) in karyawans.data" :key="index+'fn'">
        <div class="form-check mt-2" v-if="item.jabatan == 'finishing' " >
          <label class="form-check-label" > 
            <input type="radio" class="form-check-input" v-model="karyawan.nama" name="fn" :value="item.nama" id="">
            {{item.nama}}
          </label>
        </div>
        </span>
        

        </div>

        <!-- Grid column -->
      </div>
      <!-- Grid row -->
      <a href="https://shunici.github.io/program_hitung/" target="_blank" rel="noopener noreferrer">Menghitung Objek Dalam Ukuran</a>
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2023 Copyright: <b>Shunici | Web Developer | Programmer | Full Stack </b>

  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
</template>

<script>
import { mapActions, mapState } from 'vuex'
export default {
    created() {             
           
          
    },
    data() {
        return {
            searching: '',
           
        }
    },

    computed : {
        ...mapState('karyawan_stores', {
            karyawans : state=> state.karyawans,
            karyawan : state=> state.karyawan,
        }),
        ...mapState('label_stores', {
                labels : state=> state.labels
            }),
        ...mapState('spk_stores', {
                spk : state=> state.spk,
                 ttd : state => state.ttd   
          }),

    },
    methods : {
        ...mapActions('karyawan_stores', ['get_karyawan', 'edit_karyawan', 'remove_karyawan']),        
            query_kategori(e)  {              
            var nama = e.target.value;         
            this.spk.desainer = nama;  
             this.ttd.nama = nama;
                            
            },              
      
    }

   
}
</script>
