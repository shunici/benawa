<template>
    <div>


<!-- <h2>{{show_select}}</h2> -->
    <div class="row"> 
      <div class="col-md-12">
         <p>Jika dalam penulisan SPK <b class="text-uppercase">{{spk.kategori}}</b> ini terdapat keterangan yang tidak sinkron  <b>SEGERA KONFIRMASI</b> kepihak terkait.  </p>
      </div>
      <div class="col-md-10">
         
         <table class="table table-bordered text-center table-sm " style="width : 40%; float:left;" >
          <tr class="text-center text-uppercase print_warna" :style="{'color' : spk.warna}">
              <th> █████ Nama Pemesan █████         
              </th>
          </tr>
            <tr>
              <th @dblclick="show_select == 5 ? show_select =5 : show_select = 5" class="text-center">                       
                
                      <span v-if="show_select == 5">   <v-select :options="pemesans"  v-model="selected_nm_pemesan" ></v-select>   </span>                  
                      <input  @keyup.enter="update( show_select =5 )" class="form-control" type="text" v-else-if="show_input" v-model="spk.nama_pemesan" >
                <div class="text-uppercase nama_pemesan tinggi"  v-else> {{spk.nama_pemesan}}</div>
                </th>
          </tr>
      </table>
      <table class="table table-bordered text-center table-sm" style="width : 30%; float:left; ">
          <tr>
              <th>No. Nota</th>
          </tr>
            <tr>
              <th class="tinggi"><input type="text" v-model="spk.no_nota" class="form-control"></th>
          </tr>
      </table>
       <table class="table table-bordered text-center table-sm" style="width : 30%;">
          <tr> 
              <th >Tanggal Masuk</th>
          </tr>
            <tr>
              <th class="tinggi"> <input  type="text" class="form-control text-center" :value="tgl_show(spk.tgl)"></th>
          </tr>
      </table>
   
     <table class="table table-bordered table-sm responsive table-responsive ">
       <thead class="text-center thead-dark">
         <tr>
           <th @click="clear_all" style="width:5%">No</th>
           <th style="width:25%">NAMA BARANG</th>
           <th style="width: 15%">UKURAN</th>
           <th style="width:20%">BAHAN</th>
           <th style="width: 5%">QTY</th>
           <th style="width: 5%">FNS</th>
           <th style="width: 5%">LS</th>
           <th style="width: 5%">KETERANGAN</th>         
         </tr>
       </thead>
       <tbody>
         <tr class="text-center" v-for="(item, index) in spk.data" :key="'trtd' +index"  >
           <td  scope="row" @click="clear(index)" >{{index+1}}</td>

           <td @click="nama(index)">
             <span v-if="index == show_select">   <v-select :options="produks"  v-model="selected_nm_brg" ></v-select>   </span>
           <input type="text" v-else-if="index == show_input" v-model="spk.data[index].nama_brg"  @dblclick="show_select = index"  @keyup.enter="update(index)" >
                <div class="batas_nama_file text-left" v-else> {{item.nama_brg}}</div>
          </td>

           <td @click="nama(index)">
               <input type="text" v-if="index == show_input" v-model="spk.data[index].ukuranP"   style="width: 40%; display: inline;" @keyup.enter="update(index)">
                    <input type="text" v-if="index == show_input" v-model="spk.data[index].ukuranL"   style="width: 40%; display: inline;" @keyup.enter="update(index)">
            <span v-else>
                  <div class="ukuran" v-if="item.uk_alias"><b>{{item.uk_alias}}</b>  </div>
                  <div class="ukuran" v-else-if="item.ukuranP"> 
                    <b> {{item.ukuranP}} <span  v-if="item.ukuranL"> x</span>  {{item.ukuranL}}    </b> 
                  </div>
              </span>             
             </td>

           <td @click="nama(index)">
              <span v-if="index == show_select">   <v-select :options="bahans"  v-model="selected_bahan" ></v-select>   </span>

           <input type="text" v-else-if="index == show_input" v-model="spk.data[index].bahan"  @dblclick="show_select = index"  @keyup.enter="update(index)" >
                <div class=" ukuran text-uppercase text-center" v-else> <b>{{item.bahan}}</b> </div>
           </td>

           <th @click="nama(index)">
          <input type="text" v-if="index == show_input"  v-model="spk.data[index].qty" style="width: 100%" @keyup.enter="update(index)">
             <span class="qty" v-else>{{item.qty}}</span>
           </th>

           <th> <input class="largerCheckbox"  type="checkbox" v-model="spk.data[index].fns"></th>
           <th><input class="largerCheckbox"  type="checkbox" v-model="spk.data[index].ls"></th>
           
           <th @click="nama(index)" >
             <span v-if="index == show_select">   <v-select :options="keterangan"  v-model="selected_ket" ></v-select>   </span>
              <input type="text" v-else-if="index == show_input" v-model="spk.data[index].ket"  @dblclick="show_select = index" style="width: 100%" @keyup.enter="update(index)">
              <div class="batas_nama_file" v-else>{{item.ket}}</div>              
            </th>         
         </tr>   
         
             
       </tbody>     
     </table>
       <table  class="table border-0 table-sm ">
                 
                    <div v-for="(rows, andix) in spk.data" :key="andix + 'tblbawah'" >
                    <tr style="text-align: left; vertical-align: top;"
                    v-if="rows.ket != null && rows.ket.length > 10">                                                
                       <div :style="{fontSize : uk_font + 'rem'}">Ket. No {{andix+1}} →  <strong class="text-uppercase">{{rows.ket}}</strong> </div>
                    </tr>                  
                    </div>                             
              

                     <tr class="text-center">
                       <input @keyup.enter="aktif_pesan"  v-if="ket_lain.aktif" type="text" class="form-control" v-model="spk.text" >
                      <div id="demoFont"  @dblclick="aktif_pesan" v-else :style="{fontSize : uk_font + 'rem'}"><strong class="text-uppercase">{{spk.text}}</strong> </div>
                    </tr>
                
                </table> 
<p><i>Spk dibuat pada pukul :  <b> {{pukul}}</b> </i> </p>
      <table class="table table-bordered table-sm " style="margin-top: -13px;">
                    <tr style="text-align: center;" class="bg-info" >
                        <td>Desain</td>
                        <td>Designer</td>
                        <td>Admin</td>
                        <td>Operator</td>
                        <td>Finishing</td>
                        <td>Status</td>
                    </tr>
                    <tr class="text-center">
                        <td></td>
                        <td>{{ttd.nama}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>



          </div>  
          <!-- tutup col-md8 -->
          
          <div class="col-md-2">                              
                    <div v-for="index in 4" :key=" 'gbr'+index">                      
                             <div class="uploader" @paste="onPaste">                               
                                 <!-- <a :href="tampil[index]" target="_blank" v-if="tampil[index]"> -->
                                    <img class="img-thumbnail" v-if="tampil[index]" :src="tampil[index]" />
                                  <!-- </a> -->
                                <!-- <img src="" />                           -->
                                <input :key="keyInput" type="file" id="filePhoto"  @change="mode ? handleImg($event, index-1) : tanganiImg($event, index-1)" />                                
                            </div>   
                    </div>         
          </div> 
      
            <span v-for="(row, index) in spk.data" :key="'kets'+index" class="col" > 
              <span v-if="row.nama_brg" class="badge badge-dark">{{index+1}}    </span>   {{row.nama_brg}}
           
              </span>


          
    </div> 

     
    </div>
</template>
<script>


import moment from "moment"
moment.locale('id');  
  import { mapActions, mapState } from 'vuex'
  export default {
    props : ['produks', 'bahans', 'pemesans'],
    name : 'tabel',
    created(){
        
        
    },
    data () {
      return {    
        pukul : moment().format('h:mm a'),  
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
         keyInput : 0, //utk hapus gbr ketika clear     
         total : [],
         ket : [],  //utk ls or fns     
         sisi : [], //1 ssi or
         printcut : [],

      }
    },
  
    methods : {
       ...mapActions('spk_stores', ['besar_uk_font', 'kecil_uk_font', 'pesan_aktif']),
        nama (param){ 
          //ketika diklik maka inputan terbuka, vue select tertutup
           this.selected_nm_brg = null;
            var isian_input= this.show_input = param;  
            var urutan_aktif = param;
          return  this.$store.commit('spk_stores/SHOW_INPUT', isian_input)  || this.$store.commit('spk_stores/SHOW_URUTAN', urutan_aktif);                    
        },
        update(param) {
           this.show_input = null;
           this.show_select = null;
           return  this.$store.commit('spk_stores/SHOW_SELECT', null) ||  this.$store.commit('spk_stores/SHOW_INPUT', null);    ;    
                    
        },
          handleImg(evt, index){     // ini untuk auto matis mode, 
           this.pukul = moment().format('h:mm a');
                  this.clear(index);
                        var filename = event.target.files[0].name;
                          let extensi = filename.split('.').pop();
                            let nama_foto = filename.split('.').slice(0, -1).join('.');  //nama file
                                 this.spk.data[index].nama_brg = nama_foto;  
                 //jika tif, jika tida ada ap260 bontak vinil dll maka jalankan hendel tif
                 let nama_text = nama_foto.toLowerCase().replace(/\s+/g, ' ').trim();
                this.spk.data[index].qty = '1'; //default qty satu

                    function findWord(kata, kalimat) { //fungsi mencari kata
                        return RegExp('\\b'+ kata +'\\b').test(kalimat)
                    }   
                    
                  if('tif' == extensi) {   //jika tiff  
                    this.spk.data[index].bahan = this.bahanDefault;                                    

                  var bahan = this.bahan_data;             
                  let a = 0;           
                  for( a;  a < bahan.length; a++){                   
                     var dt_bahan = bahan[a];
                      if(findWord(dt_bahan.nama_alias, nama_text)) {
                        
                            this.spk.data[index].bahan = dt_bahan.nama;
                               this.spk.data[index].ukuranP = dt_bahan.panjang;
                                this.spk.data[index].ukuranL = dt_bahan.lebar;                                                                             
                             dt_bahan.uk_alias ?  this.spk.data[index].uk_alias = dt_bahan.uk_alias : '';                                            
                      }                                              
                       
                  }
                  this.spk.data[index].ukuranP ? "" :  this.hendelTif(evt, index);

                     //pencarian keterangan
                    this.ket.forEach(ket_sp => {                                                      
                         if( findWord( ket_sp.nama, nama_text)  ) {                           
                            this.spk.data[index].ket = ket_sp.ket;  
                             this.spk.data[index].fns = ket_sp.fns;  
                             this.spk.data[index].ls = ket_sp.ls;  
                                                                                                                                                  
                        }      //if1              
                    }); 
                    
                    //pencarian total outdoor
                    this.total.forEach(tot => {                                        
                         if( findWord( tot.nama, nama_text)  ) { 
                            if(tot.qty < 10){
                               this.spk.data[index].qty = tot.qty; 
                            }
                                                                                                                                                         
                        }       
                    });  

                  }// if 1 jika tiff
                  else { //jika lain tif
                      
                    this.bahan_data.forEach(a => {                       
                         if( findWord( a.nama_alias, nama_text)  ) {                        
                              this.spk.data[index].bahan = a.nama;                                                    
                              a.uk_alias ?  this.spk.data[index].uk_alias = a.uk_alias : '';
                        }      //if1                                                                          
                    });       
                    this.sisi.forEach(sis => {     //mencari 1 sisi                                    
                         if( findWord( sis.nama, nama_text)  ) {                                      
                              this.spk.data[index].ket = sis.ket;                                                                                                                             
                        }       
                    });                                                                   

                   const lam =this.laminasi;                   
                  let i = 0;
                  var tampung_laminasi ='';
                  for( i;  i < lam.length; i++){
                     var dt_lam = lam[i];
                      if(findWord(dt_lam.nama, nama_text)) {
                        tampung_laminasi =  dt_lam.ket;
                      }
                       
                  }


                   const print =this.printcut;                   
                  let y = 0;
                  var tampung_printcut ='';
                  for( y;  y < print.length; y++){
                     var dt_print = print[y];
                      if(findWord(dt_print.nama, nama_text)) {
                        tampung_printcut =  dt_print.ket;
                      }
                       
                  }

                this.spk.data[index].ket = this.spk.data[index].ket+ " " + tampung_laminasi + tampung_printcut; 

                    //pencarian total selain outdoor
                    this.total.forEach(tot => {                                        
                         if( findWord( tot.nama, nama_text)  ) {                           
                               this.spk.data[index].qty = tot.qty;                                                                                                                                                                                     
                        }       
                    }); 

                  } //tutup else                                                                                                                                                                                     
                                                                                                                                                                      
 
                      
          },
          hendelTif(evt, index) {//tangani tiff             
                var tgt = evt.target || window.event.srcElement,
                  files = tgt.files;                
                if (FileReader && files && files.length) {          
                  var fr = new FileReader();            
                  fr.onload = function  (e) {                                                                        
                      Tiff.initialize({
                        TOTAL_MEMORY: 100000000
                      });
                      var tiff = new Tiff({
                        buffer: e.target.result
                      });
                      var tiffCanvas = tiff.toCanvas();    
                                                               
                         var rx = this.resolusi; //diambil dari stores
                        var pjg = tiffCanvas.width;
                        var lbr = tiffCanvas.height;
                        var konverCM_pjg = pjg / rx ;
                        var konverCM_lbr =  lbr / rx;
                        if(this.uk_label > 1) { //jika file ada label artinya betambah cmnya
                            konverCM_pjg = konverCM_pjg-this.uk_label;
                            konverCM_lbr = konverCM_lbr-this.uk_label;
                        }
                   
                         this.spk.data[index].ukuranP = Math.round(konverCM_pjg);
                           this.spk.data[index].ukuranL = Math.round(konverCM_lbr);


                          //  https://www.pixelto.net/px-to-cm-converter

                  }.bind(this);
                    
                  fr.onloadend = function (e) {
                    console.debug("Load End");
                  }
                  fr.readAsArrayBuffer(files[0]);                               

                }
          },
          tanganiImg(evt, index){ //ini tuk mode manual
              var filename = evt.target.files[0].name
              let nama_foto = filename.split('.').slice(0, -1).join('.');                                       
              this.spk.data[index].nama_brg = nama_foto;
          },
        clear(evt){
          this.spk.data[evt].nama_brg = "";
          this.spk.data[evt].bahan = "";
          this.spk.data[evt].ukuranP = "";
          this.spk.data[evt].ukuranL = "";
          this.spk.data[evt].qty = "";
           this.spk.data[evt].uk_alias= '',
          this.spk.data[evt].fns = false;
          this.spk.data[evt].ls = false;
          this.spk.data[evt].ket = "";
          this.tampil = {           
            1:'',
            2: '',
            3:'',
            4 : ''
          };       
          this.keyInput++;
          
        },
        clear_all(){

          for (let i = 0; i < 4; i++) {           
          this.spk.data[i].nama_brg = "";
          this.spk.data[i].bahan = "";
          this.spk.data[i].ukuranP = "";
          this.spk.data[i].ukuranL = "";
          this.spk.data[i].qty = "";
           this.spk.data[i].uk_alias= '',
          this.spk.data[i].fns = false;
          this.spk.data[i].ls = false;
          this.spk.data[i].ket = "";
          }          
          this.tampil = {           
            1:'',
            2: '',
            3:'',
            4 : ''
          };       
          this.keyInput++;
          
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
                 this.tampil[posisi] = evt.target.result;
                  this.spk.foto = evt.target.result;
              };
              reader.readAsDataURL(blob);
            }
          }, //tutup onpaste
       
        aktif_pemesan(){
          this.pemesan_aktif = this.pemesan_aktif ? false : true;
          this.pemesan_input = this.pemesan_input ? false : true;
        },
        aktif_pesan(){
          this.pesan_aktif();
        },

        tgl_show (data){
            var tgl = data? data : moment();
          return moment(tgl).format('dddd, DD-MMM-YYYY');          
        },
        run_waktu(){          
            var time = this;
            setInterval(function () {
              
            time.pukul = moment().format('h:mm a');
          }, 1800000);
            //interval 30 menit

        }

    }, //tutup metod
        computed : {
        ...mapState('spk_stores', {
            spk : state=> state.spk,            
            uk_font : state=> state.uk_font,
            options : state=> state.options,
              ket_lain : state=> state.ket_lain,
              // show_select : state => state.show_select,
              // show_input : state => state.show_input,
              urutan : state => state.urutan,
               resolusi : state => state.resolusi,
               uk_label : state => state.uk_label,
               mode : state => state.mode,
              bahanDefault : state => state.bahan.default,
              ttd : state => state.ttd
               
            
        }),
        ...mapState('data_spk_stores', {
            pemesan : state => state.pemesan,
             data_spks : state=> state.data_spks,
        }),
        ...mapState('bahan_stores', {
            bahan_data : state=> state.bahans.data
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
        this.spk.data[id].nama_brg = `${selected_nm_brg}`; 
        this.spk.data[id].ukuranP = this.selected_nm_brg.panjang; 
         this.spk.data[id].ukuranL = this.selected_nm_brg.lebar; 
         this.spk.data[id].produk_id = this.selected_nm_brg.produk_id; 
         this.spk.data[id].qty = 1;                 

         this.spk.data[id].bahan = this.selected_nm_brg.bahan[0].nama;
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

          this.spk.data[id].ket = this.selected_nm_brg.ket[0]; //ambil satu
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
       var pjg = this.spk.data[id].ukuranP;
           this.spk.data[id].ukuranP = pjg ? pjg : this.selected_bahan.panjang; 
        var lbr =  this.spk.data[id].ukuranL;
           this.spk.data[id].ukuranL = lbr ? lbr :  this.selected_bahan.lebar;          
        this.spk.data[id].bahan = this.selected_bahan.label;     
          //matikan  vue select sehingga sehingga input muncul  
        this.show_select = null; 
       },
       selected_ket(){
          var id = this.show_select;  
        this.show_input = id;
         this.spk.data[id].ket = this.selected_ket; 
         this.show_select = null;                   
       },
      selected_nm_pemesan() {                
       this.spk.nama_pemesan= this.selected_nm_pemesan.nama_asli;
       this.spk.no_wa = this.selected_nm_pemesan.telpon;       
        this.show_select = null; 
      },  
       


    },
    mounted() {
        this.run_waktu();
        axios.get('/api/bahan/total').then( (response) => {              
               this.total = response.data.total;
               this.ket = response.data.ket;
               this.sisi = response.data.sisi;
                 this.laminasi = response.data.laminasi;
                this.printcut = response.data.printcut;              
            }) 

        const plugin = document.createElement("script");
        plugin.setAttribute(
          "src",
          "https://cdn.rawgit.com/seikichi/tiff.js/master/tiff.min.js"
        );
        plugin.async = true;
        document.head.appendChild(plugin);
      }
      
            
  
  }
</script>

<style>

/* warna pada saat mode print */
@media print {tr.print_warna {
             
                -webkit-print-color-adjust: exact;              
                   color-adjust: exact!important;  
        -webkit-print-color-adjust: exact!important; 
         print-color-adjust: exact!important;
                
    }}
   
   

</style>



<style scoped>



   input.largerCheckbox { 
            transform : scale(2); 
        } 

    #filePhoto {
background-color: aqua;
    position: absolute; 
padding: 2px;
  width: 100%;
  height: 100%;
    z-index: 1;
    opacity: 0; 
    cursor: pointer;   
    left: 0;
    
}
.uploader {
  position: relative;
  /* background-color: red; */
    border: 0.1px solid grey;
      margin: 5px;
      height: 95px;
      margin-left: -27px;
}

.batas_nama_file {
  white-space: nowrap; 
  width: 120px; 
  overflow: hidden;
  text-overflow: ellipsis; 

}

.batas_nama_ket {
  white-space: nowrap; 
  width: 145px; 
  overflow: hidden;
  text-overflow: ellipsis; 

}

#demoFont {
  padding-top: 5px;
display: inline-block;
font-size: 18px;
transform: scale(1.2, 2);
font-family: "Arial Black";
width: 80%;
}

.tinggi {
  height: 40px;
}


.nama_pemesan {
  padding-top: 5px;
display: inline-block;
font-size: 18px;
transform: scale(1.1, 3);
font-family: "Arial Black";
}

.ukuran {  
font-size: 15px;
transform: scale(1.1, 2);
font-family: "Arial";

}

.qty {  
font-size: 16px;
transform: scale(1.1, 2);
font-family: "Arial";
}
</style>

