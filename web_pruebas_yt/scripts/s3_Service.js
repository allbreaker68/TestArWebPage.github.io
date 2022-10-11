import AWS from 'aws-sdk';
import fs from 'fs';
import awsCreds from './config.js';
import dotenv from 'dotenv';
dotenv.config()


//accedemos con credenciales de s3
function createS3Instance() {
  const s3 = new AWS.S3({
    credentials: {
      accessKeyId: AWS.config.credentials.accessKeyId,
      secretAccessKey: AWS.config.credentials.secretAccessKey

    },
    region: 'us-east-1'
  });
  return s3;
}
//se sube todo al bucket de s3
async function uploadFileTos3(fileObj, bucketName) {
  console.log({ fileObj });

  const s3 = createS3Instance();
  const fileStream = fs.createReadStream(fileObj.filepath);
  const params = {
    Body: fileStream,
    Bucket: bucketName,
    Key: fileObj.originalFilename
  }

  const uploadData = await s3.upload(params).promise();
  return uploadData;
}
//aqui termina el tuto

/////// 
function deleting_object(key) {
  const s3 = createS3Instance();
  var params = { Bucket: 'web.ar.allbreaker', Key: key };
  s3.deleteObject(params, function (err, data) {
    if (err){
      console.log(err, err.stack);  // error
    } 
    else {
      console.log();
    }                 // deleted
  });
}






export {
  uploadFileTos3,
  deleting_object
}

