var AWS = require('aws-sdk');
var express = require('express');

var app = express();

app.get('/', (peticion,respuesta) => {
  respuesta.sendFile(__dirname + '/index.html');
});

app.get('/formulario_guardar_modelosAWS', (peticion,respuesta) => {
  respuesta.sendFile(__dirname + '/formulario_guardar_modelosAWS.html');
});


//conexion DB

const { prueba_conexion } = require('./conexion');
console.log(prueba_conexion);
//fin conexion

app.listen(3000,function(peticion,respuesta){

  console.log("server funcionando");
});
