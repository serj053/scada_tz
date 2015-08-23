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
            /*проверяем количество строк отмеченных как "checked"*/
                    $checked_num = $dbh->isChecked();
                    if($checked_num == 0){
                        $bell_color = 'bell_green';
                    }else{
                        $bell_color = 'bell_red';
                    }
            
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
            /*получаем массив "items"  и базы*/
            $items = $dbh->getListTable();
            /*проверяем количество строк отмеченных как "checked"*/
                    $checked_num = $dbh->isChecked();
                    if($checked_num == 0){
                        $bell_color = 'bell_green';
                    }else{
                        $bell_color = 'bell_red';
                    }
            
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
                /*проверяем количество строк отмеченных как "checked"*/
                    $checked_num = $dbh->isChecked();
                    if($checked_num == 0){
                        $bell_color = 'bell_green';
                    }else{
                        $bell_color = 'bell_red';
                    }
                
//var_dump($ms);
        /*выводим обновляемую часть страницы*/            
         /*               ob_start();
        если выводится строка аварийной кнопки то добавить поле чекбокса   
                        require 'view/for_checked.php';
                        $if_checked = ob_get_contents();
                        ob_clean();
                        */
                        ob_start();
        /*а теперь выводим саму таблицу*/                
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
                /*проверяем количество строк отмеченных как "checked"*/
                    $checked_num = $dbh->isChecked();
                    if($checked_num == 0){
                        $bell_color = 'bell_green';
                    }else{
                        $bell_color = 'bell_red';
                    }
                
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
                /*проверяем количество строк отмеченных как "checked"*/
                    $checked_num = $dbh->isChecked();
                    if($checked_num == 0){
                        $bell_color = 'bell_green';
                    }else{
                        $bell_color = 'bell_red';
                    }
                
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

     // echo'$checked_num - '.$checked_num;            
    //  echo'$bell_color - '.$bell_color;           
/*Формируем имя метода для загрузки данных*/                    
                    $choose = $table_name.'Action';
       //  echo '$choose - '.$choose;           
/*Вызываем сформированный метод*/                    
                    $this->$choose();                    
                   
                }

        }





