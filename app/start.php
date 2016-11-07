<?php
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

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
$bucket= $_SESSION['bucket']; 
if ($_SESSION['stat']==1)
{
  try{
  $s3 -> createBucket(array(
   	         'Bucket' => $bucket,
             'LocationConstraint' => 'us-west-2'));
    }
    catch(S3Exception $e)
    {
       $e->getMessage();
    }
}
  

?>