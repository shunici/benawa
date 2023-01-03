<template>
	<div :estimasi="estimasi" v-if="estimasi"  class="badge badge-warning" :class=" hours<=1 && days < 1 ? 'blinkdiv' : '' " style="font-size : 18px" v-b-tooltip.hover.v-danger="waktu(estimasi)">	
		<b-icon icon="alarm"></b-icon> 	 
	
		<span v-if="days">  {{days}} Hr | </span>
		<span v-if="hours"> {{hours}} Jm | </span>
		<span v-if="minutes"> {{minutes}} Mnt</span>	
		<span v-if="hours == 0 && days == 0" >
			<span v-if="minutes == 0"> Estimasi sudah berlalu</span>
		</span>		
	
	</div> 
</template>

<script>
import { mapState, mapMutations, mapActions } from 'vuex'
	import moment from 'moment'
	export default {
		name : 'timer-waktu',
		props : ['estimasi'],
		data () {
			return {
				actualTime: moment().format('X'),
				years: 0,
				months: 0,
				days: 0,
				hours: 0,
				minutes: 0,
				seconds: 0
			}
		},

		methods: {
		  addOneSecondToActualTimeEverySecond () {
		      var component = this
		      component.actualTime = moment().format('X')
		      setTimeout(function(){
		          component.addOneSecondToActualTimeEverySecond()
		      }, 600000);
		  },
		  getDiffInSeconds () {			  				
		    return moment(this.estimasi).format('X') - this.actualTime
		  },
		  compute () {
		    var duration = moment.duration(this.getDiffInSeconds(), "seconds")
		    this.years = duration.years() > 0 ? duration.years() : 0
		    this.months = duration.months() > 0 ? duration.months() : 0
		    this.days = duration.days() > 0 ? duration.days() : 0
		    this.hours = duration.hours() > 0 ? duration.hours() : 0
		    this.minutes = duration.minutes() > 0 ? duration.minutes() : 0
		    this.seconds = duration.seconds() > 0 ? duration.seconds() : 0
		  },
              tgl_show(data){
                 var tgl = data? data : '';
                 if(tgl) {
                  return moment(tgl).format('dddd, DD-MMM-YYYY')
                 }else { return ""}
               
              },  
              pkl_show(data){
                 var pkl = data? data : '';
                 if(pkl) {
                  return moment(pkl).format('h:mm a');
                 }else { return ""}
               
              }, 
			  waktu (param) {
				let a =   this.tgl_show(param);
				 let b =    this.pkl_show(param);
				 return `Estimasi ${a} - ${b}`
			  }
		},
		created () {
		  this.compute()
		  this.addOneSecondToActualTimeEverySecond()
		},
		watch: {
		    actualTime (val,oldVal) {
		        this.compute()
		    }
		}
	}
</script>


<style>
  @-webkit-keyframes blackWhite {  
  0% { background-color: red; color : white}
  50% { background-color: red;  color : white}
  51% { background-color: yellow; }
  100% { background-color: yellow; }
}

@-webkit-keyframes blackWhiteFade {  
  0% { background-color: red; color : white }
  50% { background-color: yellow; }
  100% { background-color: red; color : white }
}

.blinkdiv {   
    background-color: yellow;
  -webkit-animation-name: blackWhite;
  /* -webkit-animation-name: blackWhiteFade; */
  -webkit-animation-iteration-count: infinite;  
  -webkit-animation-duration: 1s; 
}   
</style>