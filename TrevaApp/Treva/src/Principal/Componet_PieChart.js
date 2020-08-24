import React, { Component } from 'react';
import {View } from 'react-native';
import {Text,Circle,G,Line,Rect} from 'react-native-svg'
import styles from "../css/css_DetallePregunta"
import { PieChart } from 'react-native-svg-charts'


const randomColor = () => ('#' + ((Math.random() * 0xffffff) << 0).toString(16) + '000000').slice(0, 7)


const pieData = (data) =>data
.filter((value) => value > 0)
.map((value, index) => ({
    value,
    svg: {
        fill: randomColor(),
        onPress: () => console.log('press', index),
    },
    key: `pie-${index}`,
}))

const Label_Chart = ({slices}) => {
    return slices.map((slice,index)=>{
        const {pieCentroid,data}=slice;
        let valor=data.value.toString();
        let rutaT=valor.concat("%");
        return(
            <Text 
            key={`label-${index}`}
            x={pieCentroid[0]}
            y={pieCentroid[1]}
            fill="#FFFFFF"
            textAnchor={'middle'}
            alignmentBaseline={'middle'}
            fontSize={13}
            fontWeight={"bold"}
             >{rutaT}
            </Text>
        )
    })
}

const Labels = ({ slices }) => {
    return slices.map((slice, index) => {
        const { labelCentroid, pieCentroid, data } = slice;
       // console.log(data_indices.length)
        return (
            <G key={ index }>
                <Line
                    x1={ labelCentroid[ 0 ] }
                    y1={ labelCentroid[ 1 ] }
                    x2={ pieCentroid[ 0 ] }
                    y2={ pieCentroid[ 1 ] }
                    stroke={ data.svg.fill }
                    
                />
                <Rect
                    x={ labelCentroid[ 0 ]-40 }
                    y={ labelCentroid[ 1 ]-20 }
                    width="80"
                    height="35"
                    fill={data.svg.fill}
                 />
                
                <Text 
                    key={`label-${index}`}
                    x={labelCentroid[0]}
                    y={labelCentroid[1]}
                    fill="#FFFFFF"
                    textAnchor={'middle'}
                    alignmentBaseline={'middle'}
                    fontSize={13}
                    >{data_nombres[index]}
                    </Text>  



            </G>
        )
    })
}


const _filtrando=(datos,datosNombre,datosIndice )=>{

    
    return(
        <PieChart style={{marginTop:0,alignSelf:"center",height:"100%",width:"100%"}} data={pieData(datos)}  
        innerRadius={ 30 }
        outerRadius={ 100 }
        labelRadius={ 150 } >
            <Label_Chart   />
            <Labels />
        </PieChart>
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
        <View style={{marginTop:0,height:400 }}  >
            {_filtrando(datos,datosNombre,datosIndice )}
        </View>
    );
  }



     
export default Home

