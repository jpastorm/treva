import React, { Component } from 'react';
import {NavigationContainer,NavigationContext} from '@react-navigation/native';
import { Text, View,ScrollView,TouchableOpacity,FlatList,SafeAreaView } from 'react-native';
import LinearGradient from 'react-native-linear-gradient'; 
import DropDownPicker from 'react-native-dropdown-picker';
import { Avatar,Button,ListItem } from 'react-native-elements';

import styles from "./css.MenuPrincipal"
import AsyncStorage from '@react-native-community/async-storage'

import Componte_Header_Usuario from './Component_header_User'


const storeData = async (id_pregunta ) => {
  try {

    await AsyncStorage.setItem('@treva-id_pregunta', id_pregunta)

  } catch (e) {
    // saving error
    alert(e)
  }
}


 
export default class MenuPrincipal extends Component {
    static contextType = NavigationContext;

    constructor(props) {
        super(props);
        //this.g =this.props.navigation.state.params
        this.state = {
          isLoading: true,
          dataSource:[],
          datafilter:[],
          pregunta:"",
          id_formulario:0,
          total_preguntas:0,
         
        };
      }
      _obtenerDatos = async () => {
        try {
         // console.log("hoa")
          const value = await AsyncStorage.getItem('@treva-id_formulario')
          const value2 = await AsyncStorage.getItem('@treva-nombre')
          const value3 = await AsyncStorage.getItem('@treva-apellido_pa')
          if(value !== null) {
         this.setState({id_formulario: value});
         this.setState({nombre_user: value2});
         this.setState({apellido_user: value3});
         return value;
          }
        } catch(e) {
          // error reading value
        }

   }

      componentDidMount(){

        let enlaceT="https://treva.ver.pe/";
        let ruta="api/v1/pregunta.php";
        let rutaT=enlaceT.concat(ruta)
        this._obtenerDatos();

        fetch(rutaT).then( (response)=> response.json()  )
            
        .then( (responseJason)=> {
       //  console.log(responseJason)
        this.setState({
            isLoading:false,
            dataSource:responseJason,
            datafilter:responseJason.filter(item=>item.id_formulario==this.state.id_formulario )
             })
             let divisor=this.state.datafilter.length;
             console.log(divisor)
             this.setState({total_preguntas:divisor})
          //  console.log(this.state.datafilter); 
        } )        

       }

       _lista(isCargando,navigation){

          if(isCargando){
          }else{
              
         return(
           <View>
             {
               this.state.datafilter.map((l, i) => (
                <ListItem
                  key={i}
                  title={l.descripcion}
                  Component={TouchableOpacity}
                  onPress={ ()=>{

                    this._irPreguntas(navigation,l.id_pregunta) 
                  }}
                  bottomDivider
                />
              ))

             }
           </View>
         )
        
           
          }

       }



    

    _irPreguntas(navigation,id_pregunta){
      storeData(id_pregunta);
         // navigation.navigate('DetallePregunta_treva', {imc:this.state.pregunta})
    navigation.navigate('DetallePregunta_treva')
    }

    _Cargar(){
     // let a=this.props.navigation.state.params.id_formulario
    }
       
     
  render() {
      
    const navigation = this.context;
   // _Cargar()
    let isCargando=this.state.isLoading


    return (
      <View style={styles.container}  >
        <ScrollView  style={styles.scroll}  >
           <Componte_Header_Usuario  nom_user={this.state.nombre_user} apellido_user={this.state.apellido_user} totalx= {this.state.total_preguntas} />
              <View style={styles.ViewFormularios}  >
                  <Text style={{textAlign:"center",fontSize:15,fontWeight:"bold",marginBottom:15,marginTop:15  }} >Mis Preguntas </Text>
                    

                  {this._lista(isCargando,navigation)}


              </View>
        </ScrollView>
      </View>
    );
  }
}