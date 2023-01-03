<template>
                        
<div class="container">
        <section class="content-header">
                <h1>Produk </h1>                                                                                                        
                   <b-button-group>
                      <router-link :to="{name : 'produk.data'}" class="btn btn-secondary outline-secondary">Data</router-link>
                       <router-link :to="{name : 'produk.add'}" class="btn btn-secondary outline-secondary">Tambah</router-link>
                  </b-button-group>
    <button class="btn btn-success float-right" @click="$router.go(-1)">Kembali</button>  
        </section>

        <section class="content">
        <div class="row">
                    <router-view></router-view>
        </div>
        </section>
</div>
 
</template>