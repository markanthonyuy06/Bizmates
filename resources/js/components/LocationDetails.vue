<template>
<div>
	<h1>Location Overview</h1>
	<p>Location Id: {{$route.params.id}}</p>
</div>
</template>
<script>
export default {
	watch:{
		'$route'(to,from){
			alert(to.params.id)
		}
	},
	created(){
		alert(this.$route.params.id)
	}
}
</script>