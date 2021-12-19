<template>
<div>
	<a :href="'/'">Home</a>
	<div class="row">
  		<div class="col-sm-4">
			  <div class="card card-body mb-2">
				  <h3 class="card-title">{{location.name}}  </h3> {{location.weather.list[0].dt_txt|formatToDateTime}}
				  <span class="upper_right"><h2>{{(location.weather.list[0].main.temp-273.15).toFixed(2)}} &deg;C</h2></span>
				  <ul class="list-group border-0">
					<li class="list-group-item mb-1 border-0 p-0">
						<p class="m-0 p-0">Weather:	<img :src="'http://openweathermap.org/img/w/'+location.weather.list[0].weather[0].icon+'.png'">{{location.weather.list[0].weather[0].description}}</p>
					</li>
					<li class="list-group-item mb-1 border-0 p-0">
						<p class="m-0 p-0" >Temp: <font-awesome-icon icon="arrow-down" /> {{(location.weather.list[0].main.temp_min-273.15).toFixed(2)}} &nbsp;<font-awesome-icon icon="arrow-up" /> {{ (location.weather.list[0].main.temp_max-273.15).toFixed(2)}} &deg;C</p>
					</li>
				</ul>
			  </div>
		  </div>
		  <div class="col-sm-8">
			  <table class="table table-sm table-light table-bordered">
					<thead>
						<tr>
						<th scope="col">Forcast</th>
						<th scope="col" colspan="5"></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="weather_list_date in location.dates">
						<th>{{weather_list_date}}</th>
						<td>
							<table class="table table-sm table-light table-hover table-striped">
								<thead>
									<tr>
									<th scope="col">Time</th>
									<th scope="col">Weather</th>
									<th scope="col">Temp</th>
									</tr>
								</thead>
								<tbody>
									<tr  v-for="weather_list in location.weather.list" v-show="weather_list_date === weather_list.date">
									<th>{{weather_list.dt_txt|formatToTime}}</th>
									<td><img style="width:25px;height:25px;" :src="'http://openweathermap.org/img/w/'+weather_list.weather[0].icon+'.png'"> {{weather_list.weather[0].description}}</td>
									<td><font-awesome-icon icon="arrow-down" />{{(weather_list.main.temp_min-273.15).toFixed(2)}} <font-awesome-icon icon="arrow-up" />{{(weather_list.main.temp_max-273.15).toFixed(2)}} &deg;C</td>
									</tr>
								</tbody>
							</table>
					</td>
						</tr>

					</tbody>
				</table>
		  </div>
	</div>
</div>
</template>
<script>
export default {
	data(){
		return {
			location:{
				id:'',
				name:'',
				country_code:'',
				lon:'',
				lat:'',
				weather:[]
			}
		}
	},
	created(){
		this.location_id = this.$route.query.loc_id
		this.fetchLocationsWeatherDetails();
		// alert(this.$route.params)
	},
	methods:{
		fetchLocationsWeatherDetails(){
			let vm = this;
			let page_url = 'weather_details/'+this.location_id;	
			fetch(page_url)
			.then(res => res.json())
			.then(res => {
				this.location = res;

			})
			.catch(err=> console.log(err))
		}
	}
}
</script>