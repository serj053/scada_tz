<?php
/*роутер управляет распределением по GET запросам*/

	//поиск класса в каталогах
	function autoload_controller($class){
	/*добавляем в мссив те каталоги в которых будет искаться файл*/	
	    $directories = array('controller/');
		foreach($directories as $directory){
			$file=$directory.$class.'.php';
			if(file_exists($file)){				
				if(is_readable($file)){
					require $file;
				}
			}
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


