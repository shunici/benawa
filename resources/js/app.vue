<template>
    <div>
     <headerComponent v-if="route_skr != 'kostumer' "></headerComponent>   
     <marque-data v-if="route_skr != 'kostumer' "></marque-data>      
   <div class="container-fluid">
          <router-view></router-view>
   </div>
    <footer-component v-if="route_skr != 'kostumer' "></footer-component>
         
    </div>
</template>

<script>
import footerComponent from './components/footerComponent.vue';
import headerComponent from './components/headerComponent.vue';
import MarqueData from './components/marqueData.vue'
import { mapActions, mapState } from 'vuex'
let ROOT_PATH = 'https://raw.githubusercontent.com/shunici/behabarusaha/main/blogbehabar/youreinvited.jpg'

    export default {
       components : {
           headerComponent, footerComponent, MarqueData
       },  
      data(){
          return {
                logo: ROOT_PATH,
          }
      },
       created () {
              // this.get_spk();                   

               
            
       },   
       
    mounted(){
      //utk tidak membebani buhan percetakan ngecek di hape terlalu banyak load
           setTimeout(function () {
             if(this.route_skr != 'kostumer') {           
                  this.get_agenda(); 
                this.get_alert();  
                this.get_label();  
                this.get_info();  
                this.get_karyawan();
                this.get_warna();
                this.get_spk(); 

                var input = prompt("Masukkan kata Sandi :"); // Menampilkan prompt untuk meminta input dari pengguna
                    if (input !== "nela") {
                      this.$router.go(-1);
                    }
             }                
                
            }.bind(this), 2000)
    },

    computed : {
        ...mapState('karyawan_stores', {
            karyawans : state=> state.karyawans,
            karyawan : state=> state.karyawan,
        }),
        ...mapState('label_stores', {
                labels : state=> state.labels
            }),
        ...mapState('info_stores', {
                infos : state=> state.infos
            }), 
          route_skr() {
        return this.$route.name;
        }

    },
    methods : {
            ...mapActions('info_stores', ['get_info']),
        ...mapActions('karyawan_stores', ['get_karyawan']),     
        ...mapActions('agenda_stores', ['get_agenda']),                  
        ...mapActions('alert_stores', ['get_alert']),     
         ...mapActions('label_stores', ['get_label']),  
            ...mapActions('spk_stores', ['get_spk', 'get_warna']),    
      
    }, metaInfo() {
    const a = "test";
    return {
      title: "SPK Benawa Printing",
      meta: [
        ...(a === "test" && [
          {
            vmid: "ab",
            name: "nam",
            content:
              "hello world, this is an example of adding a description with vue-meta"
          },
           {property: 'og:image', content:  this.logo},
        ])
      ],
			script: [
        { src: '<https://services.postcodeanywhere.co.uk/js/address-3.91.js>', async: true, defer: true, body: true }
      ],
			link: [
        {
          rel: 'canonical',
          href: '<https://malikgabroun.com/>'
        }
			]
    };
  }

    }
</script>
