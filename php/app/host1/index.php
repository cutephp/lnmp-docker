<?php 
	$redis = new Redis();
	$redis->connect('redis',6379);
	echo $redis->ping();
 ?>