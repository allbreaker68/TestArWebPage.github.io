import mysql from 'mysql';
import * as dotenv from 'dotenv';
dotenv.config();


var conexion = mysql.createConnection({
  host: process.env.POINT_OF_ACCESS,
  database: process.env.DB,
  user: process.env.USERDB,
  password: ''
});
//process.env.PASS

let conectando = conexion.connect( function (error) {
  if (error) {
    throw error;
  } else {
    console.log('Conexion Exitosa');

  }
});



export {
  conexion,
  conectando

}

