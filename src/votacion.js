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
        titulo:"",
        checked:false
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
        terminos(){
            Swal.fire({
                title: 'Terminos y Condiciones',
                text: `Es requisito necesario para la adquisición de los productos que se ofrecen en este sitio, que lea y acepte los siguientes Términos y Condiciones que a continuación se redactan. El uso de nuestros servicios así como la compra de nuestros productos implicará que usted ha leído y aceptado los Términos y Condiciones de Uso en el presente documento. Todas los productos  que son ofrecidos por nuestro sitio web pudieran ser creadas, cobradas, enviadas o presentadas por una página web tercera y en tal caso estarían sujetas a sus propios Términos y Condiciones. En algunos casos, para adquirir un producto, será necesario el registro por parte del usuario, con ingreso de datos personales fidedignos y definición de una contraseña.

                El usuario puede elegir y cambiar la clave para su acceso de administración de la cuenta en cualquier momento, en caso de que se haya registrado y que sea necesario para la compra de alguno de nuestros productos.  no asume la responsabilidad en caso de que entregue dicha clave a terceros.
                
`     ,          
                width: "500px",})
        },




        //RADIO+ID

        getSeleccion(){      
            let data=[]      
            for(let i = 0; i< this.preguntas.length;i++ ){                    

                let seleccion = $(`input[name=radio${this.preguntas[i].id_pregunta}]:checked`).val();                    
                data.push({id:this.preguntas[i].id_pregunta,value:seleccion})
                    //console.log(data)
                    console.log("Se va del for") 
                }                    
                console.log("result")
                //console.log(data)
                this.result=data;    
                console.log(this.result)
            },
            checkform(e){
                let undi = false
                console.log("enviando")
                //e.preventDefault()  
                for (var i = 0; i < this.result.length; i++) {
                    if (typeof this.result[i].value == 'undefined') {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Debe llenar todos los campos',                          
                      })
                        undi = true
                    }
                }
                if (this.result.length <= 0) {
                      Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Debe llenar todos los campos',                          
                      })
                    undi = true
                }
                if (!this.checked) {
                    Swal.fire({
                          icon: 'info',
                          title: 'Terminos y condiciones',
                          text: 'Debe aceptar los terminos y condiciones para seguir...',    
                          customClass: 'swal-wide',                   
                      })

                }
                if (!undi && this.checked) {
                let params = {
                    data: this.result
                }                   
                axios.post('api/v1/detallepregunta.php',params).then(resp => {
                    console.log(resp.data);   
                    this.isvoted=true 
                    console.log(this.isvoted)   
                    this.getForm();
                 });    
                }        
            
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