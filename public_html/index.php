<?php
/** 
 * index.php - точка входа, распределение по классам*/
/*Через ссылки в массив GET[] передаются пары значений Класс/метод.
 * Проверяем массив GET на наличие вызовов Класс/метод
*List/default - загрузка страницы-списка по умолчанию,
*Journal/(evetn, -alarm, -logg, -all) - загрузка соотвтетствующей страницы журнала
*/


/**
 * Автозагрузка классов*/
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
//print_r($_GET);
/**
 * Выделяем из элементов массива GET[] имена классов и методов*/
	$obj = isset($_GET['obj'])?$_GET['obj']:'List/load';       
	$obj = explode('/',$obj);

	$act = $obj[1];
	$obj = $obj[0];
        
//echo '<p style="position:absolute;left:20;top:510; width:100px; height:150px">act - '.$act.'<br>'.' obj = '.$obj.'<p>';        
        
/**
 * ВЫзов соответствующего Класс/метод*/
	$obj = $obj."Controller";

	$obj = new $obj;
	$obj->action($act);
        
 