
<template>
    <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  
                                 
    <div class="form-check form-check-inline mt-2">
      <label class="form-check-label">
        <input v-on:change="query_kategori($event)" v-model="query.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Outdoor"> Outdoor
      </label>
    </div>                      
    <div class="form-check form-check-inline mt-2">
      <label class="form-check-label">
        <input v-on:change="query_kategori($event)"  v-model="query.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Versant"> Versant
      </label>
    </div>                      
    <div class="form-check form-check-inline mt-2">
      <label class="form-check-label">
        <input v-on:change="query_kategori($event)"  v-model="query.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Indoor"> Indoor
      </label>
    </div>                  
    <div class="form-check form-check-inline mt-2">
      <label class="form-check-label">
        <input v-on:change="query_kategori($event)"  v-model="query.kategori"  class="form-check-input" type="radio" name="kategori" id="" value="Merchandise"> Merchandise
      </label>
    </div>                  
    <div class="form-check form-check-inline mt-2">
      <label class="form-check-label">
        <input v-on:change="query_kategori($event)"  v-model="query.kategori"  class="form-check-input" type="radio" name="kategori" id="" value=""> Semua Kategori
      </label>
    </div>  


                </ol>
              
     
            </nav>
              


 
<h2 class="text-center">Data Cetakan {{query.kategori ? query.kategori : 'Semua Kategori' }}</h2>

<div class="row mb-3 mt-3 d-flex justify-content-center text-center">
    <div class="col-12">
        
<div class="form-check form-check-inline" v-b-tooltip.hover.bottom="'SPK yang baru dibuat akan berada disini'">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="" id="" v-model="cekBox.cm"> Cetakan Masuk
    </label>
</div>

<div class="form-check form-check-inline">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="" id="" v-model="cekBox.cp"> Cetakan Pending
    </label>
</div>
<div class="form-check form-check-inline">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="" id="" v-model="cekBox.cs"> Cetakan Selesai
    </label>
</div>
<div class="form-check form-check-inline">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" v-model="drag" name="" id=""> Mode Seret
    </label>
</div>
<div class="form-check form-check-inline">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" v-model="cekBox.waktu" name="" id=""> Waktu
    </label>
</div>
<div class="form-check form-check-inline">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" v-model="cekBox.estimasi" name="" id=""> Estimasi
    </label>
</div>
<div class="form-check form-check-inline" v-b-tooltip.hover.bottom="'Pemberitahuan Pesan dari Operator ke admin atau sebaliknya'">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" v-model="cekBox_agenda.alert" name="" id=""> Alert
    </label>
</div>
<div class="form-check form-check-inline">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" v-model="cekBox_agenda.aksi" name="" id=""> Aksi
    </label>
</div>

<!-- <div class="form-check form-check-inline">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="" id="" v-model="cekBox.CSD"> Cetakan Sudah Diambil
    </label>
</div> -->

    </div> <!-- col12 -->
    
                     <div class="col-md-4 mt-3">
                           <input  type="text" v-model="searching" class="form-control border-end-0 border rounded-pill" placeholder="Pencarian Nama Kostumer.....">
                    </div>  
                     <div class="col-md-4 mt-3">
                           <input  type="number" v-model="search" class="form-control border-end-0 border rounded-pill" placeholder="Pencarian Nomor Nota.....">
                    </div>                                                                                  
                    <div class="col-md-2 mt-3">                                         
                        <div class="form-group form-inline" >
                            <label for="" class="mr-4">Perhalaman {{perPage}}</label>
                            <select class="custom-select" v-model="perPage"  name="" id="" v-on:change="onChangeSite($event)">                                                         
                                  <option value="25">25</option>     
                                  <option value="50">50</option>  
                                  <option value="75">75</option>  
                                  <option value="100">100</option>  
                                  <option value="150">150</option>  
                                  <option value="200">200</option>                       
                            </select>
                        </div>
                    </div>  
                     <div class="col-md-2 mt-3">                        
                          <b-button class="float-right btn btn-success" @click="segarkan">
                            <b-icon icon="arrows-move"></b-icon> Refresh
                          </b-button>
                          <b-icon v-if="refresh_aktif" class="float-right" icon="arrow-clockwise" animation="spin-pulse" font-scale="3"></b-icon>
                          
                    </div> 

</div>    

<alert-info></alert-info>     
  
<hr>

 <b-card-group deck>         


    <b-card header-tag="header" footer-tag="footer"  v-if="cekBox.cm">
     <template #header>
        <h6 class="float-left mt-2 "> <b>CETAKAN MASUK</b> <span class="badge badge-warning"> {{cm.length }}</span> </h6> 
          <b-button  aria-controls="collapse-1"  @click="visible = !visible"  variant="primary" class="float-right">{{visible ? "Sembunyi" : "Detail"}}</b-button>       
      </template>
      <b-collapse id="collapse-1"  v-model="visible" >
       <draggable v-model="item_cm"  group="items" v-bind="dragOptions">
        <div v-for="(item, index) in cm" :key="index + 'cm'" >
            <td class="list-group-item list-group-item-action  text-left m-0 table-hover"  
              v-b-toggle="index+'cm'">          
                <span class="badge badge-secondary">{{index+1}}</span>
                <span><b>{{item.nama_pemesan}} </b>  </span>
                <span><b-icon icon="bookmark-fill" aria-hidden="true" :style="{'color' : item.warna}" ></b-icon></span> 
                    <span v-if="item.label.nama" v-b-tooltip.hover.html="label_user(item.user)" :style="{'background-color' : item.label.warna, 'font-size' : '10px'}" class="badge  text-uppercase float-right "> {{item.label.nama}}</span>   
                
              <span v-if="item.no_nota != 0"  class="badge badge-warning  float-right"> Nota {{item.kategori}} {{item.no_nota}}</span>    
                          <p v-if="cekBox.waktu" >{{tgl_show(item.created_at)}} - {{pkl_show(item.created_at)}}  ( {{dibuat(item.created_at)}} )</p>

                         <div  v-for="(ikem, kom) in alerts.data" :key="kom" >                           
                             <timer-waktu v-if="ikem.spk_id == item.id && cekBox.estimasi" :estimasi="ikem.estimasi"></timer-waktu> 
                          </div>                                                                                                                                                    
            </td>

            <b-collapse :id="index+'cm'"  class="mt-2">
                <b-card> 
                   <b-button-group>
                      <b-button variant="outline-secondary" @click="edit(item.id)">
                        <b-icon icon="pencil-square" aria-hidden="true"></b-icon> 
                      </b-button>
                      <b-button  v-b-tooltip.hover.top="'Hubungi pemesan'" variant="outline-secondary" @click="hubungi(item.nama_pemesan, item.no_wa, item.data, item.id)">
                       <b-icon icon="person-fill" aria-hidden="true" variant="success"></b-icon> 
                      </b-button>                       
                        <handle-form v-bind:dataid="item.id" ></handle-form>
                  </b-button-group>
                  
                 
                   <b-button-group class="float-right">
                      <alert-form v-bind:id_item="item.id" v-b-tooltip.hover.top="'menandai tugas / memberikan estimasi'"></alert-form>
                  </b-button-group>


        <br> <br>
        <h5 class="text-center" v-if="item.text"><b>{{item.text}}</b></h5>
              <table class="border-0 table-sm  table-responsive">
                <thead class="border-0">
                  <tr class="border-0">
                     <th class="border-0">NM</th>
                    <th class="border-0">:</th>
                    <th class="border-0">{{item.nama_pemesan}}</th>  
                    <th class="border-0">|</th>                
                     <th class="border-0">No</th>
                    <th class="border-0">:</th>
                    <th class="border-0">{{item.no_nota}}</th>                   
                  </tr>
                  <tr class="border-0">                   
                     <th class="border-0">Tgl </th>
                    <th class="border-0">:</th>             
                    <td class="border-0">{{tgl_show(item.created_at)}}</td>   
                           <th class="border-0">|</th>                
                     <th class="border-0">Pkl</th>
                    <th class="border-0">:</th>
                    <td class="border-0">{{pkl_show(item.created_at)}}</td>                 
                  </tr>
                
                </thead>               
              </table>                     
              <table class="table table-bordered table-sm table-responsive " style="widht : 100%">
                <thead class="text-center thead-dark">
                  <tr>
                    <th  style="width:5%">No</th>
                    <th style="width:25%">NM BRG</th>
                    <th style="width: 20%">UK</th>
                    <th style="width:20%">BHN</th>
                    <th style="width: 5%">QTY</th>
                    <th style="width: 5%">FS</th>
                    <th style="width: 5%">LS</th>
                    <th style="width: 15%">KET</th>         
                  </tr>
                </thead>
                  <tbody>
                      <tr v-for="(row, andax) in item.data" :key="row.id" >                        
                           <td v-if="row.nama_brg" >    {{ andax + 1}}  </td>
                          <td v-if="row.nama_brg" class="text-left ellipsis"> <span>{{row.nama_brg}}</span>  </td>
                          <td v-if="row.nama_brg" class="text-center">   
                              <span v-if="row.ukuranP">   {{row.ukuranP}} <div v-if="row.ukuranL" >x</div> {{row.ukuranL}}</span>
                                          <span v-else>{{row.uk_alias}}</span>
                          </td>
                          <td v-if="row.nama_brg" class="text-center">{{row.bahan}}</td>
                              <td v-if="row.nama_brg" class="text-center">{{row.qty}} </td>
                              <td v-if="row.nama_brg" class="text-center"> <input class="largerCheckbox"  type="checkbox" v-model="row.fns"></td>
                            <td v-if="row.nama_brg" class="text-center"><input class="largerCheckbox"  type="checkbox" v-model="row.ls" ></td>
                      
                          <td v-if="row.nama_brg" class="text-left ellipsis"> <span> {{row.ket}}</span>  </td>

                      
                      </tr>
                  </tbody>
                  
                </table>  
              <table  class="table border-0 table-sm ">                 
                            <div v-for="(rows, andix) in item.data" :key="andix + 'tblbawah'" >
                            <tr style="text-align: left; vertical-align: top;"
                            v-if="rows.ket != null && rows.ket.length > 10">                                                
                              <div>Ket. No {{andix+1}} →  <strong class="text-uppercase">{{rows.ket}}</strong> </div>
                            </tr>                  
                            </div>                                                                          
              </table> 
                <div v-for="(rowsi, indax) in item.data" :key="'kets'+indax" class="d-inline">
                  <div class="d-inline" v-if="rowsi.nama_brg"> <span class="badge badge-dark">{{indax+1}}</span> {{rowsi.nama_brg}} |&ensp;</div>
                </div>
                                     

        <button class="btn btn-danger float-right mb-2 btn-sm" @click="hapus(item.id)" v-b-tooltip.hover.top="'File yang dihapus tidak akan pernah kembali'">           	
            <b-icon icon="trash-fill" aria-hidden="true"></b-icon> Hapus
        </button><br>
                        <span class="badge  mr-1 mt-1" v-for="(san, sun) in item.user" :key=" 'in' + sun"
                        v-b-tooltip.hover.html="ket(san.ket, san.waktu )" :style="{backgroundColor: randomColor(sun+1)}">
                            {{san.nama}}
                        </span>
<br>
                   <img v-if="item.foto" :src="item.foto" alt="Girl in a jacket" width="230"> 
                    
                </b-card>
            </b-collapse>
        </div> <!-- tutuploop -->
         </draggable> 
      </b-collapse>    

        <template #footer>
                       
            <div class="float-left">
                <p><i class="fa fa-bars"></i> {{ currentPage }} item dari {{ cm.length }} total data</p>
            </div>
        </template>                             
    </b-card> <!-- cm -->

    <b-card header-tag="header" footer-tag="footer"  v-if="cekBox.cp">
     <template #header>
        <h6 class="float-left mt-2 "> <b>CETAKAN PENDING</b> <span class="badge badge-warning"> {{cp.length }}</span> </h6> 
          <b-button  aria-controls="collapse-1"  @click="visible = !visible"  variant="primary" class="float-right">{{visible ? "Sembunyi" : "Detail"}}</b-button>       
      </template>
      <b-collapse id="collapse-1"  v-model="visible" >
       <draggable v-model="item_cp"  group="items" v-bind="dragOptions">
        <div v-for="(item, index) in cp" :key="index + 'cp'" >
            <td class="list-group-item list-group-item-action  text-left m-0 table-hover"  
              v-b-toggle="index+'cp'">          
                <span class="badge badge-secondary">{{index+1}}</span>
                <span><b>{{item.nama_pemesan}} </b>  </span>
                <span><b-icon icon="bookmark-fill" aria-hidden="true" :style="{'color' : item.warna}" ></b-icon></span> 
                    <span v-if="item.label.nama" v-b-tooltip.hover.html="label_user(item.user)" :style="{'background-color' : item.label.warna, 'font-size' : '10px'}" class="badge  text-uppercase float-right "> {{item.label.nama}}</span>   
                
              <span v-if="item.no_nota != 0"  class="badge badge-warning  float-right"> Nota {{item.kategori}} {{item.no_nota}}</span>    
                          <p v-if="cekBox.waktu" >{{tgl_show(item.created_at)}} - {{pkl_show(item.created_at)}}  ( {{dibuat(item.created_at)}} )</p>

                         <div  v-for="(ikem, kom) in alerts.data" :key="kom" >                           
                             <timer-waktu v-if="ikem.spk_id == item.id && cekBox.estimasi" :estimasi="ikem.estimasi"></timer-waktu> 
                          </div>                                                                                                                                                    
            </td>

            <b-collapse :id="index+'cp'"  class="mt-2">
                <b-card> 
                   <b-button-group>
                      <b-button variant="outline-secondary" @click="edit(item.id)">
                        <b-icon icon="pencil-square" aria-hidden="true"></b-icon> 
                      </b-button>
                      <b-button  v-b-tooltip.hover.top="'Hubungi pemesan'" variant="outline-secondary" @click="hubungi(item.nama_pemesan, item.no_wa, item.data, item.id)">
                       <b-icon icon="person-fill" aria-hidden="true" variant="success"></b-icon> 
                      </b-button>                       
                        <handle-form v-bind:dataid="item.id" ></handle-form>
                  </b-button-group>
                  
                 
                   <b-button-group class="float-right">
                      <alert-form v-bind:id_item="item.id" v-b-tooltip.hover.top="'menandai tugas / memberikan estimasi'"></alert-form>
                  </b-button-group>


        <br> <br>
        <h5 class="text-center" v-if="item.text"><b>{{item.text}}</b></h5>
              <table class="border-0 table-sm  table-responsive">
                <thead class="border-0">
                  <tr class="border-0">
                     <th class="border-0">NM</th>
                    <th class="border-0">:</th>
                    <th class="border-0">{{item.nama_pemesan}}</th>  
                    <th class="border-0">|</th>                
                     <th class="border-0">No</th>
                    <th class="border-0">:</th>
                    <th class="border-0">{{item.no_nota}}</th>                   
                  </tr>
                  <tr class="border-0">                   
                     <th class="border-0">Tgl </th>
                    <th class="border-0">:</th>             
                    <td class="border-0">{{tgl_show(item.created_at)}}</td>   
                           <th class="border-0">|</th>                
                     <th class="border-0">Pkl</th>
                    <th class="border-0">:</th>
                    <td class="border-0">{{pkl_show(item.created_at)}}</td>                 
                  </tr>
                
                </thead>               
              </table>                     
              <table class="table table-bordered table-sm table-responsive " style="widht : 100%">
                <thead class="text-center thead-dark">
                  <tr>
                    <th  style="width:5%">No</th>
                    <th style="width:25%">NM BRG</th>
                    <th style="width: 20%">UK</th>
                    <th style="width:20%">BHN</th>
                    <th style="width: 5%">QTY</th>
                    <th style="width: 5%">FS</th>
                    <th style="width: 5%">LS</th>
                    <th style="width: 15%">KET</th>         
                  </tr>
                </thead>
                  <tbody>
                      <tr v-for="(row, andax) in item.data" :key="row.id" >                        
                           <td v-if="row.nama_brg" >    {{ andax + 1}}  </td>
                          <td v-if="row.nama_brg" class="text-left ellipsis"> <span>{{row.nama_brg}}</span>  </td>
                          <td v-if="row.nama_brg" class="text-center">   
                              <span v-if="row.ukuranP">   {{row.ukuranP}} <div v-if="row.ukuranL" >x</div> {{row.ukuranL}}</span>
                                          <span v-else>{{row.uk_alias}}</span>
                          </td>
                          <td v-if="row.nama_brg" class="text-center">{{row.bahan}}</td>
                              <td v-if="row.nama_brg" class="text-center">{{row.qty}} </td>
                              <td v-if="row.nama_brg" class="text-center"> <input class="largerCheckbox"  type="checkbox" v-model="row.fns"></td>
                            <td v-if="row.nama_brg" class="text-center"><input class="largerCheckbox"  type="checkbox" v-model="row.ls" ></td>
                      
                          <td v-if="row.nama_brg" class="text-left ellipsis"> <span> {{row.ket}}</span>  </td>

                      
                      </tr>
                  </tbody>
                  
                </table>  
              <table  class="table border-0 table-sm ">                 
                            <div v-for="(rows, andix) in item.data" :key="andix + 'tblbawah'" >
                            <tr style="text-align: left; vertical-align: top;"
                            v-if="rows.ket != null && rows.ket.length > 10">                                                
                              <div>Ket. No {{andix+1}} →  <strong class="text-uppercase">{{rows.ket}}</strong> </div>
                            </tr>                  
                            </div>                                                                          
              </table> 
                <div v-for="(rowsi, indax) in item.data" :key="'kets'+indax" class="d-inline">
                  <div class="d-inline" v-if="rowsi.nama_brg"> <span class="badge badge-dark">{{indax+1}}</span> {{rowsi.nama_brg}} |&ensp;</div>
                </div>
                                     

        <button class="btn btn-danger float-right mb-2 btn-sm" @click="hapus(item.id)" v-b-tooltip.hover.top="'File yang dihapus tidak akan pernah kembali'">           	
            <b-icon icon="trash-fill" aria-hidden="true"></b-icon> Hapus
        </button><br>
                        <span class="badge  mr-1 mt-1" v-for="(san, sun) in item.user" :key=" 'in' + sun"
                        v-b-tooltip.hover.html="ket(san.ket, san.waktu )" :style="{backgroundColor: randomColor(sun+1)}">
                            {{san.nama}}
                        </span>
<br>
                   <img v-if="item.foto" :src="item.foto" alt="Girl in a jacket" width="230"> 
                    
                </b-card>
            </b-collapse>
        </div> <!-- tutuploop -->
         </draggable> 
      </b-collapse>    

        <template #footer>
                       
            <div class="float-left">
                <p><i class="fa fa-bars"></i> {{ currentPage }} item dari {{ cp.length }} total data</p>
            </div>
        </template>                             
    </b-card> <!-- cp -->
    
    <b-card header-tag="header" footer-tag="footer"  v-if="cekBox.cs">
     <template #header>
        <h6 class="float-left mt-2 "> <b>CETAKAN SELESAI</b> <span class="badge badge-warning"> {{cs.length }}</span> </h6> 
          <b-button  aria-controls="collapse-1"   variant="primary" class="float-right" @click="csd_array">Pindah Ke CSD</b-button>       

      </template>
      <b-collapse id="collapse-1"  v-model="visible" >
       <draggable v-model="item_cs"  group="items" v-bind="dragOptions">
        <div v-for="(item, index) in cs" :key="index + 'cs'" >
            <td class="list-group-item list-group-item-action  text-left m-0 table-hover"  
              v-b-toggle="index+'cs'">          
                <span class="badge badge-secondary">{{index+1}}</span>
                <span><b>{{item.nama_pemesan}} </b>  </span>
                <span><b-icon icon="bookmark-fill" aria-hidden="true" :style="{'color' : item.warna}" ></b-icon></span> 
                    <span v-if="item.label.nama" v-b-tooltip.hover.html="label_user(item.user)" :style="{'background-color' : item.label.warna, 'font-size' : '10px'}" class="badge  text-uppercase float-right "> {{item.label.nama}}</span>   
                
              <span v-if="item.no_nota != 0"  class="badge badge-warning  float-right"> Nota {{item.kategori}} {{item.no_nota}}</span>    
                          <p v-if="cekBox.waktu" >{{tgl_show(item.created_at)}} - {{pkl_show(item.created_at)}}  ( {{dibuat(item.created_at)}} )</p>

                         <div  v-for="(ikem, kom) in alerts.data" :key="kom" >                           
                             <timer-waktu v-if="ikem.spk_id == item.id && cekBox.estimasi" :estimasi="ikem.estimasi"></timer-waktu> 
                          </div>                                                                                                                                                    
            </td>

            <b-collapse :id="index+'cs'"  class="mt-2">
                <b-card> 
                   <b-button-group>
                      <b-button variant="outline-secondary" @click="edit(item.id)">
                        <b-icon icon="pencil-square" aria-hidden="true"></b-icon> 
                      </b-button>
                      <b-button  v-b-tooltip.hover.top="'Hubungi pemesan'" variant="outline-secondary" @click="hubungi(item.nama_pemesan, item.no_wa, item.data, item.id)">
                       <b-icon icon="person-fill" aria-hidden="true" variant="success"></b-icon> 
                      </b-button>                       
                        <handle-form v-bind:dataid="item.id" ></handle-form>
                  </b-button-group>
                  
                 
                   <b-button-group class="float-right">
                     
                      <b-button  v-b-tooltip.hover.top="'set csd'" variant="outline-secondary" @click="csd_set(item.id)">
                       <b-icon icon="folder-x" aria-hidden="true" variant="success"></b-icon> 
                      </b-button>  
                      <alert-form v-bind:id_item="item.id" v-b-tooltip.hover.top="'menandai tugas / memberikan estimasi'"></alert-form>
                  </b-button-group>


        <br> <br>
        <h5 class="text-center" v-if="item.text"><b>{{item.text}}</b></h5>
              <table class="border-0 table-sm  table-responsive">
                <thead class="border-0">
                  <tr class="border-0">
                     <th class="border-0">NM</th>
                    <th class="border-0">:</th>
                    <th class="border-0">{{item.nama_pemesan}}</th>  
                    <th class="border-0">|</th>                
                     <th class="border-0">No</th>
                    <th class="border-0">:</th>
                    <th class="border-0">{{item.no_nota}}</th>                   
                  </tr>
                  <tr class="border-0">                   
                     <th class="border-0">Tgl </th>
                    <th class="border-0">:</th>             
                    <td class="border-0">{{tgl_show(item.created_at)}}</td>   
                           <th class="border-0">|</th>                
                     <th class="border-0">Pkl</th>
                    <th class="border-0">:</th>
                    <td class="border-0">{{pkl_show(item.created_at)}}</td>                 
                  </tr>
                
                </thead>               
              </table>                     
              <table class="table table-bordered table-sm table-responsive " style="widht : 100%">
                <thead class="text-center thead-dark">
                  <tr>
                    <th  style="width:5%">No</th>
                    <th style="width:25%">NM BRG</th>
                    <th style="width: 20%">UK</th>
                    <th style="width:20%">BHN</th>
                    <th style="width: 5%">QTY</th>
                    <th style="width: 5%">FS</th>
                    <th style="width: 5%">LS</th>
                    <th style="width: 15%">KET</th>         
                  </tr>
                </thead>
                  <tbody>
                      <tr v-for="(row, andax) in item.data" :key="row.id" >                        
                           <td v-if="row.nama_brg" >    {{ andax + 1}}  </td>
                          <td v-if="row.nama_brg" class="text-left ellipsis"> <span>{{row.nama_brg}}</span>  </td>
                          <td v-if="row.nama_brg" class="text-center">   
                             <span v-if="row.ukuranP">   {{row.ukuranP}} <div v-if="row.ukuranL" >x</div> {{row.ukuranL}}</span>
                                          <span v-else>{{row.uk_alias}}</span>
                          </td>
                          <td v-if="row.nama_brg" class="text-center">{{row.bahan}}</td>
                              <td v-if="row.nama_brg" class="text-center">{{row.qty}} </td>
                              <td v-if="row.nama_brg" class="text-center"> <input class="largerCheckbox"  type="checkbox" v-model="row.fns"></td>
                            <td v-if="row.nama_brg" class="text-center"><input class="largerCheckbox"  type="checkbox" v-model="row.ls" ></td>
                      
                          <td v-if="row.nama_brg" class="text-left ellipsis"> <span> {{row.ket}}</span>  </td>

                      
                      </tr>
                  </tbody>
                  
                </table>  
              <table  class="table border-0 table-sm ">                 
                            <div v-for="(rows, andix) in item.data" :key="andix + 'tblbawah'" >
                            <tr style="text-align: left; vertical-align: top;"
                            v-if="rows.ket != null && rows.ket.length > 10">                                                
                              <div>Ket. No {{andix+1}} →  <strong class="text-uppercase">{{rows.ket}}</strong> </div>
                            </tr>                  
                            </div>                                                                          
              </table> 
                <div v-for="(rowsi, indax) in item.data" :key="'kets'+indax" class="d-inline">
                  <div class="d-inline" v-if="rowsi.nama_brg"> <span class="badge badge-dark">{{indax+1}}</span> {{rowsi.nama_brg}} |&ensp;</div>
                </div>
                                     

        <button class="btn btn-danger float-right mb-2 btn-sm" @click="hapus(item.id)" v-b-tooltip.hover.top="'File yang dihapus tidak akan pernah kembali'">           	
            <b-icon icon="trash-fill" aria-hidden="true"></b-icon> Hapus
        </button><br>
                        <span class="badge  mr-1 mt-1" v-for="(san, sun) in item.user" :key=" 'in' + sun"
                        v-b-tooltip.hover.html="ket(san.ket, san.waktu )" :style="{backgroundColor: randomColor(sun+1)}">
                            {{san.nama}}
                        </span>
<br>
                   <img v-if="item.foto" :src="item.foto" alt="Girl in a jacket" width="230"> 
                    
                </b-card>
            </b-collapse>
        </div> <!-- tutuploop -->
         </draggable> 
      </b-collapse>    

        <template #footer>
                       
            <div class="float-left">
                <p><i class="fa fa-bars"></i> {{ currentPage }} item dari {{ cs.length }} total data</p>
            </div>
        </template>                             
    </b-card> <!-- cs -->
  </b-card-group>

 <b-button class="float-right btn btn-success" @click="log">
                            <b-icon icon="inbox-fill"></b-icon> Simpan
                          </b-button>
<b-icon v-if="refresh_aktif" class="float-right" icon="arrow-clockwise" animation="spin-pulse" font-scale="3"></b-icon>

    </div>
</template>
<script>

import moment from "moment"
moment.locale('id'); 
import timerWaktu from '../../components/timer.vue'

import alertInfo from './alert.vue';
import alertForm from './alertForm.vue';
import handleForm from './handleForm.vue';
  import draggable from 'vuedraggable'

import { mapActions, mapState } from 'vuex'
export default {
    created() {   
     
          //  this.muat();
          //  this.get_alert();
             
    },
    data() {
        return {                        
            searching : '',
            search : '', //utk no nota
            visible : true,   
            drag : true, //utk dragable   
            refresh_aktif : false,
            colorCache  : {}, //tuk keperluan warna random
        }
    },
    watch: {
       searching (){
         this.searching_spk(this.searching);
       },
       search (){
             this.searching_nota(this.search);
       }
    },
    computed : {
        ...mapState('alert_stores', {
            alerts : state=> state.alerts,                     
        }), 
        ...mapState('agenda_stores', {
            cekBox_agenda : state=> state.cekBox,                     
        }), 
        ...mapState('spk_stores', {
            spks : state=> state.spks,
               spk : state=> state.spk,
            cekBox : state => state.cekBox,
                query : state=> state.query,
                cm : state=> state.cm,
                  cp : state=> state.cp,  
                cs : state=> state.cs,
                  csd : state=> state.csd,                                 
        }),   
        ...mapState('karyawan_stores', {       
            karyawan : state=> state.karyawan,
        }),
            perPage : {                     
                      get() {   
                                           
                          return this.$store.state.spk_stores.perPage
                      },
                      set(value) {    
                                            
                          this.$store.commit('spk_stores/SET_PERPAGE', value)
                      }
            },  
            currentPage : {
                      get() {
                          return this.$store.state.spk_stores.currentPage
                      },
                      set(value) {
                          this.$store.commit('spk_stores/SET_CURRENTPAGE', value)
                      }
            },  
            item_cm : {
                      get() {
                          return this.$store.state.spk_stores.cm
                      },
                      set(value) {
                          this.$store.commit('spk_stores/assign_cm', value)
                      }
            },    
            item_cp : {
                      get() {
                          return this.$store.state.spk_stores.cp
                      },
                      set(value) {
                          this.$store.commit('spk_stores/assign_cp', value)
                      }
            },    
            item_cs : {
                      get() {
                          return this.$store.state.spk_stores.cs
                      },
                      set(value) {
                          this.$store.commit('spk_stores/assign_cs', value)
                      }
            }, 
            item_csd : {
                      get() {
                          return this.$store.state.spk_stores.csd
                      },
                      set(value) {
                          this.$store.commit('spk_stores/assign_csd', value)
                      }
            },         
          dragOptions() { //fungsi nya pabila cekbox di klik maka drag tidk jalan
            return {
              animation: 0,
              group: "description",
              disabled: !this.drag,
              ghostClass: "ghost"
          };
        }, 
    },
    methods : {
      ...mapActions('alert_stores', ['edit_alert', 'get_alert']),
        ...mapActions('spk_stores', [ 'jadikan_csd', 'get_spk', 'spk_csd', 'edit_spk', 'update_spk', 'remove_spk', 'gabung_spk', 'searching_spk', 'searching_nota', 'filter_spk', 'handle_spk']),        
        hubungi (kost, wa, data, param) {
           
            let barang = '';
            var i =0;
           for( i;  i < data.length; i++){
                if (data[i].nama_brg) {
                  barang += data[i].nama_brg + ', ' + ' ';
                }
                
            }
              
               let teks = `Kepada Admin ${kost}, cetakan ${barang}. `

            
          var pemain = this.karyawan.nama;
          if(pemain) {              
            var id_n_pemain = {
              id : param,
              nama : pemain,
              ket : 'Mengubungi kostumer',
              waktu : moment().format('YYYY-MM-DD HH:mm:ss')
            };
             this.handle_spk(id_n_pemain); 
             
            if (wa) {
              window.location.href =  `https://wa.me/${wa}?text=${teks}`;
            }else {alert('tidak ada no wa')}   

          } else {alert('anda belum terdefinisi')} 



             
        },   
        csd_array(){
          this.jadikan_csd();
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
        tgl_show (data){
            var tgl = data? data : '';
            if(tgl) {
              return moment(tgl).format('ddd, DD-MMM');   
            }else{ return "-"}                           
        },    
        pkl_show (data){          
            var tgl = data? data : '';
            if(tgl) {
              return moment(tgl).format('h:mm a')   
            }else{ return "-"}        
        },  
        estimasi (data){          
            var tgl = data? data : '';
            if(tgl) {
              return moment(tgl).fromNow();    
            }else{ return ""}        
        }, 
        handle(param){ // kleim tugas pada spk
              var pemain = this.karyawan.nama;
          if(pemain) {   
            
                                                 
              let person = prompt("Keterangan :", "Mengambil alih Spk ini");
              if (person == null || person == "") {
               
              } else {                
                var id_n_pemain = {
                  id : param,
                  nama : pemain,
                  ket : person,
                  waktu : moment().format('YYYY-MM-DD HH:mm:ss')
                };
                this.handle_spk(id_n_pemain); 
              } 

          } else {alert('anda belum terdefinisi')}           
        },
        ket(ket, waktu) { //keterangan pada handling
          return `${ket} pkl : ${this.pkl_show(waktu)}`;
        },
        label_user(param) { //keterangan pada handling
          let data = param.at(-1);
          return ` <p> ${data.nama}</p> ${data.ket} pkl : ${this.pkl_show(data.waktu)} `;
        },
        hapus(param){                                        
              let person = prompt("Yakin anda menghapus file ini ? :", "ya");
              if (person == null || person == "") {
               
              } else {
                 this.remove_spk(param);
                 this.query_kategori();
                  this.get_alert(); 

              }
             
        },  
        csd_set(param){                                        
              let person = prompt("Status cetakan ini menjadi cetakan sudah diambil ? :", "ya");
              if (person == null || person == "") {
               
              } else {
                
              var pemain = this.karyawan.nama;
          if(pemain) {              
            var id_n_pemain = {
              id : param,
              nama : pemain,
              ket : 'Memberikan cetakan ke kostumer',
              waktu : moment().format('YYYY-MM-DD HH:mm:ss')
            };
             this.handle_spk(id_n_pemain);   
                this.spk_csd(param);
                 this.query_kategori();                  
          } else {alert('anda belum terdefinisi')} 
         
                 
              } //else pertama
             
        },
        edit(param){
             this.$router.push({
                  name : 'spk.edit',
                  params : {id : param}
              })
        }, 
          log: function() {                
                let post_cm = {};
                post_cm.cm = this.cm.map( (todo1, index )=> {
                    return {
                        id : todo1.id,
                        posisi: index,
                        nama_pemesan: todo1.nama_pemesan,
                        status : 'cm'
                    }
                });                                           

                let post_cp = {};
                post_cp.cp = this.cp.map( (todo2, index) => {
                    return {
                        id : todo2.id,
                        posisi: index,
                        nama_pemesan: todo2.nama_pemesan,
                        status : 'cp'
                    }
                });   
                 let post_cs = {};
                post_cs.cs = this.cs.map( (todo2, index) => {
                    return {
                        id : todo2.id,
                        posisi: index,
                        nama_pemesan: todo2.nama_pemesan,
                        status : 'cs'
                    }
                });  
                
                // let post_csd = {};
                // post_csd.csd = this.csd.map( (todo2, index) => {
                //     return {
                //         id : todo2.id,
                //         posisi: index,
                //         nama_pemesan: todo2.nama_pemesan,
                //         status : 'csd'
                //     }
                // });    
                  let list1 = post_cm.cm;
                  let list2 = post_cp.cp;
                  let list3 = post_cs.cs;
                  // let list4 = post_csd.csd;
                  let gabungan = list1.concat(list2, list3);
          
                  //pengabungan semua
                  let gabung = {};
                  gabung = gabungan.map( (tes, index) => {
                    return {
                        id : tes.id,
                        posisi: index,
                        nama_pemesan: tes.nama_pemesan,
                        status : tes.status
                    }
                  })                                                  
                   
                    
              this.refresh_aktif = true;
              setTimeout(function () {                      
                    this.gabung_spk(gabung)
                        this.refresh_aktif = false;
                        }.bind(this), 2000)
                                                
            },   
            query_kategori(event)  {
              this.muat();

            },
            muat(){
                this.get_spk();
            },
            onChangeSite(ev){
              //mereaksi pagination perpage          
              this.filter_spk();
            },   
            segarkan(){
              this.refresh_aktif = true;
              setTimeout(function () {                      
                         this.get_spk();
                        this.get_alert();
                        this.refresh_aktif = false;
                        }.bind(this), 2000)
         
        },
         randomColor(id) {
            const r = () => Math.floor(256 * Math.random());
            return this.colorCache[id] || (this.colorCache[id] = `rgb(${r()}, ${r()}, ${r()})`);
          }

    },
        components: {
        alertForm, handleForm, draggable,  alertInfo, timerWaktu
        },

   
}
</script>

<style >

.ellipsis {
    position: relative;
}
.ellipsis:before {
    content: '&nbsp;';
    visibility: hidden;
}
.ellipsis span {
    position: absolute;
    left: 0;
    right: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

p img {
  width: 100%;
}
</style>
