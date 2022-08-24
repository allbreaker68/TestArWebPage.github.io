var mysql = require('mysql');
var AWS = require('aws-sdk');

var conexion = mysql.createConnection({
host: 'POINT_OF_ACCESS',
database: 'DATABASE',
user: 'admin',
password: 'CONTRA_POINT_OF_ACCESS'
});



conexion.connect(function(error){
  if (error) {
    throw error;
  }else{
    console.log('Conexion Exitosa');
    bl = true;
  }
});



conexion.end();

exports.prueba_conexion = conexion.connect;