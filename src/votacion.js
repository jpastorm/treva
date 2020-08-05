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
        elecciones:[]
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
            for(let i = 0; i< this.preguntas.length;i++ ){                    
                let activoFijo = $(`input[name=radio${this.preguntas[i].id_pregunta}]:checked`).val();
                console.log(activoFijo)
                if(activoFijo){
                    let datos={
                        id:this.preguntas[i].id_pregunta,value:activoFijo    
                    }
                    if(this.elecciones.length==0){
                        this.elecciones.push(datos);
                        console.log(this.elecciones)
                    }else{
                        for(let j = 0 ; j < this.elecciones.length ; j++){                        
                            if(this.elecciones.id != this.preguntas[i].id_pregunta){
                                this.elecciones.push(datos);
                            console.log(this.elecciones)
                            }
                    }
                    
                        
                    }
                    
                }
                
                
                
            } 
            /* let activoFijo = $(`input[name=radio${this.preguntas[i].id_pregunta}]:checked`).val();
            console.log(activoFijo) */
        }
    }, 
    created:function(){
        this.decryptlink();
    }});
    
    