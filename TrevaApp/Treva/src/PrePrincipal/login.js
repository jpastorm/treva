import React, { Component } from 'react';
import { Text, View,TextInput,Image,ImageBackground,TouchableOpacity } from 'react-native';
import {NavigationContainer,NavigationContext} from '@react-navigation/native';
import AsyncStorage from '@react-native-community/async-storage'


import styles from "./css.login"
import Icon from 'react-native-vector-icons/dist/FontAwesome';
import { Input,Button } from 'react-native-elements';



const storeData = async (id_usuario,nombre,apellido_pa,apellido_ma,correo,usuario ) => {
  try {
    await AsyncStorage.setItem('@treva-id_usuario', id_usuario)
    await AsyncStorage.setItem('@treva-nombre', nombre)
    await AsyncStorage.setItem('@treva-apellido_pa', apellido_pa)
    await AsyncStorage.setItem('@treva-apellido_ma', apellido_ma)
    await AsyncStorage.setItem('@treva-correo', correo)
    await AsyncStorage.setItem('@treva-usuario', usuario)

   // const value = await AsyncStorage.getItem('@treva-usuario')

  //  console.log(value)

  } catch (e) {
    // saving error
    alert(e)
  }
}

 
export default class Login extends Component {

    static contextType = NavigationContext;

    
    constructor(props) {
        super(props);
        this.state = {
          isLoading: true,
          dataSource:[],
          username:'',
          password:''
        };
      }

      componentDidMount(){

            let enlaceT="https://treva.ver.pe/";
            let ruta="api/v1/usuario.php";
            let rutaT=enlaceT.concat(ruta)

            fetch(rutaT).then( (response)=> response.json()  )
                
            .then( (responseJason)=> {
            this.setState({
                isLoading:false,
                dataSource:responseJason
                 })
            } )        
 
       }

       _automatic_login = async (navigation) => {
            try {
              const value = await AsyncStorage.getItem('@treva-id_usuario')
              if(value !== null) {
                // value previously stored
                navigation.navigate('Home')
              }
            } catch(e) {
              // error reading value
            }

       }


    
  render() {
    const navigation = this.context;
    this._automatic_login(navigation)
    if(this.state.isLoading){


        return(
         <View>
          <Text styles={{alignItems: 'center'}} >Cargando ...</Text>
         </View>
        );
  
      }else{
        let datos1=this.state.dataSource.map((val,key)=>{
          return<View key={key} style={{flexDirection:"row",alignContent:"center",alignItems:"center",alignContent:"center",justifyContent:"center"}}  >
                    <Text> {val.id_usuario} </Text>  
                    <Text> {val.nombre} </Text>  
                    <Text> {val.apellido_pat} </Text>  
               </View>
        }  );
  
        return (
          <View style={styles.container} >
               <View  style={{marginBottom:20  }} >
                  <Image
                        style={{width:155,height:180}}
                        source={require('../img/logoP.png')}
                    />
               </View>
              
              <Text style={styles.TituloLogin}  >Bienvenido!</Text>
  

            <View style={styles.viewInput}  >
                <Input
                        placeholder="Email"
                        leftIcon={{ type: 'MaterialCommunityIcons', name: 'email',size:24,color:"#0FCFBA" }}
                        onChangeText={value => this.setState({ username: value })}
                        inputContainerStyle={{borderColor:"#0FCFBA"}}
                        
                    />
                 <Input
                        placeholder="Password"
                        leftIcon={{ type: 'MaterialCommunityIcons', name: 'email',size:24,color:"#0FCFBA" }}
                        onChangeText={value => this.setState({ password: value })}
                        inputContainerStyle={{borderColor:"#0FCFBA"}}
                        secureTextEntry={true}
                    />

            </View>

            <Button
                title="Iniciar Session"
                type="solid"
                buttonStyle={{backgroundColor:"#0FCFBA",borderRadius:20,width:200}}
                onPress={() => {
                    const { username, password } = this.state;
              
                    let results=this.state.dataSource
                    for(var i = 0; i < results.length; i += 1){
                      var result = results[i];
                      if(result.usuario === username){
                          if(result.contrasenia === password)
                          
                          storeData(result.id_usuario,result.nombre,result.apellido_pat,result.apellido_mat,
                            result.correo,result.usuario);
                            

                          //  console.log(value)
                          //console.log(result.nombre)
                          navigation.navigate('Home')
                          return result;
                      }
                    }
              
                    }} 
            />
          
    
          </View>
        );
      }
  
  }
}

