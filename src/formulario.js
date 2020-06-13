	var app = new Vue({
		el: '#app',
		data:{
			formularios:[]
		},
		methods:{
			listar:function(){
				var id_usuario=document.getElementById("id_usuario").value;
				console.log(id_usuario);
				axios.get('api/v1/formulario.php?id_usuario='+id_usuario).then(resp => {
					console.log(resp.data);
					this.formularios=resp.data
				});
			}
		},
			created:function(){
				this.listar()
			}
	});
	
