import formidable from 'formidable';
import { uploadFileTos3 } from './s3_Service.js';
import { insert_query_to_myslq } from './guardar_mysql_aws.js';
import { select_and_update } from './guardar_mysql_aws.js';

//subida glb =>
async function s3Upload(req, res) {
    const formData = await readFormData(req);
    try {
        await uploadFileTos3(formData.file, 'web.ar.allbreaker');
        await insert_query_to_myslq(formData.file)
        res.send('uploaded///subido');
    } catch (ex) {
        console.log(ex);
        res.send('Error');
    }
}
//subida usdz =>
async function s3Upload_usdz(req, res) {
    const formData = await readFormData(req);
    try {
        await uploadFileTos3(formData.file, 'web.ar.allbreaker');
        await select_and_update(formData.file)
        res.send('uploded///subido');
    } catch (ex) {
        console.log(ex);
        res.send('Error');
    }
}
//lectura de archivo del formulario
async function readFormData(req) {
    return new Promise(resolve => {
        const dataObj = {};
        var form = new formidable.IncomingForm();
        form.parse(req);

        

        form.on('file', (name, file) => {
            dataObj.name = name;
            dataObj.file = file;
           
        });

        form.on('end', () => {
            resolve(dataObj);
        });
       
       
    });
}

export  {
    s3Upload,
    s3Upload_usdz,
    readFormData
}

// base https://github.com/voidVic/AWS-S3-NodeJS
//https://www.youtube.com/watch?v=Za6jWDigqL4&t=657s
