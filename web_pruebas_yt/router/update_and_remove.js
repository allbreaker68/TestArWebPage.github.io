import formidable from 'formidable';
import { readFormData } from '../scripts/s3_controller.js';
import { uploadFileTos3, deleting_object } from '../scripts/s3_Service.js';
import { updateModel, deleting_objects_sql} from '../scripts/guardar_mysql_aws.js'
import fs from 'fs';
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

var glb_location = null;
var usdz_location = null;
var id_modelos = null;

//obtenemos la info de home_principal
router.post('/update_data_glb', function (req, res) {
  glb_location = req.body.update_glb;
  id_modelos = req.body.id_modelos;

  if (req.session.loggedin) {
    res.render('actualizar_modelo_glb');
  } else {
    res.render('')				
  }
  
  return glb_location, id_modelos;
});

router.post('/update_data_usdz', function (req, res) {
  usdz_location = req.body.update_usdz;
  id_modelos = req.body.id_modelos;
  if (req.session.loggedin) {
    res.render('actualizar_modelo_usdz');
  } else {
    res.render('')				
  }
  
  return usdz_location, id_modelos;
});



//recibimos la data de el formulario a actualizar
router.post('/compare_data_glb_and_upload', async function (req, res) {
  const formData = await readFormData(req);

  let name_new_file_glb = formData.file.originalFilename;

  var glb_location_to_string = String(glb_location);

  if (glb_location_to_string.includes(name_new_file_glb)) {
    
    await uploadFileTos3(formData.file, 'web.ar.allbreaker');
    await updateModel(id_modelos, name_new_file_glb, 0);

  } else {

    var glb_location_slice = glb_location_to_string.slice(43);
    
    await deleting_object(glb_location_slice);
    await uploadFileTos3(formData.file, 'web.ar.allbreaker');
    await updateModel(id_modelos, name_new_file_glb, 0);
  }
});

router.post('/compare_data_usdz_and_upload', async function (req, res) {
  const formData = await readFormData(req);

  let name_new_file_usdz = formData.file.originalFilename;
  
  var usdz_location_to_string = String(usdz_location);

  if (usdz_location_to_string.includes(name_new_file_usdz)) {
    
    await uploadFileTos3(formData.file, 'web.ar.allbreaker');
    await updateModel(id_modelos, name_new_file_usdz, 1);

  } else {

    var usdz_location_slice = usdz_location_to_string.slice(43);
    
    await deleting_object(usdz_location_slice);
    await uploadFileTos3(formData.file, 'web.ar.allbreaker');
    await updateModel(id_modelos, name_new_file_usdz, 1);
  }
});


//eliminamos el dato que el usuario desea

router.get('/delete_data',async function(req,res){
  let id_model_to_erase = req.query.id_modelo;
  let model_glb_to_slice = req.query.glb;
  let modelo_usdz_to_slice = req.query.usdz;
  console.log("id "+id_model_to_erase);

  let model_glb = model_glb_to_slice.slice(43);//se borra 43 caracteres porque hay un link y asi solo dejamos el nombre
  let model_usdz = modelo_usdz_to_slice.slice(43);

  await deleting_object(model_glb);
  await deleting_object(model_usdz);
  
  await deleting_objects_sql(id_model_to_erase);
  res.redirect('home_principal')
});
export {
  router
}