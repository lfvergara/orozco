<?php

 if(isset($_POST['gdrpset']))
 {
	 $path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
	require($path.'wp-load.php');
	 $gdrpname="TEKGDRP";
	 setcookie($gdrpname,'created',time()+(86400*3650),'/');
 }
	
	?>