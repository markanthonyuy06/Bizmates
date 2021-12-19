<template>
<div>
    <ul class="list-group" v-for="location in locations" v-bind:key="location.id">
        <li class="list-group-item">{{location.name}} <a :href="'locations/'+location.id"> View </a></li>
    </ul>
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

</style>