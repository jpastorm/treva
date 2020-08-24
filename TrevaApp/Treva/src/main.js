import * as React from 'react';
import { View, Text } from 'react-native';

import { NavigationContainer,NavigationContext,Dimensions } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';

import Login from './PrePrincipal/login'
import MenuPrincipal from './Principal/MenuPrincipal'
import FormPreguntas from './Principal/FormPreguntas'
import DetallePregunta from './Principal/Detalle_pregunta'

function HomeScreen() {
  return (
    <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
      <Text>Home Screen</Text>
    </View>
  );
}

const Stack0 = createStackNavigator();
const Stack1 = createStackNavigator();


const PreHomeNavigator = () => (
    <Stack0.Navigator headerMode="none" >
        <Stack0.Screen name="Login_treva" component={Login} />
        <Stack0.Screen name='Home' component={HomeNavigator}/>
    </Stack0.Navigator>
  );

  const HomeNavigator = () => (
    <Stack1.Navigator headerMode="none" >
        <Stack1.Screen name="Home_treva" component={MenuPrincipal} />
        <Stack1.Screen name="RespPreguntas_treva" component={FormPreguntas} />
        <Stack1.Screen name="DetallePregunta_treva" component={DetallePregunta} />
        <Stack1.Screen name="Login" component={PreHomeNavigator} />
        
    </Stack1.Navigator>
  );


function App() {
  return (
    <NavigationContainer>
      <PreHomeNavigator/>
    </NavigationContainer>
  );
}

export default App;

/*
<ListItem
key={i}
//   leftAvatar={{ source: { uri: l.avatar_url } }}
title={l.titulo}
subtitle={l.descripcion}
chevron={{ color: '#0FCFBA' }}
Component={TouchableOpacity}
onPress={ ()=>{
    alert("go")
}

}
bottomDivider
/>
*/