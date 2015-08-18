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
            $dbh = new DB_connect();
            $dbh = $dbh->getDbh();
            $sq = 'select * from p1_value ';
            $sth = $dbh->prepare($sq);
            $sth->execute();
            $arr = $sth->fetchAll(PDO::FETCH_ASSOC);

             $sq = 'select * from p1_messages ';
            $sth = $dbh->prepare($sq);
            $sth->execute();
            $items = $sth->fetchAll(PDO::FETCH_ASSOC);
            ob_start();
            require'view/list_table.php';
            $table = ob_get_contents();
            ob_end_flush();

                    require 'view/list.php';
    }

            private function allAction(){
/*получаем из базы данных ВСЕ данные и вставляем в таблицу*/
//echo 'In allaction()';
            $obj = new DB_connect;	
            $items = $obj->selectAllMsg();	
//	var_dump($ms);		
            ob_start();
            require 'view/list.php';
            ob_end_flush();
    }

/*4*/	private function alarmAction(){
/*нажатие вкладки ПРЕДУПРЕЖДЕНИЕ
получаем из базы данных "ПРЕДУПРЕЖДЕНИЯ" и вставляем в таблицу
выбираем из базы по набору идентификаторов*/

                $arr_id= array('FAIL_FAN_BTN','FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
                $obj = new DB_connect;
                $items = $obj->selectSomeMsg($arr_id);	
//var_dump($ms);		
                        ob_start();
                         require'view/list.php';
                        //$journal = ob_get_contents();
                ob_end_flush();
                }



/*5*/		private function logAction(){
/*нажатие вкладки ЖУРНАЛ ОПЕРАЦИЙ
получаем из базы данных "ОПЕРАЦИИ" и вставляем в таблицу*/
                $arr_id= array('FAIL_FAN_BTN','FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
                //$arr_id = 'operation';
                $obj = new DB_connect;
                $items = $obj->selectSomeMsg($arr_id,'operation');	
                        ob_start();
                         require'view/list.php';
                ob_end_flush();
                }


/*6*/		private function eventAction(){
/*нажатие вкладки ЖУРНАЛ ОПЕРАЦИЙ
получаем из базы данных "ОПЕРАЦИИ" и вставляем в таблицу*/
        $arr_id= array('FAIL_FAN_BTN','FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
                $obj = new DB_connect;
                $items = $obj->selectSomeMsg($arr_id,'event');							
                        ob_start();
                         require'view/list.php';
                ob_end_flush();
                }


        }





