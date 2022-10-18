import express from 'express';
const app = express();

import path from 'path';
import { fileURLToPath } from 'url';
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

import dotenv from 'dotenv';



//routers
import * as home from './router/home_select.js';
import * as session_route from './router/session.js';
import * as form_save_model_route from './router/form_save_models.js'; 
import * as actualizar_modelos from './router/update_and_remove.js';
import * as mails_registered from './router/load_mails.js';
import * as select_ar_web from './router/select_ar_web.js';

//direcionamientos a las web que se va a mostrar
app.get('/', (req, res) => {
  res.render('index')
});

app.set('views', './views');
app.set('view engine', 'ejs');
app.use('/', home.router);
app.use('/', session_route.router);
app.use('/', form_save_model_route.router);
app.use('/', actualizar_modelos.router);
app.use('/', mails_registered.router);
app.use('/', select_ar_web.router);

// estilos
app.get('/ar_web.css', (req, res) => {
  res.sendFile(__dirname + '/public/ar_web.css')
});

//sesiones
//3
dotenv.config({ path: './scripts/.env' });
//4
app.use('/resources', express.static('public'));
app.use('/resources', express.static(__dirname + '/public'));


const port = process.env.port || '4000';
app.listen(port);
console.log('App Listening on :' + port);
