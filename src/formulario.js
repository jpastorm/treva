	var app = new Vue({
		el: '#app',
		data:{
			formularios:[]
		},
		methods:{
			listar:function(){
				axios.get('http://treva.clan.pe/api/v1/formulario.php').then(resp => {
					console.log(resp.data);
					this.formularios=resp.data
				});
			}
		},
			created:function(){
				this.listar()
			}
	});
	
