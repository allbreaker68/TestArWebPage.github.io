
var express = require('express');

var app = express();

app.get('/', (peticion,respuesta) => {
  respuesta.sendFile(__dirname + '/index.html');
});

app.get('/formulario_guardar_modelosAWS', (peticion,respuesta) => {
  respuesta.sendFile(__dirname + '/formulario_guardar_modelosAWS.html');
});

app.listen(3000,function(peticion,respuesta){

  console.log("server funcionando");
});
