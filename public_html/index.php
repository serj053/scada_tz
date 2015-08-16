<?php
/*проверяем масив GET на наличие вызовов объект/метод
*Fan/default - загрузка страницы по умолчанию,
*Journal/(evetn, -alarm, -logg, -all) - загрузка соотвтетствующей страницы журнала
*/
//echo 'IN index';die;
	function __autoload($class){
                        $directories = array('controller/','model/');
                        foreach($directories as $directory){
                        $file = $directory.$class.'.php';
                                if(file_exists($file) && is_readable($file)){
                                        require $file;
                                        return;
                                }
                        }
		
	}

	$obj = isset($_GET['obj'])?$_GET['obj']:'List/load';
	$obj = explode('/',$obj);
//
//echo '$-GET["obj"]  - '.$_GET['OBJ'].'<br>';	
//echo '$-GET["obj"]  - '.$_GET['OBJ'].'<br>';	
	
	$act = $obj[1];
	$obj = $obj[0];
/*		
if($obj == 'Journal'){
	echo ' IN INDEX - $obj / $act = '.$obj.'/'.$act.'<br>';
	if(isset($_GET['str'])&& isset($_GET['fan_num'])){
	echo $_GET['str'].' - '.$_GET['fan_num'];
	}
}	
*/
//echo '$obj = '.$obj.'<br>';
//echo '$act = '.$act.'<br>';
	
	$obj = $obj."Controller";

	$obj = new $obj;
	$obj->action($act);
