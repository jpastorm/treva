var app = new Vue({
    el: '#app',
    data:{
        link:"",
        id_formulario:"",
        id_usuario:"",
        preguntasvalue:"'question_",
        comillasimple:"'",
        preguntas:[],
        tituloform:"",
        cantidadpreguntas:"",
        descform:"",
        autorform:"",
        datosUsu:[],
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
        result:[],
        isvoted:false,
        titulo:""
    },
    methods:{
        decryptlink:function(){
            this.link=document.getElementById("link").value;
            console.log(this.link);
            axios.get('api/v1/formulario.php?link='+this.link).then(resp => {
                console.log(resp.data);
                const {id_form,id_usu} = resp.data
                this.id_formulario=id_form
                this.id_usuario=id_usu
                console.log(this.id_formulario)
                this.listarPreguntas(this.id_formulario)
                this.listarDatosUsu(this.id_usuario)
            });
        },
        listarDatosUsu(idUsu){
            console.log(idUsu)
            axios.get('api/v1/usuario.php?id_usuario='+idUsu).then(resp => {
                console.log(resp.data);
                this.autorform=resp.data.nombre + " "+ resp.data.apellido_pat                
            });
        },
        listarPreguntas(idForm){
            console.log(idForm)
            axios.get('api/v1/pregunta.php?id_formulario='+idForm).then(resp => {
                console.log(resp.data);
                this.preguntas=resp.data;
                this.cantidadpreguntas=resp.data.length                
            });
            axios.get('api/v1/formulario.php?id_formulario='+idForm).then(resp => {
                console.log(resp.data);
                this.tituloform=resp.data.titulo;
                this.descform=resp.data.descripcion          
            });
        },

 
  
   
        //RADIO+ID

        getSeleccion(){      
            let data=[]      
            for(let i = 0; i< this.preguntas.length;i++ ){                    
                
                let seleccion = $(`input[name=radio${this.preguntas[i].id_pregunta}]`).val();
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
                    this.result=data;    
        },
        checkform(e){
            e.preventDefault()    
            let params = {
                data: this.result
            }                   
            axios.post('api/v1/detallepregunta.php',params).then(resp => {
                console.log(resp.data);   
                this.isvoted=true 
                console.log(this.isvoted)   
                this.getForm();
            });
            
        },
        async getForm(){
            console.log(this.id_formulario)
      
            const resp= await fetch('api/v1/formulario.php?id_formulario='+this.id_formulario);
            const {titulo,link}= await resp.json();
            console.log(titulo,link)
            this.titulo=titulo;
        },
        recargar(){
            location.href ="votacion.php?link="+this.link;
        }      
                
    }, 
    created:function(){
        this.decryptlink();
    }});


    
    