	var app = new Vue({
		el: '#app',
		data:{
			
		},
		methods:{
				listar:function(){
					axios.get('http://treva.clan.pe/api/v1/usuario.php').then(resp => {
						console.log(resp.data);
						this.formularios=resp.data
					});
				},
				ingresar:function(){
					location.href ="home.php";
				}
			},
				created:function(){
					this.listar()
				}
		});
	
