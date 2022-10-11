import express from 'express';
var router = express.Router();
import { conexion } from '../scripts/conexion.js';
import { var_id_user,var_id_admin } from './session.js';

import express_session from 'express-session';
const session = express_session;
router.use(session({
  secret: 'secret',
  resave: true,
  saveUninitialized: true
}));


router.get('/home_principal',function(req, res, next){
  console.log("valor id user"+var_id_user);
  var select_query = "SELECT * FROM `model_glb` WHERE user_id =" + var_id_user;
  var select_query_admin = "SELECT * FROM `model_glb` WHERE admin_id =" + var_id_admin;

  if (var_id_user) {
    conexion.query(select_query, function(error, data){
      var load = null;
      if (error) {
        throw error;
      } else {
        if (req.session.loggedin) {
          res.render('home_principal.ejs',{title:'Home data', action:'list', home_principal:data, load:load});	
        } else {
          res.render('')				
        }
        
      } 
    });
  } else if(var_id_admin) {
    conexion.query(select_query_admin, function(error, data){
      var load = 1;
      if (error) {
        throw error;
      } else {
        if (req.session.loggedin) {
          res.render('home_principal.ejs',{title:'Home data', action:'list', home_principal:data, load:load });	
        } else {
          res.render('')				
        }
        
      } 
    });
  }
});



export {
    router
}