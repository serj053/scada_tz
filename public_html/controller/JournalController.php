<?php 


/*Добавляем код класса для работы с базой данных*/
require 'model/DB_connect.php';
/**
 * Класс записывает состояние установки в журнал*/
class JournalController{
        /**
         * Метод параметром которого является имя меотода , порверяет наличие
         *  данного метода в классе, если наличие подтверждается то происходит его выполнение*/
        public function action($action){

                $method = $action."Action";
                if(method_exists($this, $method)){
                        $this->$method();
                }			
        }
        
/**
 * заносим в базу данных параметры ВУ и обновляем страницу*/
    private function addAction(){

        /*Выбираем закладку в которой будут происходить изменения*/
                $choose = $_GET['id_table'];
        /*Соеденение с базой*/        
                $obj = new DB_connect;
        /*Заносим в базу данные , которые беруться из массива GET[] в моделе*/        
                $obj->insertMsg();
        /*Формируем имя метода для обработки данных для конкретной закладки журнала*/        
                $choose = $choose.'Action';			
                $this->$choose();		
                }	
/**
 * Удаление из базы выбранной записи(строки)*/
    private function delAction(){
      
        /*Имя вкладки из которой будет удалена запись*/
                $choose = $_GET['id_table'];
        /*Идентификатор по которму определяется удаляемая строка*/        
                $id = $_GET['id'];
        /*Соеденение с базой*/        
                $obj = new DB_connect;
        /*Удаление выбранной записи, */        
                $ms = $obj->deleteMsg($id);
        /*Фрмируе имя метода для конкретной вкладки*/        
                $choose = $choose.'Action';	
                $this->$choose();				
                }	

/**
 *При нажатии на вкладку "ВСЕ"  получаем из базы данные для журнала "ВСЕ"*/
        private function allAction(){

                $obj = new DB_connect;	
                $ms = $obj->selectAllMsg();
//var_dump($ms);                
                ob_start();
                require 'view/journal_all.php';
                ob_end_flush();
             }
                
/**
*При нажатии вкладки "ПРЕДУПРЕЖДЕНИЕ" получаем из базы данных предупреждения и вставляем в таблицу
*выбираем из базы по набору идентификаторов*/		
        private function alarmAction(){

            /*Массив идентификаторов в соответствии с которыми будут выбираться строки из
            базы (идентификаторы аварийных кнопок) */
            $arr_id= array('FAIL_FAN_BTN','FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
            $obj = new DB_connect;
            $ms = $obj->selectSomeMsg($arr_id);			
            ob_start();
            require'view/journal_alarm.php';
            ob_end_flush();
          }
		
/**
 * При нажатие вкладки ЖУРНАЛ ОПЕРАЦИЙ получаем из базы данных "ОПЕРАЦИИ" и вставляем в таблицу*/
        private function logAction(){

            $arr_id= array('FAIL_FAN_BTN','FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
            //$arr_id = 'operation';
            $obj = new DB_connect;
            $operation_ms = $obj->selectSomeMsg($arr_id,'operation');	
            ob_start();
            require'view/journal_log.php';
            ob_end_flush();
            }
		
/**
 * При нажатие вкладки "ЖУРНАЛ ОПЕРАЦИЙ" получаем из базы данных операции и вставляем в таблицу*/		
    private function eventAction(){

            $arr_id= array('FAIL_FAN_BTN','FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
            $obj = new DB_connect;
            $event_ms = $obj->selectSomeMsg($arr_id,'event');							
            ob_start();
            require'view/journal_event.php';
            ob_end_flush();
           }
           
 /**
  * Передаем в базу по "id" строки отмеченны как  checked и обновляем страницу  */
     private function checkedAction(){
           
            $choose = $_GET['id_table'];
            $obj = new DB_connect;	
            $obj->updateChecked();//вставляем в базу	
            $choose = $choose.'Action';		
            $this->$choose();
}


}
	
	
	
	
	