var mysql = require('mysql');
var AWS = require('aws-sdk');

var conexion = mysql.createConnection({
host: 'dbpruebasmodelwebar.ccnilygdxq9g.us-east-1.rds.amazonaws.com',
database: 'modelos_web',
user: 'admin',
password: '	data-modelweb'
});

conexion.connect(function(error){
  if (error) {
    throw error;
  }else{
    console.log('Conexion Exitosa');
    respuesta.writeHead(500, { 'Content-Type': 'text/plain' })
    respuesta.write('cargo exitosamente la DB')
    respuesta.end()
  }
});

conexion.end();

exports.prueba_conexion = conexion.connect;