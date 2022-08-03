var mysql = require('mysql');


var conexion = mysql.createConnection({
host: 'localhost',
database: 'modelos_web',
user: 'root',
password: ''
});

conexion.connect(function(error){
  if (error) {
    throw error;
  }else{
    console.log('Conexion Exitosa');
  }
});

conexion.end();