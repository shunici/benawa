<template>
    <div>
      <h3 class="mt-4">I hope this application is useful for your joblist</h3>
      
</div>
</template>


<script>

import {PhotoCapture} from 'vue-media-recorder'
export default {
 data(){
        return {
            imageBase64: '',         
        }
    },
    methods : {
      klik(){
    
        console.log(this.imageBase64);
      }
    },
    components:{
        PhotoCapture,
        
    }
};
</script>

<style lang="scss">
.speech-to-txt,
.txt-to-speech {
  display: grid;
  width: 200px;
  height: 100px;
  border-radius: 20px;
  border: 2px solid grey;
  background-color: rgb(248, 245, 245);
  font-size: 38px;
  color: black;
  font-family: Arial, Helvetica, sans-serif;
  place-items: center;
}
.speech-transciption {
  width: 500px;
  padding: 20px;
  border: 2px solid grey;
  background-color: rgb(211, 228, 253);
  border-radius: 20px;
}
</style>