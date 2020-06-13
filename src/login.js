	var app = new Vue({
		el: '#app',
		data:{
			usuarios:[],
			id_usuario:0,
			usuario:"",
			password:""
		},
		methods:{
			listar:function(){
				axios.get('api/v1/usuario.php').then(resp => {
					console.log(resp.data);
					this.usuarios=resp.data
				});
			},
			ingresar:function(){

				location.href ="home.php";
			},
			autenticar:function(){
				console.log(this.usuario)
				console.log(this.password)
				console.log("------------")

				for(i=0;i<this.usuarios.length;i++){
					console.log(this.usuarios[i].usuario)
					console.log(this.usuarios[i].contrasenia)
					if (this.usuarios[i].usuario==this.usuario&&this.usuarios[i].contrasenia==this.password) {
						this.id_usuario=this.usuarios[i].id_usuario
						params = {
							opcion:2,						
							usuario:this.usuario,
							id_usuario:this.id_usuario					
						}
						console.log(this.usuario)
						console.log(this.id_usuario)
						axios.post('api/v1/usuario.php',params).then(resp => {
							console.log(resp.data[0]);
							if(resp.data[0].estado){
								this.ingresar()
							}else{
								console.log(resp.data[0].mensaje)
							}
							this.listar()
						});
						break;
					}	
				}
			}

		},
		created:function(){
			this.listar()
		}
	});
	
