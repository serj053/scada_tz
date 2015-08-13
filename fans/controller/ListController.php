<?php
	
	class ListController{
		
		public function action($action){
			
			$method = $action."Action";
			if(method_exists($this, $method)){
				$this->$method();
			}			
		}		
		
	/*загрузить список существующих установок*/
		function loadAction(){
		 $dbh = "mysql:host=localhost;dbname=fan_log";
		$dbh = new Pdo($dbh, 'root', '3141');
		$dbh->exec("SET NAMES utf8");
		/*вызвать метод из базы загружающий весь список установок с 
		соответсвующими параметрами*/
		$sq = 'select * from p1_value ';
       // $dbh = self::getDbh();
		$sth = $dbh->prepare($sq);
		$sth->execute(); 	
		return($sth->fetchAll(PDO::FETCH_ASSOC));		  
	}		
		/*загрузить страницу*/		
	}
	$list = new ListController;
	$arr = $list->loadAction();	
	require 'view/list.php';	

	

	
	