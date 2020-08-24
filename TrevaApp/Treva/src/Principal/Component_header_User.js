import React, { Component } from 'react';
import {StyleSheet,View,Text} from 'react-native'
import LinearGradient from 'react-native-linear-gradient'; 
import { Avatar } from 'react-native-elements';

export default class Component_header_user extends Component {


    render(){

      let nombre_usuario=this.props.nom_user
      let apellido_usuario=this.props.apellido_user

      let Totalx=this.props.totalx

            return(
                <View>
                   <View style={styles.ViewHeader}  >
                    <LinearGradient
                        style={styles.gradientHeader}
                        colors={['#87f0f0', '#70e8e4', '#58e0d7','#3cd7c9' ,'#0FCFBA']}
                        start={{ x: 0.2, y: 0.0 }} end={{ x: 0.9, y: 0.0}}>

                          <View style={{flexDirection:"row",width:"90%",height:"100%",alignSelf:"center"}} >
                          
                              <View style={{width:"60%",justifyContent:"center"}} >

                              <View style={{flexDirection:"row"}} > 
                                <Avatar
                                    rounded
                                    size={"large"}
                                    source = {require('../img/logoP.png')}
                              /> 
                              
                              <View style={styles.ViewUser_datos} >
                                  <Text style={{fontSize:16,color:"#FFFFFF",fontWeight:"bold"}} >{nombre_usuario} </Text>
                                  <Text style={{fontSize:13,color:"#FFFFFF",fontWeight:"bold"}} >{apellido_usuario} </Text>

                              </View>

                          </View>

    


                              </View>
                              <View style={{width:"40%", height:20,height:"100%",justifyContent:"center",alignItems:"center"}} >
                              <View style={{width:100,height:80,borderRadius:25,justifyContent:"center",backgroundColor:"#ffffffff" }}  >
                                      <Text style={{textAlign:"center"}}>Total</Text>
                                      <Text style={{textAlign:"center"}}>{Totalx} </Text>
                              </View>
                                </View>

                          </View>

                        
                  </LinearGradient>
            </View>
                </View>
            )
    }
}

 
const styles =  StyleSheet.create({

      ViewHeader:{
        width: "100%",
        height:180,
      },
      gradientHeader: {
        height:"100%",
        width:"100%",
    },
      ViewUser:{
        height:"100%",
        marginLeft:"5%",
        marginRight:"5%",
        justifyContent:"center",
        width:"50%",
        backgroundColor:"#FFFFFF",
        flexDirection:"row-reverse"

      },
      ViewUser_datos: {
        marginLeft:15,
        justifyContent:"center"
      },
    

});