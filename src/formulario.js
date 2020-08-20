	var app = new Vue({
		el: '#app',
		data:{
			formularios:[],
			titulo:"",
			descripcion:"",
			link:"",
			nombreUsuario:"",
			id_usuario:"",
			puntajeMax:""
		},
		methods:{
			verificar:function(){
				params = {
					id_usuario:this.id_usuario,						
					titulo:this.titulo,
					descripcion:this.descripcion,
					puntajemax:this.puntajeMax				
				}
				axios.post('api/v1/formulario.php',params).then(resp => {
					console.log(resp.data);
					if(resp.data.estado=="true"){
						var newlink="treva.clan.pe/votacion.php?link="+resp.data.link;
						
						Swal.fire({
							title: "<p>Tu formulario fue creado</p>", 
							html: '<a href="'+newlink+'">'+newlink+'</a>',
							confirmButtonText: "Aceptar", 
						  });
						  this.listar();
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Something went wrong!',
							footer: '<a href>Why do I have this issue?</a>'
						  })
					}					

				});
			},

			verlink:function(nombre,link){
				let linkcompleto = "treva.clan.pe/votacion.php" + link;
				let redirect="votacion.php?link="+link;
				Swal.fire({
					title: "Link de "+nombre,
					html: 
						'<input id="text_to_be_copied" class="swal2-input" value="'+linkcompleto+'" readonly></input>' +
						'<b id="confirm" class="text-primary" hidden>Copiado en el portapapeles!</b>' +
							'<br><button type="button" class="btn btn-success" id="btn-copy" style="margin-left:5px">Copiar</button>' +
							'<a href="'+redirect+'" target="_blank" class="btn btn-warning" style="margin-left:5px">Ir a mi formulario</a>' +
						'</div>',
					showConfirmButton: false,
					type: "success",
					onOpen: () => {
						$("#btn-copy").click(() => {
							$("#btn-ok").prop('disabled', false);
				
							$("#text_to_be_copied").select();
							$('#confirm').removeAttr('hidden')
							document.execCommand("copy");
						});
				
						$("#btn-ok").click(() => {
							Swal.close();   
						});
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
				axios.get('api/v1/formulario.php?id_usuario='+id_usuario).then(resp => {
					console.log(resp.data);
					this.formularios=resp.data
				});
			},
			nuevoFormulario:function(){
				Swal.mixin({
					input:"text",
					confirmButtonText: 'Next &rarr;',
					showCancelButton: true,
					progressSteps: ['1', '2','3']
				}).queue([
				{
					title: 'Titulo',
					text: 'Informacion Adicional'
				},
				{
					title: 'Descripcion',
					text: 'Informacion adicional'
				},
				{
					title: 'Puntaje maximo',
					text: 'Si coloca letras explotaremos'
				}
				]).then((result) => {
					if (result.value) {
						

						//this.listar();
						console.log(result.value);
						const respuestas=result.value;
						for (let i = 0; i < respuestas.length; i++) {						
							console.log(respuestas[i])

						}
						console.log("ESA ES");
						this.titulo=respuestas[0];
						this.descripcion=respuestas[1];
						this.puntajeMax=respuestas[2];
						console.log(this.titulo);
						console.log(this.descripcion);
						console.log(this.puntajeMax);
						this.verificar();
					}
				})
			},
			AgregarFormulario:function(link){
				console.log(link);
			}
		},
		created:function(){
			this.listar()
			this.obtenerUsusario()
			
		}
	});
	
	