<?php
/*роутер управляет распределением по GET запросам*/

	//поиск класса в каталогах
	function autoload_controller($class){
		$file='controller/'.$class.'.php';
		if(is_readable($file)){
            require 'controller/'.$class.'.php';
	}
        }
	spl_autoload_register('autoload_controller');
	
if(isset($_GET['panel'])){
	$str = $_GET['panel'];
	$arr = explode('/', $str);
	$ctrlClass = $arr[0].'Controller';
        $action = $arr[1];
        $ctrl = new $ctrlClass;
        $ctrl->action($action);   
}else{
    
header('Location:view/main.php');
    
}
echo'Control';


