<?php
	define("baseaddress", "");
	try
	{
		require_once 'core/model.php';
		require_once 'core/view.php';
		require_once 'core/controller.php';
		require_once 'core/route.php';
		Route::start();
	}
	catch (Exception $e) 
	{
   	echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
?>