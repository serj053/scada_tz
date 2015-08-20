<?php

class ListController{

    public function action($action){
//echo'IN actionControl() - '.$action; //    die;   
            $method = $action."Action";
            if(method_exists($this, $method)){
                    $this->$method();
            }			
    }		

    /*загрузить список существующих установок*/
    function loadAction(){
            $dbh = new DB_connect();
            $arr =$dbh->getList();

            $items = $dbh->getListTable();	
            ob_start();
            require'view/list_table.php';
            $table = ob_get_contents();
            ob_end_clean();

                    require 'view/list.php';
    }

            private function allAction(){
/*получаем из базы данных ВСЕ данные и вставляем в таблицу*/
//echo 'In allaction()';
            $dbh = new DB_connect;	
            $items = $dbh->getListTable();			
            ob_start();
            require 'view/list_table.php';
            ob_end_flush();
    }

/*4*/	private function alarmAction(){
/*нажатие вкладки ПРЕДУПРЕЖДЕНИЕ
получаем из базы данных "ПРЕДУПРЕЖДЕНИЯ" и вставляем в таблицу
выбираем из базы по набору идентификаторов*/

                $arr_id= array('FAIL_FAN_BTN','FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
                $dbh = new DB_connect;
                $items = $dbh->selectSomeList($arr_id);	
//var_dump($ms);		
                        ob_start();
                         require'view/list_table.php';
                        //$journal = ob_get_contents();
                ob_end_flush();
                }



/*5*/		private function logAction(){
/*нажатие вкладки ЖУРНАЛ ОПЕРАЦИЙ
получаем из базы данных "ОПЕРАЦИИ" и вставляем в таблицу*/
                $arr_id= array('FAIL_FAN_BTN','FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
                //$arr_id = 'operation';
                $dbh = new DB_connect;
                $items = $dbh->selectSomeList($arr_id,'operation');	
                        ob_start();
                         require'view/list_table.php';
                ob_end_flush();
                }


/*6*/	private function eventAction(){
/*нажатие вкладки ЖУРНАЛ ОПЕРАЦИЙ
получаем из базы данных "ОПЕРАЦИИ" и вставляем в таблицу*/
        $arr_id= array('FAIL_FAN_BTN','FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
                $dbh = new DB_connect;
                $items = $dbh->selectSomeList($arr_id,'event');							
                        ob_start();
                         require'view/list_table.php';
                ob_end_flush();
                }
                
                
                private function checkedAction(){
                    
                  // echo'In checkedAction()';
                  // print_r($_GET); 
 /*получаем из GET[] имя закладки с которой проводятся текущие действия*/ 
                    $table_name = $_GET['table_name'];
                    $dbh = new DB_connect();//
                    $dbh->updateChecked();//
/*Формируем имя метода для загрузки данных*/                    
                    $choose = $table_name.'Action';
       //  echo '$choose - '.$choose;           
/*Вызываем сформированный метод*/                    
                    $this->$choose();                    
                   
                }

        }





