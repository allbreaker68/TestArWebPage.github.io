import express from 'express';
var router = express.Router();
import { conexion } from '../scripts/conexion.js';
import { var_id_admin } from './session.js';

import express_session from 'express-session';
const session = express_session;
router.use(session({
    secret: 'secret',
    resave: true,
    saveUninitialized: true
}));


router.get('/mails_registered', function (req, res, next) {

    var sql_mails_verified = "SELECT * FROM `correos_verificados`";

    conexion.query(sql_mails_verified, function (error, data) {
        if (error) {
            throw error;
        } else {
            if (req.session.loggedin && var_id_admin) {
                res.render('mails_registered', { action: 'list', data_mails: data });
            } else {
                res.render('')
            }

        }
    });
});

router.get('/active_accounts', function (req, res) {
    var sql_select_active_accounts = "SELECT * FROM `user`;";
    conexion.query(sql_select_active_accounts, function (error, data) {
        if (error) {
            throw error;
        } else {
            if (req.session.loggedin && var_id_admin) {
                res.render('active_accounts', { action: 'list', data_users: data });
            } else {
                res.render('')
            }

        }
    });
});

router.get('/delete_mails', async function (req, res) {

    let id_correos = req.query.id_correos;
    var sql_delete_mails = "DELETE FROM `correos_verificados` WHERE id_correos =" + id_correos;
    conexion.query(sql_delete_mails, function (error, rows, fields) {
        if (error) {
            throw error
        } else {
            res.redirect("home_principal");
        }
    });
});

router.get('/paper_bin', function(req,res){
    var sql_select_paper_bin = "SELECT * FROM `modelos_borrados`";
    conexion.query(sql_select_paper_bin, function(error,data){
        if (error) {
            throw error;
          } else {
            if (req.session.loggedin && var_id_admin) {
              res.render('paper_bin.ejs',{action:'list', paper_bin:data});	
            } else {
              res.render('')				
            }
            
          }
    });
    
});

router.get('/Move_to_paper_bin', async function (req, res) {
    let user_id = req.query.user_id;
    //variables de consulta
    var sql_select_user = "SELECT * FROM `user` WHERE user_id =" + user_id;
    var sql_select_models_user = "SELECT * FROM `model_glb` WHERE user_id =" + user_id;                                                 //algunos ? no traen '' porque al hacer la consulta ya los traen por defecto 
    var sql_move_to_bin = "INSERT INTO `modelos_borrados`(`id_anterior_del_modelo`, `id_correo_borrar`, `correos_borrados`, `model_glb_borrado`, `model_usdz_borrado`, `admin_id`) VALUES ('?','?',?,?,?,'?')";
    var sql_delete_from_user_table = "DELETE FROM `user` WHERE user_id=" + user_id;
    var admin = 1;

    // asignamos los valores consultados a variables de javascript
    //user
    let final_user_id;
    let final_userName;
    //modelos
    let final_id_modelos = [];
    let final_modelo_glb = [];
    let final_modelo_usdz = [];

    conexion.query(sql_select_user, async function (error, rows, fields) {
        if (error) {
            throw error
        } else {
            console.log(rows);
            final_user_id = rows[0].user_id;
            final_userName = rows[0].Usuario;
            
            return final_user_id, final_userName;
        }

    });

    conexion.query(sql_select_models_user, async function (error, rows, fields) {
        if (error) {
            throw error
        } else {
            console.log(rows);
            for (let i = 0; i < rows.length; i++) {
                final_id_modelos.push(rows[i].id_modelos);
                final_modelo_glb.push(rows[i].modelo_glb);
                final_modelo_usdz.push(rows[i].modelo_usdz);

                var values_to_insert_in_bin = [final_id_modelos[i], final_user_id, final_userName, final_modelo_glb[i], final_modelo_usdz[i], admin];

                conexion.query(sql_move_to_bin, values_to_insert_in_bin, async function (errors, rows_1) {
                    if (errors) {
                        throw errors
                    } else {
                        console.log("insercion completada!")
                    }
                });
            }
        }
    })

    conexion.query(sql_delete_from_user_table, async function(error, rows){
        if (error) {
            throw error
        } else {
            console.log("usuario eliminado correctamente");
        }
    });

});

export {
    router
}