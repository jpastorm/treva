	var app = new Vue({
		el: '#app',
		data:{
			usuarios:[],
			id_usuario=0,
			usuario="",
			password=""
		},
		methods:{
			listar:function(){
				axios.get('http://treva.clan.pe/api/v1/usuario.php').then(resp => {
					console.log(resp.data);
					this.usuarios=resp.data
				});
			},
			ingresar:function(){
				location.href ="home.php";
			},
			autenticar:function(){
				for(i=0;i<this.usuarios.length();i++){
					if (this.usuarios.usuario==this.usuario&&this.usuarios.contrasenia==this.password) {
						this.id_usuario=this.usuarios.id_usuario
						params = {
							opcion=2,						
							usuario:this.usuario,
							id_usuario:this.id_usuario					
						}
						console.log(this.usuario)
						console.log(this.id_usuario)
						axios.get('http://treva.clan.pe/api/v1/usuario.php',params).then(resp => {
							console.log(resp.data);
							if(resp.data.estado){
								this.ingresar()
							}else{
								console.log(resp.data.mensaje)
							}
							this.listar()
						});
					}	
				}

			},
			created:function(){
				this.listar()
			}
		});
	
