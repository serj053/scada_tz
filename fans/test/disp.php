<?php
	function __autoload($class){
		require $class.'.php';
	}
	$obj = isset($_GET['obj'])?$_GET['obj']:'Fan';
	$action = isset($_GET['act'])?$_GET['act']:'Fan';
	
	$ctrClass = $obj.'Controller';
	$ctrl = new $ctrClass;
	$ctrl->action($action);


?>