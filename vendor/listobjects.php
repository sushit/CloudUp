<?php
$config= require '..\app\config.php';
require '..\app\start.php';
require '..\vendor\front.php';
$objects = $s3->getIterator('ListObjects',[
	'Bucket' => $config['s3']['bucket']
	]);


?>
<!DOCTYPE html>
<html>
<head>
	<title>List of objects</title>
</head>
<body>
<p> Your Files are </p> 
<table>
	<thead>
		<tr>
			<th>File</th>
			<th>Download</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($objects as $object): ?>
		<tr>
			<td><?php echo $object['Key']; ?> </td>
			<td><a href="<?php echo $s3->getObjectUrl($config['s3']['bucket'], $object['Key']); ?>" download="<?php $object['Key'] ?>"> download </a></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

</body>
</html>