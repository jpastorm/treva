var app = new Vue({
    el: '#app',
    data:{
        link:"",
        id_formulario:"",
        preguntas:[],
        puntajeMax:5,
        opciones:[
            {value:1,text:"opcion1"},
            {value:2,text:"opcion2"},
            {value:3,text:"opcion3"},
            {value:4,text:"opcion4"},
            {value:5,text:"opcion5"}
        ],
        elecciones:[],
        seleccionado:"",
        result:[]
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
        },
        //RADIO+ID

        getSeleccion(){      
            let data=[]      
            for(let i = 0; i< this.preguntas.length;i++ ){                    
                
                let seleccion = $(`input[name=radio${this.preguntas[i].id_pregunta}]:checked`).val();
                    
                        data.push({id:this.preguntas[i].id_pregunta,value:seleccion})
                        console.log(data)
                    if(seleccion){
                        if(this.elecciones.length==0){
                            this.elecciones.push(data)
                            break
                        }
                    }  
                    console.log("Se va del for") 
                    }                    
                    console.log("result")
                    console.log(data)    
                }
                
                
    }, 
    created:function(){
        this.decryptlink();
    }});
    
    