import mysql from 'mysql';
import * as dotenv from 'dotenv';
dotenv.config();
import * as vars_env from './node_to_linux.js'


var conexion = mysql.createConnection({
host: vars_env.vars_to_node[0],
database: 'modelos_web',
user: vars_env.vars_to_node[1],
password: vars_env.vars_to_node[2]
});
/*
var conexion = mysql.createConnection({
  host: "localhost",
  database: 'modelos_web',
  user: "root",
  password: ''
});*/

let conectando = conexion.connect( async function(error){
  if (error) {
    throw error;
  }else{
    console.log('Conexion Exitosa');
  }
});




export {
  conexion,
  conectando

}
 
