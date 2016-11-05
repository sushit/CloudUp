<?php 
session_start();
return [
	's3'=> [
		'key' => 'AKIAJB6WYCSALOJFGRXQ',
		'secret' => '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',
		'bucket' => $_SESSION['bucket']
	]
]

?>