var app = new Vue({
    el: '#app',
    data:{
        id_formulario:0,
        preguntas:[],
        puntajemax:0,
        nombreform:"",
        link:"",
        descripcion:"",
        id_pregunta:0
    },
    methods:{
        verificarPregunta:function() {
            params = {
                    descripcion:this.descripcion,
                    id_formulario:this.id_formulario
                }
                axios.post('api/v1/pregunta.php',params).then(resp => {
                    console.log(resp.data);
                    this.listar();
                });
        },
        listar:function(){
            this.id_formulario=document.getElementById("id_formulario").value;
            console.log(this.id_formulario);
            axios.get('api/v1/pregunta.php?id_formulario='+this.id_formulario).then(resp => {
                console.log(resp.data);
                this.preguntas=resp.data
            });
            
        },
        eliminar:function(id_pregunta){
            this.id_pregunta=id_pregunta
            this.id_formulario=document.getElementById("id_formulario").value;
            console.log(this.id_formulario);
            axios.delete('api/v1/pregunta.php?id_pregunta='+this.id_pregunta).then(resp => {
                console.log(resp.data);
                this.preguntas=resp.data
                this.listar()
            });        
            
        },
        getForm:function()
        {            
            this.id_formulario= document.getElementById("id_formulario").value
            console.log(this.id_formulario);
            axios.get('api/v1/formulario.php?id_formulario='+this.id_formulario).then(resp => {
                console.log(resp.data);
                this.puntajemax=resp.data.puntajemax;
                console.log(this.puntajemax);
                this.nombreform=resp.data.titulo;
                this.link=resp.data.link;
                console.log(this.link)
            });
        },
          addpregunta:function(){      
          this.id_formulario= document.getElementById("id_formulario").value      
         Swal.mixin({
            input:"text",
            confirmButtonText: 'Next &rarr;',
            showCancelButton: true,
            progressSteps: ['1']
        }).queue([
        {
            title: 'Pregunta',
            text: 'Escriba la pregunta'
        }
        ]).then((result) => {
            if (result.value) {

                console.log(result.value);
                const respuestas=result.value;
                for (let i = 0; i < respuestas.length; i++) {                       
                    console.log(respuestas[i])

                }
                this.descripcion=respuestas[0];           
                console.log(this.descripcion+"  "+this.id_formulario);            
            }
            if (this.descripcion != "") {
                this.verificarPregunta()
            }
        })
    }   
    },
    created:function(){
        this.listar()
        this.getForm()
    },
});

