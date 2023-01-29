<template>
    <div>
     <headerComponent></headerComponent>   
     <marque-data></marque-data>      
   <div class="container-fluid">
          <router-view></router-view>
   </div>
    <footer-component></footer-component>
         
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
      metaInfo() {
    return {
      meta: [
        // Twitter Card
        {name: 'twitter:card', content: 'summary'},
        {name: 'twitter:title', content: 'Vue Social Cards Example'},
        {name: 'twitter:description', content: 'Vue sample site showing off Twitter and Facebook Cards.'},
        {name: 'twitter:image', content: this.logo},
        // Facebook OpenGraph
        {property: 'og:title', content: 'Vue Social Cards Example'},
        {property: 'og:site_name', content: 'Vue Example'},
        {property: 'og:type', content: 'website'},
        {property: 'og:image', content:  this.logo},
        {property: 'og:description', content: 'Vue sample site showing off Twitter and Facebook Cards.'}
      ]
    }
  },
       created () {
              this.get_spk();                   
            this.get_agenda(); 
            this.get_alert();  
            this.get_label();  
                    this.get_info();  
                this.get_karyawan();
                this.get_warna();
                
            
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

    },
    methods : {
            ...mapActions('info_stores', ['get_info']),
        ...mapActions('karyawan_stores', ['get_karyawan']),     
        ...mapActions('agenda_stores', ['get_agenda']),                  
        ...mapActions('alert_stores', ['get_alert']),     
         ...mapActions('label_stores', ['get_label']),  
            ...mapActions('spk_stores', ['get_spk', 'get_warna']),    
      
    },

    }
</script>
