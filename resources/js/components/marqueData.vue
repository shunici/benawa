<template>
    <div class="marquee">
 
      <p style="font-size : 15px" v-for="(item, index) in infos.data" :key="index + 'info' ">
       
           <span v-html="item.deskripsi"></span>
        
      </p>
      
    </div>
</template>

<script>

import { mapActions, mapState } from 'vuex'
import moment from "moment"
moment.locale('id'); 
export default {
    name : 'agenda-marque',
    components : '',
    created() {               

    },
    data() {
        return {
         
           
        }
    },

    computed : {
        ...mapState('info_stores', {
            infos : state=> state.infos,          
        }),


    },

   
}
</script>

<style> .marquee {
                height: 50px;
                overflow: hidden;
                position: relative;
       
         
            }            
            .marquee p {
                position: absolute;
                width: 100%;
                height: 100%;
                margin: 0;
                line-height: 50px;
                text-align: center;
                -moz-transform: translateX(100%);
                -webkit-transform: translateX(100%);
                transform: translateX(100%);
                -moz-animation: scroll-left 20s linear infinite;
                -webkit-animation: scroll-left 20s linear infinite;
                animation: scroll-left 60s linear infinite;
            }
            
            @-moz-keyframes scroll-left {
                0% {
                    -moz-transform: translateX(100%);
                }
                100% {
                    -moz-transform: translateX(-100%);
                }
            }
            
            @-webkit-keyframes scroll-left {
                0% {
                    -webkit-transform: translateX(100%);
                }
                100% {
                    -webkit-transform: translateX(-100%);
                }
            }
            
            @keyframes scroll-left {
                0% {
                    -moz-transform: translateX(100%);
                    -webkit-transform: translateX(100%);
                    transform: translateX(100%);
                }
                100% {
                    -moz-transform: translateX(-100%);
                    -webkit-transform: translateX(-100%);
                    transform: translateX(-100%);
                }
            }
</style>
