import express from 'express';
import { s3Upload, s3Upload_usdz } from '../scripts/s3_controller.js';
const app = express();
var router = express.Router();

import express_session from 'express-session';
const session = express_session;
router.use(session({
  secret: 'secret',
  resave: true,
  saveUninitialized: true
}));

router.use(express.urlencoded({ extended: false }));
router.use(express.json());

router.get('/form_save_models', (req, res) => {
  if (req.session.loggedin) {
    res.render('form_save_models_user')	
  } else {
    res.render('')				
  }
});



router.post('/upload-to-s3-glb', s3Upload);

router.post('/upload-to-s3-usdz', s3Upload_usdz);

export {
    router
}