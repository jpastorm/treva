var app = new Vue({
    el: '#app',
    data:{
        id_formulario:0,
        preguntas:[],
        puntajemax:0
    },
    methods:{
        listar:function(){
            this.id_formulario=document.getElementById("id_formulario").value;
            console.log(this.id_formulario);
            axios.get('api/v1/pregunta.php?id_formulario='+this.id_formulario).then(resp => {
                console.log(resp.data);
                this.preguntas=resp.data
            });
            this.getForm();
        },
        getForm:function()
        {            
            console.log(this.id_formulario);
            axios.get('api/v1/formulario.php?id_formulario='+this.id_formulario).then(resp => {
                console.log(resp.data);
                this.puntajemax=resp.data.puntajemax;
                console.log(this.puntajemax);
            });
        }   
    },
    created:function(){
        this.listar()
    }
});

