var http = require('http');

var servidor = http.createServer(function(peticion, respuesta){
  respuesta.writeHead(200, {'Content-type':'text/html;charset=utf-8'});
  respuesta.write('<h3>Server de nodejs</h3>');
  console.log('peticion web');
  respuesta.end();
})

servidor.listen(3000);
console.log('Ejecuntando un server local con node.js');