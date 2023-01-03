<template>
    <div class="container-fluid" v-if="cekBox.alert">
      
      <div class="alert alert-success" role="alert" v-if="pesan">
          <strong class="text-center"><h2>Berhasil diupdate!</h2></strong>
      </div>
          <draggable v-model="alerts.data" group="items" v-bind="dragOptions" @change="log">  
    
        <div class="alert  alert-dismissible fade show" role="alert" v-for="(row, index) in alerts.data" :key="index"  :style="{'background-color' : row.bgColor}" v-b-toggle="'alert' + index">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>            
    <b-button-group class="float-right" v-if="cekBox.aksi">
            <b-button  v-b-modal="'modal' + index" variant="warning" class="btn-sm" @click="edit(row.id, index)"> <b-icon icon="chat-left-quote"></b-icon> Respons</b-button> 
            <b-button v-if="row.spk_id" variant="success" @click="show(row.spk_id)"> <b-icon icon="eye"></b-icon> Lihat SPK </b-button> 
            <b-button v-if="row.spk_id" variant="primary" @click="hubungi(row.spk.nama_pemesan, row.spk.no_wa)">
            <b-icon icon="person-fill" aria-hidden="true"></b-icon> Chat
            </b-button>     
            <b-button variant="danger" v-on:click="hapus(row.id)" class="btn-sm"><b-icon icon="trash-fill" aria-hidden="true"></b-icon> Hapus</b-button>
    </b-button-group>
            <!-- //jka ada spk_id -->
            <strong v-if="row.spk_id" v-b-tooltip.hover.top="row.text_detail">{{row.text}}</strong> 
            <span v-if="row.spk_id" class="badge badge-warning" > {{row.spk.nama_pemesan}} | {{row.kategori}} | {{status_spk(row.spk.status)}}</span>
            <span v-if="row.spk_id" class="badge" :style="{'background-color' : row.spk.label.warna, 'font-size' : '12px' }">{{row.spk.label.nama}}</span>
                     <!-- //jka tidak ada spk_id -->
                     
            <strong v-if="!row.spk_id" v-b-tooltip.hover.top="row.text_detail">{{row.text}}</strong> 
            <span v-if="!row.spk_id" class="badge badge-warning" >{{row.kategori}}</span>
            
            
            <a href="#" v-if="row.foto" @click.prevent="gambar_link(row.foto)"  >Lihat Detil...</a>  
            <span v-b-tooltip.hover.v-warning="tgl_show(row.created_at) +' ' + pkl_show(row.created_at)">dibuat {{dibuat(row.created_at)}} | </span>
            <span>Direspon oleh {{row.user2}}  ( {{dibuat(row.updated_at)}} )  </span>
              <timer-waktu v-if="row.estimasi && cekBox.estimasi" :estimasi="row.estimasi"></timer-waktu>
              <span v-if="row.response" v-b-tooltip.hover.top="row.detil"  :style="{'background-color' : 'black', 'font-size' : '18px'}" class="badge  text-uppercase float-right">{{row.response}}</span>   




        </div>

       </draggable> 

  
  <b-modal ref="my-modal-alert"   :id="'modal' + modal_index" size="lg" title="Respose"  ok-only>

    <div class="form-group">
        <label for="txtt">Beri Response</label>                  
        <input type="text" v-model="alert.response" class="form-control">      
    </div>
    
     <div class="form-group">
       <label for="des">Detail</label>
       <textarea name="" id="des" cols="20" rows="2" class="form-control"  v-model="alert.detil"></textarea>        
     </div>

    <div class="form-check form-check-inline" v-for="(item, andax) in labels.data" :key="andax+'labl'">
      <label class="form-check-label" >
        <input class="form-check-input" v-model="alert.response" type="radio" name="label" :value="item.nama"> {{item.nama}}
      </label>
    </div>  
            
     <div class="form-group mt-3">
       <label for="w">Ubah Warna BG</label> <br>
          <span @click="pilih('')" class="btn m-0">No Color</span>
         <span class="btn m-0" v-for="(atam, undux) in warnaBG" :key="undux+'bg'">
           <b-icon @click="pilih(atam)" icon="bookmark-fill" aria-hidden="true" :style="{'color' : atam}" ></b-icon>
          </span>         
     </div>
     <div class="form-grup" :style="{'background-color' : alert.bgColor}">
         {{alert.bgColor}}
     </div>     
     
                          <b-form-datepicker placeholder="Buat Estimasi Waktu Ambil" id="tanggal"   v-model="waktu"  :locale="'id'"  class="mt-3"></b-form-datepicker>                                                                 
                           <b-time v-model="value" :locale="'id'"></b-time>
                           <h4>{{tgl_show(alert.estimasi)}} - {{pkl_show(alert.estimasi)}} </h4>

  <template #modal-footer>                     
      <b-button size="sm"  variant="success" @click="ok(id_alert)">
          Proses
      </b-button>      
    </template>

      
    </b-modal>



    </div>
</template>

<script>
import timerWaktu from '../../components/timer.vue'
import { mapActions, mapState } from 'vuex'
      import draggable from 'vuedraggable'
import moment from "moment"

moment.locale('id'); 
export default {
    name : 'agenda-admin',
    components : {draggable, timerWaktu},
    created() {               
         setInterval(() =>    this.get_alert(), 600000); //fungsi jalan setiap 10 menit
    },
    data() {
        return {
            modal : '',
            modal_index : '',
            id_alert : '',
            fields: [
                {key: 'kategori', sortable: true},
                {key: 'text', sortable: true},
                {key: 'voiceText', sortable: true},           
                {key: 'color', sortable: true},           
                {key: 'bgColor', sortable: true},           
                {key: 'icon', sortable: true},           
                {key: 'posisi', sortable: true},           
                {key: 'aksi', sortable: false}, //TAMBAHKAN CODE INI
            ],
            pesan : false,
          
            waktu : '',
            value : ''
           
        }
    },

    computed : {
        ...mapState('alert_stores', {
            alerts : state=> state.alerts,
            alert : state=> state.alert,
            warnaBG : state=> state.warnaBG,
        }), 
        ...mapState('label_stores', {
            labels : state=> state.labels
        }),
        ...mapState('agenda_stores', {             
                     cekBox : state => state.cekBox,                                
            }),
        ...mapState('karyawan_stores', {        
            karyawan : state=> state.karyawan,
        }),  
          dragOptions() { //fungsi nya pabila cekbox di klik maka drag tidk jalan
            return {
              animation: 0,
              group: "description",
              disabled: !this.cekBox.drag,
              ghostClass: "ghost"
          };
        },


    },
        watch : {          
          waktu() { //properti waktu di hendel watch waktu memberikan ke vue state
            this.alert.estimasi = this.waktu;            
          },    
          value () {
              let waktu_estimasi = this.waktu + ' ' + this.value;
              this.alert.estimasi = waktu_estimasi;
          },
        },
    methods : {
         ...mapActions('label_stores', ['get_label']),
        ...mapActions('alert_stores', ['get_alert', 'gabung_alert', 'jalankan_log', 'update_alert', 'edit_alert', 'remove_alert']),
        
        hapus(param){                                               
              let person = prompt("Yakin anda menghapus file ini ? :", "ya");
              if (person == null || person == "") {
               
              } else {
               this.remove_alert(param);
               this.get_alert();
              }
          
        },
        
        show(param){ //show make edit aja biar kd ribet
             this.$router.push({
                  name : 'spk.edit',
                  params : {id : param}
              })
        }, 
        edit(param, index){
          this.modal_index = index;
          this.id_alert = param;
           this.edit_alert(param);        
                setTimeout(function () {
                  this.alert.user2 = this.karyawan.nama;
             }.bind(this), 990)

        },                   
              dibuat (data){  //hanya membaca menit 
              const created = moment(data);
              const sekarang = moment();
              const diff = sekarang.diff(created);
              const diffDuration = moment.duration(diff);
              let hari  = diffDuration.days() > 0 ? diffDuration.days() + ' Hari ' : '' ;
              let jam = diffDuration.hours() > 0 ? diffDuration.hours() + ' Jam ' : '';
              let menit = diffDuration.minutes() > 0 ? diffDuration.minutes() + ' Menit ' : '';
              
              return  hari + jam + menit + ' lalu';               
              }, 
                     
                ok (param) {
                    this.pesan = true, 
                    this.update_alert(param);                                
                    this.get_alert(); 
                      
                    setTimeout(function () {
                    this.pesan = false
                    }.bind(this), 3000) 
                    this.$refs['my-modal-alert'].hide();
                },
          pilih(data){                  
              this.alert.bgColor = data;                       
          },  
        tgl_show (data){
            var tgl = data? data : '';
            if(tgl) {
              return moment(tgl).format('dddd, DD-MMM-YYYY');   
            }else{ return "-"}                           
        },    
        pkl_show (data){          
            var tgl = data? data : '';
            if(tgl) {
              return moment(tgl).format('h:mm a')   
            }else{ return "-"}        
        },
         hubungi (kost, wa) {                    
              
               let teks = ` Admin ${kost},`
            if (wa) {
              window.location.href =  `https://wa.me/${wa}?text=${teks}`;
            }
             
        },   
        gambar_link(data){
              window.open(data, '_blank');
        },
         log: function() {           
                       this.jalankan_log();                                      
         },
         status_spk(param){
           if(param == 'cp'){
             return 'Cetakan Pending'
           }
           if(param == 'cm'){
             return 'Cetakan Masuk'
           }
           if(param == 'cs'){
             return 'Cetakan Selesai'
           }
         }
    }

   
}
</script>
