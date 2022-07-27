<?php 
	/*echo phpinfo();

	echo phpversion();*/

	
	
	require 'C:/Windows/System32/vendor/autoload.php';

	use Aws\S3\S3Client;
	use Aws\S3\Exception\S3Exception;

	$file_name = "prueba_subir_Archivo";

	$bucket = 'form_guardar_modelos';
	$keyname = $file_name;
                        
	$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1'	
	]);

	try {
    // Upload data.
    $result = $s3->putObject([
        'Bucket' => $bucket,
        'Key'    => $keyname,
        'Body'   => 'Hello, world!',
        'ACL'    => 'public-read'
    ]);

    // Print the URL to the object.
    echo $result['ObjectURL'] . PHP_EOL;
	} catch (S3Exception $e) {
    echo $e->getMessage() . PHP_EOL;
	}
?>