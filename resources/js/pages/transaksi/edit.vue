<template>
    <div>
       <button class="btn btn-success float-right" @click="$router.go(-1)">Kembali</button>  


    <div class="row" v-for="(row, index) in spk" :key="index"> 
      <div class="col-md-10">
         <table class="table table-bordered text-center table-sm " style="width : 40%; float:left;">
          <tr class="text-center thead-light">
              <th>Nama Pemesan             
              </th>
          </tr>
            <tr>
              <th @dblclick="nama_pemesan(index+4)" class="text-center">                       
                
                      <span v-if="index+4 == show_select">   <v-select :options="pemesans"  v-model="selected_nm_pemesan" ></v-select>   </span>                  
                      <input class="form-control" type="text" v-else-if="index+4 == show_input" v-model="spk[0].nama_pemesan"  @dblclick="show_select = index"  @keyup.enter="update(index)" >
                <div  v-else> {{row.nama_pemesan}}</div>
                </th>
          </tr>
      </table>
      <table class="table table-bordered text-center table-sm" style="width : 30%; float:left; ">
          <tr class="thead-light">
              <th>No. Nota</th>
          </tr>
            <tr>
              <th><input type="text" class="form-control"></th>
          </tr>
      </table>
       <table class="table table-bordered text-center table-sm" style="width : 30%;">
          <tr class="thead-light">
              <th >Tanggal Masuk</th>
          </tr>
            <tr>
              <th> <input type="text" class="form-control text-center" :value="tgl_show(row.tgl)"></th>
          </tr>
      </table>
    

     <table class="table table-bordered table-sm ">
       <thead class="text-center thead-dark">
         <tr>
           <th style="width:5%">No</th>
           <th style="width:25%">NAMA BARANG</th>
           <th style="width: 15%">UKURAN</th>
           <th style="width:20%">BAHAN</th>
           <th style="width: 5%">QTY</th>
           <th style="width: 5%">FNS</th>
           <th style="width: 5%">LS</th>
           <th style="width: 20%">KETERANGAN</th>         
         </tr>
       </thead>
       <tbody>
         <tr class="text-center" v-for="(item, index) in row.data" :key="index"  >
           <td  scope="row" @click="clear(index)" >{{index+1}}</td>

           <td @click="nama(index)">
             <span v-if="index == show_select">   <v-select :options="produks"  v-model="selected_nm_brg" ></v-select>   </span>
           <input type="text" v-else-if="index == show_input" v-model="spk[0].data[index].nama_brg"  @dblclick="show_select = index"  @keyup.enter="update(index)" >
                <div class="batas_nama_file text-left" v-else> {{item.nama_brg}}</div>
          </td>

           <td @click="nama(index)">
               <input type="text" v-if="index == show_input" v-model="spk[0].data[index].ukuranP"   style="width: 40%; display: inline;" @keyup.enter="update(index)">
                    <input type="text" v-if="index == show_input" v-model="spk[0].data[index].ukuranL"   style="width: 40%; display: inline;" @keyup.enter="update(index)">
            <span v-else>
              <div v-if="item.uk_alias">{{item.uk_alias}}</div>
              <div v-else-if="item.ukuranP">  {{item.ukuranP}} x {{item.ukuranL}} </div>
              </span>             
             </td>

           <td @click="nama(index)">
              <span v-if="index == show_select">   <v-select :options="bahans"  v-model="selected_bahan" ></v-select>   </span>

           <input type="text" v-else-if="index == show_input" v-model="spk[0].data[index].bahan"  @dblclick="show_select = index"  @keyup.enter="update(index)" >
                <div class=" text-left" v-else> {{item.bahan}}</div>
           </td>

           <th @click="nama(index)">
          <input type="text" v-if="index == show_input"  v-model="spk[0].data[index].qty" style="width: 100%" @keyup.enter="update(index)">
             <span v-else>{{item.qty}}</span>
           </th>

           <th> <input class="largerCheckbox"  type="checkbox" v-model="spk[0].data[index].fns"></th>
           <th><input class="largerCheckbox"  type="checkbox" v-model="spk[0].data[index].ls"></th>
           
           <th @click="nama(index)" >
             <span v-if="index == show_select">   <v-select :options="keterangan"  v-model="selected_ket" ></v-select>   </span>
              <input type="text" v-else-if="index == show_input" v-model="spk[0].data[index].ket"  @dblclick="show_select = index" style="width: 100%" @keyup.enter="update(index)">
              <div class="batas_nama_file" v-else>{{item.ket}}</div>              
            </th>         
         </tr>   
         
             
       </tbody>     
     </table>

              <table  class="table table-bordered table-sm">
                  <div v-for="(row, index) in spk" :key="index">
                    <div v-for="(item, index) in row.data" :key="index" >
                    <tr style="text-align: left; vertical-align: top;"
                    v-if="item.ket.length > 10 "
                    >                                                
                       <div :style="{fontSize : uk_font + 'rem'}">Ket. No {{index+1}} →  <strong>{{item.ket}}</strong> </div>
                    </tr>                  
                    </div>                             
                  </div>

                     <tr class="text-center">
                       <input  v-if="ket_lain.aktif" type="text" class="form-control" v-model="ket_lain.pesan" >
                      <div id="demoFont" v-else :style="{fontSize : uk_font + 'rem'}"><strong>{{ket_lain.pesan}}</strong> </div>
                    </tr>
                
                </table>  

      <table class="table table-bordered table-sm">
                    <tr style="text-align: center;" class="bg-info" >
                        <td>Desain</td>
                        <td>Designer</td>
                        <td>Admin</td>
                        <td>Operator</td>
                        <td>Finishing</td>
                        <td>Status</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Shuny</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>

          </div>            
          <!-- tutup col-md8 -->
          <div class="col-md-2">                              
                    <div v-for="index in 4" :key="index">                      
                             <div class="uploader" @paste="onPaste">                               
                                 <a :href="tampil[index]" target="_blank" v-if="tampil[index]">
                                    <img class="img-thumbnail" v-if="tampil[index]" :src="tampil[index]" />
                                  </a>
                                <img src="" />                          
                                <input type="file" id="filePhoto"  @change="handleImg($event, index-1)" />                                
                            </div>   
                    </div>         
          </div>   
          
    </div> 
  
 
     
    </div>
</template>
<script>
import moment from "moment"
moment.locale('id');  
  import { mapActions, mapState } from 'vuex'
  export default {



    props : ['produks', 'bahans', 'pemesans'],
    created(){
        
         if (this.$route.name == 'transaksi.edit') {
            this.edit_spk(this.$route.params.id).then((res) => {                
              
            })
        }
    },
    data () {
      return {      
        show_select : null,    
        show_input : null,   
        tampil : { //ini untuk gambar
        1:'',
        2: '',
        3:'',
        4 : ''
      },      
        selected_nm_brg : {},  //handel namaBarang
         selected_bahan : {},  //handel namaBarang
         selected_nm_pemesan : {},
         selected_ket : '',
         keterangan : [],   
         
      }
    },
  
    methods : {       
          ...mapActions('spk_stores', ['edit_spk']),
        nama (param){ 
          //ketika diklik maka inputan terbuka, vue select tertutup
           this.selected_nm_brg = null;
            var isian_input= this.show_input = param;  
            var urutan_aktif = param;
          return  this.$store.commit('spk_stores/SHOW_INPUT', isian_input)  || this.$store.commit('spk_stores/SHOW_URUTAN', urutan_aktif);                    
        },
        nama_pemesan(param){
          this.show_select = param
          this.show_input = param
        },
        update(param) {
           this.show_input = null;
           this.show_select = null;
           return  this.$store.commit('spk_stores/SHOW_SELECT', null) ||  this.$store.commit('spk_stores/SHOW_INPUT', null);    ;    
                    
        },
          handleImg(event, index){     
                      
                        var filename = event.target.files[0].name
                        let nama_foto = filename.split('.').slice(0, -1).join('.');                      
                       this.spk[0].data[index].nama_brg = nama_foto;
                        // this.tampil = URL.createObjectURL(this.pemain.foto);
            },
        clear(evt){
          this.spk[0].data[evt].nama_brg = "";
          this.spk[0].data[evt].bahan = "";
          this.spk[0].data[evt].ukuranP = "";
          this.spk[0].data[evt].ukuranL = "";
          this.spk[0].data[evt].qty = "";
           this.spk[0].data[evt].uk_alias= '',
          this.spk[0].data[evt].fns = false;
          this.spk[0].data[evt].ls = false;
          this.spk[0].data[evt].ket = "";
        },
         onPaste(event) {
            const items = (event.clipboardData || event.originalEvent.clipboardData).items;
            let blob = null;

            for (const item of items) {
              if (item.type.indexOf('image') === 0) {
                blob = item.getAsFile();
              }
            }

            // load image if there is a pasted image
            if (blob !== null) {
              const reader = new FileReader();
              reader.onload = (evt) => {
                console.log(evt.target.result); // data url!
                  var posisi = prompt("Please enter your name:", 1);
                 this.tampil[posisi] = evt.target.result
              };
              reader.readAsDataURL(blob);
            }
          }, //tutup onpaste
       
        aktif_pemesan(){
          this.pemesan_aktif = this.pemesan_aktif ? false : true;
          this.pemesan_input = this.pemesan_input ? false : true;
        },

        tgl_show (data){
            var tgl = data? data : moment();
          return moment(tgl).format('dddd, DD-MMM-YYYY');          
        }

    }, //tutup metod
        computed : {
        ...mapState('spk_stores', {
            spk : state=> state.spk,            
            uk_font : state=> state.uk_font,
            options : state=> state.options,
              ket_lain : state=> state.ket_lain,
              show_select : state => state.show_select,
              show_input : state => state.show_input,
              urutan : state => state.urutan,
            
        }),
        ...mapState('data_spk_stores', {
            pemesan : state => state.pemesan
        }),
      
    },
    watch : {
      //jika data vue select terpilih maka lanjut ke input
      selected_nm_brg(){
        //aktifkan input dengan meminjam data dari show select
        var id = this.show_select;  
        this.show_input = id;
        //satukan data dari vue select ke input
        var selected_nm_brg = this.selected_nm_brg.label != null ? this.selected_nm_brg.label : '' ;      
        this.spk[0].data[id].nama_brg = `${selected_nm_brg}`; 
        this.spk[0].data[id].ukuranP = this.selected_nm_brg.panjang; 
         this.spk[0].data[id].ukuranL = this.selected_nm_brg.lebar; 
         this.spk[0].data[id].produk_id = this.selected_nm_brg.produk_id; 
         this.spk[0].data[id].qty = 1;                 

         this.spk[0].data[id].bahan = this.selected_nm_brg.bahan[0].nama;
        //akses array bahan yang sudah diparse
          var array_bahan =  this.selected_nm_brg.bahan.map(o =>{
                    return {
                        label: o.nama,
                        code : o.satuan,
                        panjang : o.panjang,
                        lebar : o.lebar,
                        satuan : o.satuan,
                        uk_alias : o.uk_alias,
                        kategori : o.kategori,                       
                    }
            })
            //inisiasi ke bahan vue select
            this.bahans = array_bahan;

          this.spk[0].data[id].ket = this.selected_nm_brg.ket[0]; //ambil satu
            var array_ket =  this.selected_nm_brg.ket.map(o =>{
                              return o;
                      })
            //inisiasi ke bahan vue select
            this.keterangan = array_ket;


          //matikan  vue select sehingga sehingga input muncul  
        this.show_select = null; 
       },
        selected_bahan(){
        //aktifkan input dengan meminjam data dari show select
        var id = this.show_select;  
        this.show_input = id;    
        //jika produk sudah ada ukuran, jika tidak isi i dengan bahan yang punya ukuran  
       var pjg = this.spk[0].data[id].ukuranP;
           this.spk[0].data[id].ukuranP = pjg ? pjg : this.selected_bahan.panjang; 
        var lbr =  this.spk[0].data[id].ukuranL;
           this.spk[0].data[id].ukuranL = lbr ? lbr :  this.selected_bahan.lebar;          
        this.spk[0].data[id].bahan = this.selected_bahan.label;     
          //matikan  vue select sehingga sehingga input muncul  
        this.show_select = null; 
       },

       selected_ket(){
          var id = this.show_select;  
        this.show_input = id;
         this.spk[0].data[id].ket = this.selected_ket; 
         this.show_select = null;                   
       },

      selected_nm_pemesan() {                
       this.spk[0].nama_pemesan= this.selected_nm_pemesan.nama_asli
        this.show_select = null; 
      }

    },
  
  }
</script>

<style scoped>
   input.largerCheckbox { 
            transform : scale(2); 
        } 

    #filePhoto {
    position: absolute; 

    width: 100%;
    height: 500px;  
    z-index: 1;
    opacity: 0; 
    cursor: pointer;        
}
.uploader {
  /* background-color: red; */
    border: 0.1px solid grey;
      margin: 5px;
      height: 95px;
}

.batas_nama_file {
  white-space: nowrap; 
  width: 200px; 
  overflow: hidden;
  text-overflow: ellipsis; 

}

.batas_nama_ket {
  white-space: nowrap; 
  width: 180px; 
  overflow: hidden;
  text-overflow: ellipsis; 

}

#demoFont {
font-family: Impact, Charcoal, sans-serif;
font-size: 40px;
letter-spacing: 0.4px;
word-spacing: 1.6px;
color: #FF0606;
font-weight: 700;
text-decoration: none;
font-style: normal;
font-variant: normal;
text-transform: none;
}

</style>

