<?php 
/*записывает состояние установки в журнал*/
require 'model/DB_connect.php';

class JournalController{
		
		public function action($action){
			
			$method = $action."Action";
			if(method_exists($this, $method)){
				$this->$method();
			}			
		}

/*1*/		private function addAction(){
/*заносим в базу данных данные и действия */
//echo 'In addAction()';
		$choose = $_GET['id_table'];
		$obj = new DB_connect;	
		$obj->insertMsg();//вставляем в базу	
		$choose = $choose.'Action';	
//echo 'choose = '.$choose;		die;		
		$this->$choose();		
		}	
		
/*2*/			private function delAction(){
/*удаляем из базы данных данные */
//echo 'in GET[id] - '.$_GET['id'];
		$choose = $_GET['id_table'];//активная вкладка
		$id = $_GET['id'];	
		$obj = new DB_connect;		
		$ms = $obj->deleteMsg($id);		
		$choose = $choose.'Action';
//echo 'choose = '.$choose;		die;		
		$this->$choose();				
		}	
/*3*/		
		private function allAction(){
/*получаем из базы данных ВСЕ данные и вставляем в таблицу*/
//echo 'In allaction()';
			$obj = new DB_connect;	
			$ms = $obj->selectAllMsg();	
//	var_dump($ms);		
			ob_start();
			require 'view/journal_all.php';
			ob_end_flush();
		}
		
/*4*/	private function alarmAction(){
/*нажатие вкладки ПРЕДУПРЕЖДЕНИЕ
получаем из базы данных "ПРЕДУПРЕЖДЕНИЯ" и вставляем в таблицу
выбираем из базы по набору идентификаторов*/

		$arr_id= array('FAIL_FAN_BTN','FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
		$obj = new DB_connect;
		$ms = $obj->selectSomeMsg($arr_id);	
//var_dump($ms);		
			ob_start();
			 require'view/journal_all.php';
			//$journal = ob_get_contents();
		ob_end_flush();
		}
		
		
		
/*5*/		private function logAction(){
/*нажатие вкладки ЖУРНАЛ ОПЕРАЦИЙ
получаем из базы данных "ОПЕРАЦИИ" и вставляем в таблицу*/
		$arr_id= array('FAIL_FAN_BTN','FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
		//$arr_id = 'operation';
		$obj = new DB_connect;
		$operation_ms = $obj->selectSomeMsg($arr_id,'operation');	
			ob_start();
			 require'view/journal_log.php';
		ob_end_flush();
		}
		
		
/*6*/		private function eventAction(){
/*нажатие вкладки ЖУРНАЛ ОПЕРАЦИЙ
получаем из базы данных "ОПЕРАЦИИ" и вставляем в таблицу*/
	$arr_id= array('FAIL_FAN_BTN','FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
		$obj = new DB_connect;
		$event_ms = $obj->selectSomeMsg($arr_id,'event');							
			ob_start();
			 require'view/journal_event.php';
		ob_end_flush();
		}
		
		private function checkedAction(){
/*передаем в таблицу по "id" строки отмеченны как  checked*/
	/*заносим в базу данных данные действие */
//echo 'In selecktAction()';
		$choose = $_GET['id_table'];
		$obj = new DB_connect;	
		$obj->updateMsg();//вставляем в базу	
		$choose = $choose.'Action';	
//echo 'choose = '.$choose;		die;		
		$this->$choose();
	}
		
		
}
	
	
	
	
	