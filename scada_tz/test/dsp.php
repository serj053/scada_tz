<?php 
	function __autoload($class){
		require ($class.'.php');		
	}

	$cls = isset($_GET['cls'])?$_GET['cla']:'smth';
	$mth = isset($_GET['mth'])?$_GET['mth']:'mth';
	
	$smthContr = $cls.'Contr';
	$cls = new $smthContr;
	$cls->action($mth);
	
	