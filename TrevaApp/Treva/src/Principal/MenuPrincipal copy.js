import React, { Component } from 'react';
import {NavigationContainer,NavigationContext} from '@react-navigation/native';
import { Text, View } from 'react-native';
import LinearGradient from 'react-native-linear-gradient'; 
import DropDownPicker from 'react-native-dropdown-picker';
import { Avatar } from 'react-native-elements';

import styles from "./css.MenuPrincipal"
 
export default class MenuPrincipal extends Component {
    static contextType = NavigationContext;
    constructor(props) {
        super(props);
        this.state = {
          isLoading: true,
          dataSource:[],
          username:'saponte',
          password:'123456',
          nComboboxFormulario: '',
          nComboboxPreguntas:''
        };
      }



  render() {
      
    return (
      <View style={styles.container}  >
        <View style={styles.ViewHeader}  >
        <LinearGradient
            style={styles.gradientHeader}
            colors={['#87f0f0', '#70e8e4', '#58e0d7','#3cd7c9' ,'#0FCFBA']}
            start={{ x: 0.2, y: 0.0 }} end={{ x: 0.9, y: 0.0}}>

                <View style={styles.ViewUser} > 
                    <View style={{flexDirection:"row"   }} >  
                        <Avatar
                            rounded
                            size="large"
                            source={{
                                uri:
                                'https://s3.amazonaws.com/uifaces/faces/twitter/ladylexy/128.jpg',
                            }}
                        />
                        <View style={styles.ViewUser_datos} >
                            <Text style={{fontSize:16,color:"#FFFFFF",fontWeight:"bold"}} >Angi Chris</Text>
                            <Text style={{fontSize:13,color:"#FFFFFF",fontWeight:"bold"}} >Lima</Text>

                        </View>
                    </View>
                </View>


            </LinearGradient>
        </View>

        <DropDownPicker
            items={[
                {label: 'UK', value: 'uk'},
                {label: 'France', value: 'france'},
            ]}
            placeholder="Seleccione un Formulario"
            defaultValue={this.state.nComboboxFormulario}
            containerStyle={{width: "80%", height: 40}}
            style={{backgroundColor: '#fafafa'}}
            dropDownStyle={{backgroundColor: '#fafafa'}}
            onChangeItem={item => this.setState({
                nComboboxFormulario: item.value
            })}
        />
         <DropDownPicker
         disabled={{disabled:false}}
            items={[
                {label: 'UK', value: 'uk'},
                {label: 'France', value: 'france'},
            ]}
            placeholder="Seleccione Pregunta"
            defaultValue={this.state.nComboboxPreguntas}
            containerStyle={{width: "80%", height: 40}}
            style={{backgroundColor: '#fafafa'}}
            dropDownStyle={{backgroundColor: '#fafafa'}}
            onChangeItem={item => this.setState({
                nComboboxPreguntas: item.value
            })}
            
        />

        <Text>Hola Mundo Menu Principal </Text>
      </View>
    );
  }
}