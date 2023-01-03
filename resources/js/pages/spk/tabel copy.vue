<template>
    <div>



    <div class="row" v-for="(row, index) in spk" :key=" 'tabelspk'+index"> 
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
                <div class="text-uppercase nama_pemesan tinggi"  v-else> {{row.nama_pemesan}}</div>
                </th>
          </tr>
      </table>
      <table class="table table-bordered text-center table-sm" style="width : 30%; float:left; ">
          <tr class="thead-light">
              <th>No. Nota</th>
          </tr>
            <tr>
              <th class="tinggi"><input type="text" class="form-control"></th>
          </tr>
      </table>
       <table class="table table-bordered text-center table-sm" style="width : 30%;">
          <tr class="thead-light">
              <th >Tanggal Masuk</th>
          </tr>
            <tr>
              <th class="tinggi"> <input  type="text" class="form-control text-center" :value="tgl_show(row.tgl)"></th>
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
         <tr class="text-center" v-for="(item, index) in row.data" :key="'trtd' +index"  >
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
              <div class="ukuran" v-if="item.uk_alias"><b>{{item.uk_alias}}</b>  </div>
              <div class="ukuran" v-else-if="item.ukuranP"> <b> {{item.ukuranP}} x {{item.ukuranL}} </b> </div>
              </span>             
             </td>

           <td @click="nama(index)">
              <span v-if="index == show_select">   <v-select :options="bahans"  v-model="selected_bahan" ></v-select>   </span>

           <input type="text" v-else-if="index == show_input" v-model="spk[0].data[index].bahan"  @dblclick="show_select = index"  @keyup.enter="update(index)" >
                <div class=" ukuran text-uppercase text-center" v-else> <b>{{item.bahan}}</b> </div>
           </td>

           <th @click="nama(index)">
          <input type="text" v-if="index == show_input"  v-model="spk[0].data[index].qty" style="width: 100%" @keyup.enter="update(index)">
             <span class="qty" v-else>{{item.qty}}</span>
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

              <table  class="table table-bordered table-sm ">
                  <div v-for="(row, index) in spk" :key="'tbl bawah'+index">
                    <div v-for="(item, index) in row.data" :key="index" >
                    <tr style="text-align: left; vertical-align: top;"
                    v-if="item.ket.length > 10 "
                    >                                                
                       <div :style="{fontSize : uk_font + 'rem'}">Ket. No {{index+1}} →  <strong class="text-uppercase">{{item.ket}}</strong> </div>
                    </tr>                  
                    </div>                             
                  </div>

                     <tr class="text-center">
                       <input  v-if="ket_lain.aktif" type="text" class="form-control" v-model="ket_lain.pesan" >
                      <div id="demoFont" v-else :style="{fontSize : uk_font + 'rem'}"><strong class="text-uppercase">{{ket_lain.pesan}}</strong> </div>
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

          
    </div> 

  <div v-for="(row, index) in spk[0].data" :key="'ket'+index" class="d-inline">
    <div class="d-inline" v-if="row.nama_brg"> <span class="badge badge-dark">{{index+1}}</span> {{row.nama_brg}} |&ensp;</div>

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
        this.ambil_data_pemesan();
        
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
       ...mapActions('data_spk_stores', ['ambil_data_pemesan']),
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
          handleImg(evt, index){     // ini untuk auto matis mode, 
           this.pukul = moment().format('h:mm a');
                  this.clear(index);
                        var filename = event.target.files[0].name;
                          let extensi = filename.split('.').pop();
                            let nama_foto = filename.split('.').slice(0, -1).join('.');  //nama file
                                 this.spk[0].data[index].nama_brg = nama_foto;  
                 //jika tif, jika tida ada ap260 bontak vinil dll maka jalankan hendel tif
                 let nama_text = nama_foto.toLowerCase().replace(/\s+/g, ' ').trim();
                this.spk[0].data[index].qty = '1'; //default qty satu

                    function findWord(kata, kalimat) { //fungsi mencari kata
                        return RegExp('\\b'+ kata +'\\b').test(kalimat)
                    }   
                    
                  if('tif' == extensi) {   //jika tiff  
                    this.spk[0].data[index].bahan = this.bahanDefault;                                    

                  var bahan = this.bahan_data;             
                  let a = 0;           
                  for( a;  a < bahan.length; a++){                   
                     var dt_bahan = bahan[a];
                      if(findWord(dt_bahan.nama_alias, nama_text)) {
                        
                            this.spk[0].data[index].bahan = dt_bahan.nama;
                               this.spk[0].data[index].ukuranP = dt_bahan.panjang;
                                this.spk[0].data[index].ukuranL = dt_bahan.lebar;                                                                             
                             dt_bahan.uk_alias ?  this.spk[0].data[index].uk_alias = dt_bahan.uk_alias : '';                                            
                      }                                              
                       
                  }
                  this.spk[0].data[index].ukuranP ? "" :  this.hendelTif(evt, index);

                     //pencarian keterangan
                    this.ket.forEach(ket_sp => {                                                      
                         if( findWord( ket_sp.nama, nama_text)  ) {                           
                            this.spk[0].data[index].ket = ket_sp.ket;  
                             this.spk[0].data[index].fns = ket_sp.fns;  
                             this.spk[0].data[index].ls = ket_sp.ls;  
                                                                                                                                                  
                        }      //if1              
                    }); 
                    
                    //pencarian total outdoor
                    this.total.forEach(tot => {                                        
                         if( findWord( tot.nama, nama_text)  ) { 
                            if(tot.qty < 10){
                               this.spk[0].data[index].qty = tot.qty; 
                            }
                                                                                                                                                         
                        }       
                    });  

                  }// if 1 jika tiff
                  else { //jika lain tif
                      
                    this.bahan_data.forEach(a => {                       
                         if( findWord( a.nama_alias, nama_text)  ) {                        
                              this.spk[0].data[index].bahan = a.nama;                                                    
                              a.uk_alias ?  this.spk[0].data[index].uk_alias = a.uk_alias : '';
                        }      //if1                                                                          
                    });       
                    this.sisi.forEach(sis => {     //mencari 1 sisi                                    
                         if( findWord( sis.nama, nama_text)  ) {                                      
                              this.spk[0].data[index].ket = sis.ket;                                                                                                                             
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

                this.spk[0].data[index].ket = this.spk[0].data[index].ket+ " " + tampung_laminasi + tampung_printcut; 

                    //pencarian total selain outdoor
                    this.total.forEach(tot => {                                        
                         if( findWord( tot.nama, nama_text)  ) {                           
                               this.spk[0].data[index].qty = tot.qty;                                                                                                                                                                                     
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
                   
                         this.spk[0].data[index].ukuranP = Math.round(konverCM_pjg);
                           this.spk[0].data[index].ukuranL = Math.round(konverCM_lbr);


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
              this.spk[0].data[index].nama_brg = nama_foto;
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
          this.spk[0].data[i].nama_brg = "";
          this.spk[0].data[i].bahan = "";
          this.spk[0].data[i].ukuranP = "";
          this.spk[0].data[i].ukuranL = "";
          this.spk[0].data[i].qty = "";
           this.spk[0].data[i].uk_alias= '',
          this.spk[0].data[i].fns = false;
          this.spk[0].data[i].ls = false;
          this.spk[0].data[i].ket = "";
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
              show_select : state => state.show_select,
              show_input : state => state.show_input,
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

