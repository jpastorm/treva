import React, { Component } from 'react';
import {NavigationContainer,NavigationContext} from '@react-navigation/native';
import {Text,View,ScrollView,TouchableOpacity,FlatList,SafeAreaView } from 'react-native';
import LinearGradient from 'react-native-linear-gradient'; 
import { Avatar,Button,ListItem,CheckBox } from 'react-native-elements';
//import {Text} from 'react-native-svg'

import styles from "../css/css_DetallePregunta"
import AsyncStorage from '@react-native-community/async-storage'
import Componte_PieChart from './Componet_PieChart'
import Componte_BarChart from './Component_barChart'
import { set } from 'react-native-reanimated';


export default class MenuPrincipal extends Component {
  static contextType = NavigationContext;

  constructor(props) {
      super(props);
      //this.g =this.props.navigation.state.params
      this.forceUpdateHandler = this.forceUpdateHandler.bind(this);
      this.state = {
        isLoading: true,
        dataSource:[],
        datafilter:[],
        pregunta:"0",
        id_pregunta:0,
        id_formulario:0,
       
      };
    }



_obtenerDatos = async () => {
  try {
   // console.log("hoa")
    const value = await AsyncStorage.getItem('@treva-id_pregunta')
    const value2 = await AsyncStorage.getItem('@treva-id_formulario')
    if(value !== null) {
   this.setState({id_pregunta: value});
   this.setState({id_formulario: value2});
   return value;
    }
  } catch(e) {
    // error reading value
  }

}

/*
const dataJson = [ {id_pregunta:1,val:30},{id_pregunta:1,val:40},{id_pregunta:1,val:20},{id_pregunta:1,val:10},]
const data = [];
const alternativas=[];
*/


 _filtrando(){
    const data_porcentaje = [];
    const data_opcion = ["Malo","Insuficiente","Regular","Bueno","Excelente"];
    const data_opcion_escogida = [];
    const data_indices = [];
    const data_indicesNombre = [];

    let valor1=0;
    //obtencion de la opcion escogida
    this.state.datafilter.map((l, i) => {
      let divisor=this.state.datafilter.length;
       valor1=valor1+1;
        data_opcion_escogida.push(l.Opciones);
    })

   
   if(valor1!=0){
     //filtramos los resultados para obtener el total de opciones escogidas por opcion
    for (var i = 0; i < data_opcion.length; i++) {
      let contador=0;
      for (var j = 0; j < data_opcion_escogida.length; j++) {
         if (data_opcion[i] == data_opcion_escogida[j]) {
           contador=contador+1;
         }
       }

        if(contador!=0){
          data_indices.push(contador);
          data_indicesNombre.push(data_opcion[i]);
        }

        
      }

    //transformamos en un valor porcentual
      for (var i = 0; i < data_indices.length; i++) {
         let v_porcentaje=(data_indices[i]*100)/data_opcion_escogida.length;
         v_porcentaje = v_porcentaje.toFixed(2);
         v_porcentaje= parseFloat(v_porcentaje)
         data_porcentaje.push(v_porcentaje);
      }
      console.log(data_indicesNombre);
      console.log(data_indices);
      console.log(data_porcentaje);

    return(
      <View>
        <Componte_PieChart datos={data_porcentaje} datosNombre={data_indicesNombre} datosIndice={data_indices}  />
        <Componte_BarChart datos={data_porcentaje} datosNombre={data_indicesNombre} datosIndice={data_indices}  />
      </View>
  )

   }


  


    
   }

   

componentDidMount = async () =>{
  await this._obtenerDatos();
  this.Api()
 }

 Api(){
  let enlaceT="https://treva.ver.pe/";
  let ruta="api/v1/detallepregunta.php?id_formulario="+this.state.id_formulario;
  let rutaT=enlaceT.concat(ruta)
 // console.log(rutaT)
 
  
  fetch(rutaT).then( (response)=> response.json()  )
      
  .then( (responseJason)=> {
   
  this.setState({
      isLoading:false,
      dataSource:responseJason,
      datafilter:responseJason.filter(item=>item.id_pregunta==this.state.id_pregunta),

       })
      // console.log(this.state.datafilter)
     //  console.log(this.state.id_formulario)
       

  } )        

}




//Forzar una actualizacion de Vista
 forceUpdateHandler(){
  //this.Api.bind(this)
  this.forceUpdate();
 // component.forceUpdate(callback)
};


 _tituloPregunta(){

  const alternativas=[];
  this.state.datafilter.map((l, i) => {
      alternativas.push(l.descripcion);
  })
  let datos1=alternativas.length;
  if(datos1!=0){
    for (var i = 0; i <  alternativas.length; i++) {
       // console.log(alternativas[i])
        return(
             <Text style={{textAlign:"center",fontWeight:"bold",fontSize:18 }} > {alternativas[i]} </Text>
             )
        break;
      
    }
  }
 
 }


render(){
  const navigation = this.context;

  return (
    <View style={styles.container}  >
        <ScrollView  style={styles.scroll}  >
                <View style={styles.ViewFormularios}  >


                <View style={styles.ViewHeader}  >
                <LinearGradient
                    style={styles.gradientHeader}
                    colors={['#87f0f0', '#70e8e4', '#58e0d7','#3cd7c9' ,'#0FCFBA']}
                    start={{ x: 0.2, y: 0.0 }} end={{ x: 0.9, y: 0.0}}>

                      <View style={styles.ViewUser} > 
                          <View style={{flexDirection:"row" }} > 

                            <View>
                              </View> 
                              
                             
                          </View>
                      </View>
              </LinearGradient>
            </View>

                
                  <View style={{marginTop:20,marginRight:20,elevation:5,alignSelf:"center",
                    backgroundColor:"#FFFFFF",borderRadius:10,padding:10,position:"absolute",width:"90%",height:200}} >
                       {this._tituloPregunta()}

                        <Text style={{marginBottom:10,marginTop:10,color:"#3E3E3E",fontSize:15,fontWeight:"bold"  }} >Opciones Existentes :</Text>
                        <Text style={{color:"#3E3E3E"}} >a)  Malo</Text>
                        <Text style={{color:"#3E3E3E"}} >b)  Insuficiente</Text>
                        <Text style={{color:"#3E3E3E"}} >c)  Regular</Text>
                        <Text style={{color:"#3E3E3E"}} >d)  Bueno</Text>
                        <Text style={{color:"#3E3E3E"}} >f)  Excelente</Text>
                    </View>
               
                      <View style={{width:"100%",height:50,marginTop:45,flexDirection:"row-reverse"}} >
                      <TouchableOpacity
                              style={styles.button,{width:50,height:50,marginRight:10}}
                            >
                              <Avatar
                                rounded
                                size={"medium"}
                                source = {require('../img/pintar.png')}
                                onPress={()=>{this.forceUpdateHandler()}}
                                                    /> 
                            </TouchableOpacity>
                      </View>
                   
                       <View style={{marginTop:20}}>

                       

                         {this._filtrando()}
                       </View>
                       
                </View>
        </ScrollView>
  </View>
);

}
  



}


