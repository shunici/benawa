
<template>
    <div>

        <input type="text" v-model="searchText" class="form-control" @change="handleChange">
        

    </div>
</template>
<script>
import { mapActions, mapState } from 'vuex'
export default {
    name : 'searching',
    created() {                       
    },
    data() {
      return {
          searchText : ''
      }
    },

    computed : {
       

    },
    watch : {
     
    },
    methods : {
        handleChange(){
            this.$emit('search', this.searchText);
        }

        
                
    }

   
}
</script>
