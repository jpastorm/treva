import React from 'react'
import { BarChart, XAxis,Grid } from 'react-native-svg-charts'
import { View } from 'react-native'
import * as scale from 'd3-scale'
import { Text } from 'react-native-svg'

const randomColor = () => ('#' + ((Math.random() * 0xffffff) << 0).toString(16) + '000000').slice(0, 7)

const _filtrando=(datos,datosNombre,datosIndice )=>{

    const data = [ 14, 80, 100, 55,15 ]
    const CUT_OFF = 20

    const Labels = ({ x, y, bandwidth, data }) => (
        data.map((value, index) => (
            <Text
                key={ index }
                x={ x(index) + (bandwidth / 2) }
                y={ value < CUT_OFF ? y(value) - 10 : y(value) + 15 }
                fontSize={ 14 }
                fill={ value >= CUT_OFF ? 'white' : 'black' }
                alignmentBaseline={ 'middle' }
                textAnchor={ 'middle' }
            >
                {value}
            </Text>
        ))
    )


    return (
        <View style={{ height: 300, padding: 20,paddingTop:0 }}>
        <BarChart
            style={{ flex:1, paddingTop:0}}
            data={datosIndice}
            gridMin={0}
            contentInset={{ top: 30, bottom: 10 }}
            svg={{ fill: randomColor() }}
        >
             <Grid direction={Grid.Direction.HORIZONTAL}/>
                    <Labels/>
        </BarChart>
        <XAxis
            style={{ marginHorizontal: 15,marginTop:10,padding:0 }}
            data={ datosIndice }
            formatLabel={ (value, index) => datosNombre[ index ] }
           
            contentInset={{ left: 20, right: 25}}
            svg={{ fontSize: 12, fill: 'black' }}
        />
        
    </View>
    )
   }

   const data_indices = [];
   const data_nombres = [];
   //recibe los datos de Detalle_preguntas.js
function Home({ datos,datosNombre,datosIndice }) {
    
    for (var j = 0; j < datosIndice.length; j++) {
        //console.log("Hola");
        data_indices.push(datosIndice[j])
        data_nombres.push(datosNombre[j])
      }



    return (
        <View style={{marginTop:0,height:400,width:"100%",justifyContent:"center",alignContent:"center" }}  >
            {_filtrando(datos,datosNombre,datosIndice )}
        </View>
    );
  }



     
export default Home