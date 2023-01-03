<template>
  <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">TKJ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                    <router-link :to="{name : 'home'}" class="nav-link">Home</router-link>
            </li>
            <li class="nav-item">
                  <router-link :to="{name : 'spk'}" class="nav-link">SPK</router-link>
            </li>
            
            <li class="nav-item">
                  <router-link :to="{name : 'agenda'}" class="nav-link">Agenda</router-link>
            </li>

            <router-link class="nav-item nav-link" :to=" {name: 'transaksi.data' } ">Data</router-link>
               <router-link class="nav-item nav-link" :to=" {name: 'transaksi.csd' } ">CSD</router-link>




            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Settingan
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <router-link :to="{name : 'info.data'}" class="dropdown-item"> Info</router-link>
                  <router-link :to="{name : 'bahan.data'}" class="dropdown-item"> Bahan</router-link>
                <router-link :to="{name : 'produk.data'}" class="dropdown-item"> Produk</router-link>
                <router-link :to="{name : 'label.data'}" class="dropdown-item"> Label</router-link>
                <router-link :to="{name : 'alert.data'}" class="dropdown-item"> Alert</router-link>
                   <router-link :to="{name : 'data_spk.data'}" class="dropdown-item"> Keterangan SPK</router-link>
              <router-link :to="{name : 'pemesan.data'}" class="dropdown-item"> Pemesan</router-link>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Road Map</a>
                 <router-link :to="{name : 'karyawan.data'}" class="dropdown-item"> Karyawan</router-link>
                </div>
            </li>
       
            </ul>
          <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-left" href="#">{{currentKaryawan}}</a>
            </li>
           
        </ul>
           

        </div>
        </nav>
  </div>
</template>
<script>
    import {mapState } from 'vuex'
    export default {
       name : 'header',
       computed : {         
        ...mapState('karyawan_stores', {
            currentKaryawan : state=> state.currentKaryawan,                                  
        }),  
       }

    }
</script>
