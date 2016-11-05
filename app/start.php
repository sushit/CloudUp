<?php

use Aws\S3\S3Client;

require '..\aws-autoloader.php';
$config = require('..\app\config.php');
//s3 client
$s3= S3Client::factory([
	'region' => 'us-west-2',
	'version' => 'latest',
	'credentials' => [
        'key'    => $config['s3']['key'],
        'secret' => $config['s3']['secret'],],
    'scheme' => 'http'
	]);
if ($_SESSION['stat']==1)
{
    $para= $_SESSION['bucket'];
 function create_bucket($para) {
            $result = $client->createBucket(array(
   	'Bucket'             => $_SESSION['bucket'],
    'LocationConstraint' => 'us-west-2',));
         }
}
?>