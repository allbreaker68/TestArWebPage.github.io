import express_session from 'express-session';
import express from 'express';
var router = express.Router();
import { conexion } from '../scripts/conexion.js';

const session = express_session;
router.use(session({
  secret: 'secret',
  resave: true,
  saveUninitialized: true
}));


router.get('/ar_web', function (req, res) {
    var id_user = req.query.id_user;
    var id_model = req.query.id_model;
    console.log(id_model,id_user);
    var select_query = "SELECT `modelo_glb`, `modelo_usdz` FROM `model_glb` WHERE id_modelos ="+id_model+" AND user_id ="+id_user;
  
    conexion.query(select_query, function(error, data){
      if (error) {
        throw error;
      } else {
        res.render('AR_web',{action:'list', AR_web:data});
      } 
    });
});



export {
    router
}