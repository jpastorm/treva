var app = new Vue({
    el: '#app',
    data:{
       link:"",
       id_formulario:"",
       preguntas:[],
       puntajeMax:5
    },
    methods:{
        decryptlink:function(){
            this.link=document.getElementById("link").value;
            console.log(this.link);
            axios.get('api/v1/formulario.php?link='+this.link).then(resp => {
                console.log(resp.data);
                const {id_form,id_usu} = resp.data
                this.id_formulario=id_form
                console.log(this.id_formulario)
                this.listarPreguntas(this.id_formulario)
            });
        },
        listarPreguntas(idForm){
            console.log(idForm)
            axios.get('api/v1/pregunta.php?id_formulario='+idForm).then(resp => {
                console.log(resp.data);
                this.preguntas=resp.data                
            });
            }
        }, 
    created:function(){
       this.decryptlink();
    }});

