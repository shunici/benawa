<template>
<div class="noprint mt-3 mb-4 col-12 text-center">     
<p>Jarak Space Label <b>{{uk_label}}</b> cm  |  mode spk <i><b>{{ mode ? 'Automatic' : 'Manual' }}</b></i> </p> 
<div class="btn-group">
    

        <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            Waktu Ambil
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#" @click="pesan('siang diambil')">Siang Diambil</a>
            <a class="dropdown-item" href="#" @click="pesan('sore diambil')">Sore Diambil</a>
            <a class="dropdown-item" href="#" @click="pesan('malam diambil')">Malam Diambil</a>            

        </div>
        </div>
        <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            Outdoor
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#" @click="pesan('Finishing Tanpa Lubang')">Finishing Tanpa Lubang</a>
            <a class="dropdown-item" href="#" @click="pesan('Selongsong Atas Bawah')">Selongsong AB</a>
            <a class="dropdown-item" href="#"  @click="pesan('Selongsong Kiri Kanan')">Selongsong KK</a>
        </div>
        </div>
        <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            Ofset
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#" @click="pesan('Laminasi Glossi')">Glossi</a>
            <a class="dropdown-item" href="#" @click="pesan('Laminasi Dop')">Dop</a>
            <a class="dropdown-item" href="#"  @click="pesan('2 Sisi')">2 Sisi</a>
            <a class="dropdown-item" href="#"  @click="pesan('1 Sisi')">1 Sisi</a>            
        </div>
        </div>

        <button type="button" class="btn btn-info"  @click="pesan('print n cut')">Print N Cut</button>
        <button type="button" class="btn btn-primary"  @click="pesan('')">
              <b-icon icon="trash"></b-icon>
        </button>
        <button type="button" class="btn btn-primary"  @click="tbhTabel">
            <b-icon icon="border-width"></b-icon>
        </button>
        <button type="button" class="btn btn-primary"  @click="dltTabel">
            <b-icon icon="trash2-fill"></b-icon>
        </button>


</div>

<br>
   
    
        <div class="form-check form-check-inline mt-3" >
           Resolusi DPI
        </div>
        <div class="form-check form-check-inline mt-3"  @click="atur_resolusi('15.74803149606299')">
            <label for="re1" class="form-check-label">
                <input class="form-check-input" type="radio" name="resolusi" id="re1" value="40"> 40
            </label>
        </div>
        <div class="form-check form-check-inline mt-3"  @click="atur_resolusi('23.62204724393699')">
            <label for="re2" class="form-check-label">
                <input class="form-check-input" checked type="radio" name="resolusi" id="re2" value="60"> 60
            </label>
        </div>
        <div class="form-check form-check-inline mt-3"  @click="atur_resolusi('31.49606299212598')">
            <label for="re3" class="form-check-label">
                <input class="form-check-input" type="radio" name="resolusi" id="re3" value="80"> 80
            </label>
        </div>
        <div class="form-check form-check-inline mt-3"  @click="atur_resolusi('39.37007874015748')">
            <label for="re4" class="form-check-label">
                <input class="form-check-input" type="radio" name="resolusi" id="re4" value="100"> 100
            </label>
        </div>
        <div class="form-check form-check-inline mt-3"  @click="atur_resolusi('47.24409448881895')">
            <label for="re5" class="form-check-label">
                <input class="form-check-input" type="radio" name="resolusi" id="re5" value="120"> 120
            </label>
        </div>
        <div class="form-check form-check-inline mt-3"  @click="atur_resolusi('59.05511810925188')">
            <label for="re6" class="form-check-label">
                <input class="form-check-input" type="radio" name="resolusi" id="re6" value="150"> 150
            </label>
        </div>
        <div class="form-check form-check-inline mt-3"  @click="atur_resolusi('78.74015748031496')">
            <label for="re7" class="form-check-label">
                <input class="form-check-input" type="radio" name="resolusi" id="re7" value="200"> 200
            </label>
        </div>
    <br>
        <div class="form-check form-check-inline mt-1" >
           Jarak Space
        </div>
        <div class="form-check form-check-inline mt-1"  @click="label_jarak('0')">
            <label for="1" class="form-check-label">
                <input class="form-check-input" checked type="radio" name="label_uk" id="1" value="0"> None
            </label>
        </div>
        <div class="form-check form-check-inline mt-1" @click="label_jarak('4')">
            <label for="2" class="form-check-label">
                <input class="form-check-input" type="radio" name="label_uk" id="2" value="4"> Finishing
            </label>
        </div>
        <div class="form-check form-check-inline mt-1" @click="label_jarak('12')">
            <label for="3" class="form-check-label">
                <input class="form-check-input" type="radio" name="label_uk" id="3" value="12"> Lbh SS
            </label>
        </div>








    </div>
</template>

<script>
  import { mapActions, mapState } from 'vuex'
export default {
    name : 'footerSpk',
    computed : {
  ...mapState('spk_stores', {
                    ket : state=> state.ket_lain,   
                     resolusi : state=> state.resolusi,  
                       uk_label : state=> state.uk_label,     
                       bahanDF : state=> state.bahan,  
                         mode : state=> state.mode,   
                           spk : state=> state.spk.data,   


                }),
    },
    data () {
        return {
        }
    },
    methods : {
           ...mapActions('spk_stores', ['besar_uk_font', 'kecil_uk_font', 'pesan_aktif']),
           pesan(param){               
                 this.$store.state.spk_stores.spk.text = param
           },     //ini utk format tiff      
           atur_resolusi(param){        
          
                 this.$store.state.spk_stores.resolusi = param
           },      //ini utk format tiff     
           label_jarak(param){        
          
                 this.$store.state.spk_stores.uk_label = param
           }, 
           tbhTabel(){
               let data = { id: 4, nama_brg : '', produk_id: null, bahan: '', bahan_id : null, ukuranP : '', ukuranL: '', uk_alias: '', qty : null, fns:false, ls: false,  ket: null };
              this.spk.push(data);
           },
           dltTabel(){
               
              this.spk.pop();

           }

    }
}
</script>

<style scoped>

/* resolusi
40  == 15.74803149606299
60 == 23.62204724393699
80 == 31.49606299212598
100 = 39.37007874015748
120 = 47.24409448881895
150 = 59.05511810925188
200 = 78.74015748031496 */
</style>
