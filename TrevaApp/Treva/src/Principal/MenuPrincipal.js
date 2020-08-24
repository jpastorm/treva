import React, { Component } from 'react';
import {NavigationContainer,NavigationContext} from '@react-navigation/native';
import { Text, View,ScrollView,TouchableOpacity,FlatList } from 'react-native';
import LinearGradient from 'react-native-linear-gradient'; 
import DropDownPicker from 'react-native-dropdown-picker';
import { Avatar,Button,ListItem } from 'react-native-elements';

import styles from "./css.MenuPrincipal"
import AsyncStorage from '@react-native-community/async-storage'

import Componte_Header_Usuario from './Component_header_User'

 
const storeData = async (id_formulario ) => {
  try {

    await AsyncStorage.setItem('@treva-id_formulario', id_formulario)

  } catch (e) {
    // saving error
    alert(e)
  }
}


export default class MenuPrincipal extends Component {
    static contextType = NavigationContext;

    _Logout = async (navigation) => {
      await AsyncStorage.clear();
      navigation.navigate('Login')
   }

    constructor(props) {
        super(props);
        this.state = {
          isLoading: true,
          dataSource:[],
          datafilter:[],
          nombre_user:"",
          apellido_user:"",
          nComboboxFormulario: '',
          nComboboxPreguntas:'',
          id_user:0,
          total_formulario:0
        };
      }
    
      _obtenerDatos = async () => {
        try {
         // console.log("hoa")
          const value = await AsyncStorage.getItem('@treva-id_usuario')
          const value2 = await AsyncStorage.getItem('@treva-nombre')
          const value3 = await AsyncStorage.getItem('@treva-apellido_pa')
          if(value !== null) {
            // value previously store
        //  console.log(value)
         this.setState({id_user: value});
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
        let ruta="api/v1/formulario.php";
        let rutaT=enlaceT.concat(ruta)
       
        this._obtenerDatos();
        
        fetch(rutaT).then( (response)=> response.json()  )
            
        .then( (responseJason)=> {
       //  console.log(responseJason)
        this.setState({
            isLoading:false,
            dataSource:responseJason,
            datafilter:responseJason.filter(item=>item.id_usuario==this.state.id_user && item.estado == "A"  ),
             })
             let divisor=this.state.datafilter.length;
             console.log(divisor)
             this.setState({total_formulario:divisor})
        } )
        

            

       }



       _lista(isCargando,navigation){

          if(isCargando){
      //      console.log("aun no")

          }else{
        //    console.log("si")
            
         return(
           <View>
             {this.state.datafilter.map((l, i) => (
                <ListItem
                  key={i}
                  title={l.titulo}
                  subtitle={l.descripcion}
                  chevron={{ color: '#0FCFBA' }}
                  Component={TouchableOpacity}
                  onPress={ ()=>{
                     // alert("go")
                     this._irPreguntas(navigation,l.id_formulario)
                  }}
                  bottomDivider
                />
              )) }
           </View>
         )
  
        }
      }

 _irPreguntas(navigation,id_formulario){
  storeData(id_formulario);
  navigation.navigate('RespPreguntas_treva')
  
//  navigation.navigate('RespPreguntas_treva',{ misPosts: 1 })
 /* this.props.navigation.navigate(
    'RespPreguntas_treva',
    { misPosts:1},
  );*/
  
}


  render() {
      
    const navigation = this.context;
  //  this._automatic_login2(navigation)
    let isCargando=this.state.isLoading

    

    return (
      <View style={styles.container}  >
        <ScrollView  style={styles.scroll} >
          
        <Componte_Header_Usuario nom_user={this.state.nombre_user} apellido_user={this.state.apellido_user} totalx= {this.state.total_formulario}  />
              
              <View style={styles.ViewFormularios}  >
                  <Text style={{textAlign:"center",fontSize:15,fontWeight:"bold",marginBottom:15,marginTop:15  }} >Mis Formularios </Text>
                    
                  {this._lista(isCargando,navigation)}

                    <View style={{alignItems:"center",justifyContent:"center",marginTop:15,marginBottom:15}} >
                    <Button
                            title="Cerrar Session"
                            type="solid"
                            buttonStyle={{backgroundColor:"#0FCFBA",borderRadius:20,width:200}}
                            onPress={() => {this._Logout(navigation);}}    
                    />
                    </View>


              </View>
                




        </ScrollView>
      </View>
    );
  }
}
