import express from 'express';
import express_session from 'express-session';
const app = express();
var router = express.Router();
import { conexion } from '../scripts/conexion.js';

import bcryptjs from 'bcryptjs';

//2 👇️
//https://www.youtube.com/watch?v=HaDR7YRclaQ&list=PLrAw40DbN0l0iO_jC_2Hot76utBvShXmK&index=6
router.use(express.urlencoded({ extended: false }));
router.use(express.json());
//variable de sesion
const session = express_session;
router.use(session({
  secret: 'secret',
  resave: true,
  saveUninitialized: true
}));

//variable para saber el id del usuario
let var_id_user = null;
let var_id_admin = null;

router.get('/login', (req, res) => {
  res.render('login')
});

router.get('/reg_new_mail', (req, res) => {
  if (req.session.loggedin && var_id_admin) {
    res.render('reg_new_mail')
  } else {
    res.render('')
  }
});

router.get('/register', (req, res) => {
  res.render('register')
});

//10 registrar
router.post('/register', async (req, res) => {
  const user = req.body.user;
  const pass = req.body.pass;
  let admin = "1";
  let adminparse = parseInt(admin);

  let passwordHaash = await bcryptjs.hash(pass, 8);

  let sql_select_to_compare_user = "SELECT * FROM `user` WHERE Usuario = ?;";
  let sql_insert_to_user = "INSERT INTO user ( usuario,  user_pass, admin_id) VALUES(?,?,?)";
  let values_to_sql = [user, passwordHaash, adminparse];

  conexion.query(sql_select_to_compare_user, user, async (error, results) => {
    if (results.length > 0) {
      res.render('register', {
        alert: true,
        alertTitle: "Usuario ya Existente",
        alertMessage: "Este correo ya a sido registrado anteriormente",
        alertIcon: 'error',
        showConfirmButton: false,
        timer: 2500,
        ruta: 'register'
      });
    } else {
      conexion.query(sql_insert_to_user, values_to_sql, async (error, results) => {
        if (error) {
          console.log(error);
        } else {
          res.render('register', {
            alert: true,
            alertTitle: "Registro nuevo usuario",
            alertMessage: "¡Registro Completado!",
            alertIcon: 'success',
            showConfirmButton: false,
            timer: 2500,
            ruta: 'register'
          });
        }
      })
    }
  })


})
//registro nuevo correo
router.post('/register_new_mail', async (req, res) => {
  const mail = req.body.correo_ingresado;

  let admin = "1";
  let adminparse = parseInt(admin);

  let sql_select_to_compare_mails = "SELECT * FROM correos_verificados WHERE correos_verificados_byAdmin = ?;"
  let sql_insert_to_verified_mails = "INSERT INTO correos_verificados (correos_verificados_byAdmin, admin_id) VALUES (?,?)";
  let values_to_sql = [mail, adminparse];

  conexion.query(sql_select_to_compare_mails, mail, async (error, results) => {
    if (results.length > 0) {
      res.render('reg_new_mail', {
        alert: true,
        alertTitle: "Correo Existente",
        alertMessage: "Este correo ya a sido registrado anteriormente",
        alertIcon: 'error',
        showConfirmButton: false,
        timer: 2000,
        ruta: 'reg_new_mail'
      });
    } else {
      conexion.query(sql_insert_to_verified_mails, values_to_sql, async (error, results) => {
        if (error) {
          console.log(error);
        } else {
          res.render('reg_new_mail', {
            alert: true,
            alertTitle: "Registro correos",
            alertMessage: "¡Registro Correcto!",
            alertIcon: 'success',
            showConfirmButton: false,
            timer: 2000,
            ruta: 'reg_new_mail'
          });
        }
      })
    }
  })

})

//11 autenticar
router.post('/autentication', (req, res) => {

  const user = req.body.user;
  const pass = req.body.pass;

  let sql_to_compare_admin = "SELECT * FROM `admin` WHERE correo = ?";
  let sql_select_to_compare_user = "SELECT * FROM user WHERE usuario = ?";
  let values_to_sql_select = [user];

  console.log("valores del sql " + values_to_sql_select);
  if (user && pass) {

    conexion.query(sql_select_to_compare_user, values_to_sql_select, async (error, results) => {
      console.log(results);

      if (results.length == 0 || !(await bcryptjs.compare(pass, results[0].user_pass))) {

        conexion.query(sql_to_compare_admin, values_to_sql_select, async (error, results_1) => {

          if (results_1.length == 0 || !(await bcryptjs.compare(pass, results_1[0].pass))) {

            res.render('login', {
              alert: true,
              alertTitle: "Error",
              alertMessage: "USUARIO y/o PASSWORD incorrectas",
              alertIcon: 'error',
              showConfirmButton: true,
              timer: 1500,
              ruta: 'login'
            });

          } else {
            req.session.loggedin = true;
            console.log("prueba_session " + req.session.loggedin)
            req.session.name = results_1[0].correo;
            console.log(req.session.id);
            res.render('login', {
              alert: true,
              alertTitle: "Conexión exitosa",
              alertMessage: "¡LOGIN CORRECTO!",
              alertIcon: 'success',
              showConfirmButton: false,
              timer: 1500,
              ruta: 'home_principal',
              id_user: results_1[0].id_admin
            });
            var_id_admin = results_1[0].id_admin;
            var_id_user = null;
            return var_id_admin
          }
        });


      } else {

        req.session.loggedin = true;
        console.log("prueba_session " + req.session.loggedin)
        req.session.name = results[0].Usuario;
        console.log(req.session.id);
        res.render('login', {
          alert: true,
          alertTitle: "Conexión exitosa",
          alertMessage: "¡LOGIN CORRECTO!",
          alertIcon: 'success',
          showConfirmButton: false,
          timer: 1500,
          ruta: 'home_principal',
          id_user: results[0].user_id
        });
        var_id_user = results[0].user_id;
        var_id_admin = null;
        return var_id_user;
      }
    })
  }
})

//12 mantener las sesiones
router.get('/menu_pri', (req, res) => {
  if (req.session.loggedin) {
    res.render('menu_pri', {
      login: true,
      name: req.session.name
    });
  } else {
    res.render('menu_pri', {
      login: false,
      name: 'Debe iniciar sesión',
    });
  }
  res.end();
});

//13 logout
router.get('/logout', (req, res) => {
  req.session.destroy(() => {
    res.redirect('/');
  })
})


export {
  router, var_id_user, var_id_admin
}