<template>
<div>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li v-bind:class=[{disabled:!pagination.prev_page_url}] class="page-item"><a class="page-link" href="#" @click="fetchLocationsWeatherList(pagination.prev_page_url)">Previous</a></li>

    <li class="page-item disabled"><a class="page-link text-dark">Page {{pagination.current_page}} of {{pagination.last_page}}</a></li>
    <li v-bind:class=[{disabled:!pagination.next_page_url}] class="page-item"><a class="page-link" href="#" @click="fetchLocationsWeatherList(pagination.next_page_url)">Next</a></li>
  </ul>
</nav>
	<div class="row">
  		<div class="col-sm-4" v-for="location in locations" v-bind:key="location.id">
  				<div class="card card-body mb-2">
				<a :href="'locations/'+location.id"><h3>{{location.name}} </h3></a> {{location.weather.list[0].dt|formatUnixToDate}}
				<div class="upper_right">
					{{location.weather.list[0].weather[0].description}}<img :src="'http://openweathermap.org/img/w/'+location.weather.list[0].weather[0].icon+'.png'">
					
				</div>
				<ul class="list-group" v-for="weather_list in location.weather.list" v-bind:key="weather_list.cod">
						<li class="list-group-item mb-2">{{weather_list.dt|formatUnixToDate}} </br>
						Weather:  <img style="max-width:100%" :src="'http://openweathermap.org/img/w/'+weather_list.weather[0].icon+'.png'"> {{weather_list.weather[0].description}} <br/>
						Temp: {{(weather_list.main.temp_min-273.15).toFixed(2)+" ~ "+(weather_list.main.temp_max-273.15).toFixed(2)}} &deg;C
						</li>
				</ul>
				</div>
  		</div>
  	</div>

</div>
</template>
<script>
export default {
	data(){
		return {
			locations:{},
			location:{
				id:'',
				name:'',
				country_code:'',
				lon:'',
				lat:'',
				weather:[]
			},
			location_id:'',
			pagination:{},
		}
	},
	created(){
		this.fetchLocationsWeatherList();
			},
	methods:{
		fetchLocationsWeatherList(page_url){
			let vm = this;
			page_url = page_url || 'api/locations/weather_list';
			
			fetch(page_url)
			.then(res => res.json())
			.then(res => {
				this.locations = res.data;

				// console.log(res)
				vm.makePagination(res);
				// console.log(res.Meta);
			})
			.catch(err=> console.log(err))
		},
		makePagination(page_data){
			let pagination = {
				current_page:page_data.current_page, 
				last_page:page_data.last_page, 
				next_page_url:page_data.next_page_url, 
				prev_page_url:page_data.prev_page_url, 
			}

			this.pagination = pagination;
		},

	}
}
</script>
<style>
 .upper_right {
        position: absolute;
        top: 0px;
        right: 0px;
    }
</style>