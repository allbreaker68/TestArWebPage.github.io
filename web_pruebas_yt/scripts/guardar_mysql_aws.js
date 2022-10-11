import { conexion } from './conexion.js';
import { var_id_user,var_id_admin } from '../router/session.js';

//ingresar valores nuevos al mysql 
let insert_query_to_myslq = (fileObj_glb) => {

    let modelo_glb_file = fileObj_glb.originalFilename;
    var link_modelo_glb = "https://s3.amazonaws.com/web.ar.allbreaker/"+modelo_glb_file; 
    console.log(modelo_glb_file);
    let admin = 1;
    let user_id;

    if (var_id_user) {
        user_id = var_id_user;
    }else if(var_id_admin){
        user_id = var_id_admin;
    }
    

    var sql = "INSERT INTO model_glb ( modelo_glb, admin_id, user_id) VALUES(?,?,?) ";

    conexion.query(sql, [link_modelo_glb, admin, user_id], function (err, result) {
        if (err) throw err;
        console.log("1 record inserted");
    });


};

let select_and_update = (fileObj_usdz) => {
    let modelo_usdz = fileObj_usdz.originalFilename;
    var link_modelo_usdz = "https://s3.amazonaws.com/web.ar.allbreaker/"+modelo_usdz;
    console.log("nombre usdz" + modelo_usdz);
    let user_id;
    if (var_id_user) {
        user_id = var_id_user;
    }else if(var_id_admin){
        user_id = var_id_admin;
    }
    let valor_id_modelos = 0;

    var sql_select = "SELECT MAX(id_modelos) FROM model_glb WHERE user_id ="+user_id;

    conexion.query(sql_select, function (err, rows, fields) {

        var row_to_cut = JSON.stringify(rows);
        var row_cut = row_to_cut.slice(20, -2);
        valor_id_modelos = parseInt(row_cut);
        console.log("valor id modelos  " + valor_id_modelos);



        var sql_update = "UPDATE `model_glb` SET `modelo_usdz`='" + link_modelo_usdz + "' WHERE user_id = " + user_id + " AND id_modelos = " + valor_id_modelos;
        

        conexion.query(sql_update, function (err, rows, fields) {
            if (err) {
                throw err
            } else {
                console.log("se ha cambiado el modelo correctamente");
            }


        });
    });

    //guardar el update dentro del select para que sirva

}

//cambiar valores anteriormente guardados

async function updateModel(id_modelos,name_new_model,choose_value) {
    var link_new_model = "https://s3.amazonaws.com/web.ar.allbreaker/" + name_new_model;
    if (choose_value == 0) {
        var sql_update_model_glb = "UPDATE `model_glb` SET `modelo_glb`='"+ link_new_model +"' WHERE id_modelos="+id_modelos;
    } else if (choose_value == 1){
        var sql_update_model_glb = "UPDATE `model_glb` SET `modelo_usdz`='"+ link_new_model +"' WHERE id_modelos="+id_modelos;
    }
    
    conexion.query(sql_update_model_glb, function(err, rows,fields){
        if (err) {
            throw err
        } else {
            console.log("se ha cambiado el modelo correctamente");
        }
    });
}
//borrando datos de mysql
async function deleting_objects_sql(id) {
    let sql_to_delete_models="DELETE FROM `model_glb` WHERE id_modelos="+id;
    conexion.query(sql_to_delete_models, function(err,rows,fields){
        if (err) {
            throw err
        } else {
            console.log("Eliminado correctamente de la BD");            
        }
    });
}


export {
    insert_query_to_myslq,
    select_and_update,
    updateModel,
    deleting_objects_sql
}
