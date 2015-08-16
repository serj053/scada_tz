<?php 
/*запоминает состояние установки и вощвращвет последние при загрузке*/	
	class FanController{
	
		public function action($action){
			$method = $action."Action";
			if(method_exists($this, $method)){
				$this->$method();
			}			
		}
		private function lastAction(){
		/*массив значений который будет заполняться на странице*/
			$val_arr = Array();
			$dns = new DB_connect;
			$vl = $dns->selectAllValue();			
		return $vl;	
			//require 'view/fan_general.php';
		}
		
		private function defaultAction(){
//echo'In defaultAtion()';			
	/*При загрузке страницы Загружаем последние значение из базы*/		
		$l_v = $this->lastAction();
		foreach($l_v as $l_val){
			$fan_num = isset($l_val['fan_number'])?$l_val['fan_number']:'';
			$VEL_IND = isset($l_val['VEL_IND'])?$l_val['VEL_IND']:'';	
			$SET_IND = isset($l_val['SET_IND'])?$l_val['SET_IND']:'';
			$TE3 = isset($l_val['TE3'])?$l_val['TE3']:'';
			$TE2 = isset($l_val['TE2'])?$l_val['TE2']:'';
			$TE1 = isset($l_val['TE1'])?$l_val['TE1']:'';
			$INC_NUM = isset($l_val['INC_NUM'])?$l_val['INC_NUM']:'';
			$WATERBACK_IND = isset($l_val['WATERBACK_IND'])?$l_val['WATERBACK_IND']:'';
		}
	/*Из базы данных загружаем сообщения в журнал*/
			$dns = new DB_connect;
			$ms = $dns->selectAllMsg();			
			ob_start();
			 require'view/journal_all.php';
			$journal = ob_get_contents();
			ob_get_clean();
		$id_content = $_GET['id_content']	;
			require 'view/fan_general.php';
		}
/* ВЫБРАТЬ и вставить конкретное значение в базу*/			
		private function valueAction(){
//echo 'In valueAction()';	die;				
			$dns = new DB_connect;
			$dns->insertMsg();
	/*получение канкретного значения из базы данных*/						
			$vl = $dns->selectValue();
//print_r($vl);						
		return  $vl;	
			//require 'view/fan_general.php';
		}
		
		
	}

/*

$fan_sp = $last_val['VEL_IND'];
			$tmp =$last_val['SET_IND'];


*/
