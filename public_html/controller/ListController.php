<?php
/*Класс реализующий спиок вентиляторных устройств  и журнал оъединящий работу
*всех созданных устроств */

class ListController{

    /*Публичнй метод , получает в качестве параметра имя метода, проверяет наличие
     * этого метода в классе и в случае успеха вызывает его */
    public function action($action){
            $method = $action."Action";
            if(method_exists($this, $method)){
                    $this->$method();
            }			
    }		

    /*Метод по умолчанию загружает страницу со списком существующих
     *  установок и журналом всех событий*/
    function loadAction(){
        
        /*Создаем объект базы данных (если он не создан)*/
            $dbh = new DB_connect();
            $arr =$dbh->getList();//выбор параметров
            $items = $dbh->getListTable();//выбор сообщений
        /*определяем количество аварийных срабатываний*/
            $num=$dbh-> alarmRowsNumber();
         /*проверяем количество строк отмеченных как "checked"*/
            $checked_num = $dbh->isChecked(); 
         /*Сравниваем количество аварийных срабатываний с количеством
            *отмеченных чекбоксом строк, если они совпадают то зажечь зеленый колоколчик
            * в противном случае горит красный (передаем соотвтетсвующий класс элементу HTML */
                if($checked_num == $num ){
                    $bell_color = 'bell_green';
                }else {
                    $bell_color = 'bell_red';
                } 
    /*переносим в буфер и присваеваем перемнной часть страницы для загрузки*/
            ob_start();
            require'view/list_table.php';
            $table = ob_get_contents();
            ob_end_clean();
    /*вывод сстраницы*/
                    require 'view/list.php';
    }

    /*При нажатии на вкладку "ВСЕ"  получам из базы журнал всех событий и выодим на страницу*/
    private function allAction(){
                
            $dbh = new DB_connect;
        /*получаем список событий из базы*/
            $items = $dbh->getListTable();
        /*определяем количество аварийных срабатываний*/
            $num=$dbh-> alarmRowsNumber();
        /*проверяем количество строк отмеченных как "checked"*/
            $checked_num = $dbh->isChecked(); 
         /*Сравниваем количество аварийных срабатываний с количеством
            *отмеченных чекбоксом строк, если они совпадают то зажечь зеленый колоколчик
            * в противном случае горит красный (передаем соотвтетсвующий класс элементу HTML */   
                if($checked_num == $num ){
                    $bell_color = 'bell_green';
                }else {
                    $bell_color = 'bell_red';
                }
         /*переносим в буфер и присваеваем перемннной часть страницы для загрузки*/       
            ob_start();
            require 'view/list_table.php';
            ob_end_flush();
    }

  /*нажатие вкладки ПРЕДУПРЕЖДЕНИЕ
*получаем из базы данных список аварийных событий и вставляем в таблицу
*выбираем из базы по  идентификаторам*/  
    private function alarmAction(){

        /*массив идентитфткаторов аварийныхх закладок
         *  по которым будут отбираться записи*/
            $arr_id= array('FAIL_FAN_BTN','FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
            $dbh = new DB_connect;
        /*выбираем записи по идентификаторам принадлежащим аварийным кнопкам*/    
            $items = $dbh->selectSomeList($arr_id);
            /**определяем количество аварийных срабатываний*/
            $num=$dbh-> alarmRowsNumber();
        /**проверяем количество строк отмеченных как "checked"*/
            $checked_num = $dbh->isChecked(); 
         /*Сравниваем количество аварийных срабатываний с количеством
            *отмеченных чекбоксом строк, если они совпадают то зажечь зеленый колоколчик
            * в противном случае горит красный (передаем соотвтетсвующий класс элементу HTML */       
                if($checked_num == $num ){
                    $bell_color = 'bell_green';
                }else {
                    $bell_color = 'bell_red';
                }
                
                       ob_start();
        /*а теперь выводим саму таблицу*/                
                         require'view/list_table.php';
                        //$journal = ob_get_contents();
                ob_end_flush();
                }


/*нажатие вкладки ЖУРНАЛ ОПЕРАЦИЙ
получаем из базы данных "ОПЕРАЦИИ" и вставляем в таблицу*/
    private function logAction(){
        
        /*масив идентификаторов аварийных событий, будут выбраны все записи кроме  них*/
                $arr_id= array('FAIL_FAN_BTN','FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
        /*соеденение с базой*/
                $dbh = new DB_connect;
        /*выбиракм записи все кроме записей принадлежащим аварийным кнопкам
        но прирнадлежащим кнопке "ЖУРНАЛ ОПЕРАЦИЙ" */        
                $items = $dbh->selectSomeList($arr_id,'operation');
                $flag = 'journal';
            /*определяем количество аварийных срабатываний*/
                 $num=$dbh-> alarmRowsNumber();
            /*проверяем количество строк отмеченных как "checked"*/
                $checked_num = $dbh->isChecked(); 
            /*Сравниваем количество аварийных срабатываний с количеством
            *отмеченных чекбоксом строк, если они совпадают то зажечь зеленый колоколчик
            * в противном случае горит красный (передаем соотвтетсвующий класс элементу HTML */         
                if($checked_num == $num ){
                        $bell_color = 'bell_green';
                    }else {
                        $bell_color = 'bell_red';
                    }
                
                        ob_start();
                         require'view/list_table.php';
                ob_end_flush();
                }

/*нажатие вкладки СОБЫТИЯ"
получаем из базы данных список "СОБЫТИЯ" и вставляем в таблицу*/
    private function eventAction(){
        
        /*масив идентификаторов аварийных событий, будут выбраны все записи кроме  них*/ 
        $arr_id= array('FAIL_FAN_BTN','FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
                $dbh = new DB_connect;
          /*выбиракм записи аме кроме записей принадлежащим аварийным кнопкам
        но прирнадлежащим кнопке "EVENT" */                
                $items = $dbh->selectSomeList($arr_id,'event');
                $flag = 'event';
                /*проверяем количество строк отмеченных как "checked"*/
                    $checked_num = $dbh->isChecked();
                    if($checked_num == 0){
                        $bell_color = 'bell_red';
                    }else{
                        $bell_color = 'bell_green';
                    }
                
                        ob_start();
                         require'view/list_table.php';
                ob_end_flush();
                }
                
/**/                
    private function checkedAction(){
                    
        /*получаем из GET[] имя закладки с которой проводятся текущие действия*/ 
                $table_name = $_GET['table_name'];
        /*Соеденение с базой*/        
                $dbh = new DB_connect();//
        /*Обновляем список отмеченных сообщений*/        
                $dbh->updateChecked();//

        /*Формируем имя метода для загрузки данных*/                    
                $choose = $table_name.'Action';         
    /*Вызываем сформированный метод и уже в методе вызывется обновленный 
     * список отмеченных сообщенией*/                    
                $this->$choose();                    

            }

    }





