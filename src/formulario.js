	var app = new Vue({
		el: '#app',
		data:{
			formularios:[],
			titulo:"",
			descripcion:"",
			link:"",
			nombreUsuario:"",
			id_usuario:""
		},
		methods:{
			verificar:function(){
				axios.get('api/v1/formulario.php?titulo='+this.titulo).then(resp => {
					console.log(resp.data);
					if (resp.data[0].estado) {
						this.AgregarFormulario()
					}
				});
			},
			obtenerUsusario:function(){
				var id_usuario=document.getElementById("id_usuario").value;
				console.log(id_usuario);
				axios.get('api/v1/usuario.php?id_usuario='+id_usuario).then(resp => {
					console.log(resp.data);
					this.nombreUsuario=resp.data.usuario
					this.id_usuario=resp.data.id_usuario
					console.log(this.nombreUsuario)
				});
			},
			listar:function(){
				var id_usuario=document.getElementById("id_usuario").value;
				console.log(id_usuario);
				axios.get('api/v1/formulario.php?id_usuario='+this.id_usuario).then(resp => {
					console.log(resp.data);
					this.formularios=resp.data
				});
			},
			nuevoFormulario:function(){
				Swal.mixin({
					input:"text",
					confirmButtonText: 'Next &rarr;',
					showCancelButton: true,
					progressSteps: ['1', '2']
				}).queue([
				{
					title: 'Titulo',
					text: 'Informacion Adicional'
				},
				{
					title: 'Descripcion',
					text: 'Informacion adicional'
				}
				]).then((result) => {
					if (result.value) {
						const answers = JSON.stringify(result.value)
						Swal.fire({
							title: 'All done!',
							html: `
							Your answers:
							<pre><code>${answers}</code></pre>
							`,
							confirmButtonText: 'ACEPTAR TODO!'
						})
						//this.listar();
						console.log(result.value);
						const respuestas=result.value;
						for (let i = 0; i < respuestas.length; i++) {						
							console.log(respuestas[i])

						}
						console.log("ESA ES");
						this.titulo=respuestas[0];
						this.descripcion=respuestas[1];
						console.log(this.titulo);
						console.log(this.descripcion);
					}
				})
			},
			AgregarFormulario:function(){

			}
		},
		created:function(){
			this.listar()
			this.obtenerUsusario()
			
		}
	});
	
	