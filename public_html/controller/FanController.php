<?php 
/**
 * запоминает состояние установки и возвращвет последнее состояние при загрузке*/	
    class FanController{
        
     /**
      * Метод проверяющий наличие вызываемого метода и выполнение при его  наличии*/   
        public function action($action){
                    $method = $action."Action";
                    if(method_exists($this, $method)){
                            $this->$method();
                    }			
            }
  
/**
 * Получаем из базы данных все величины характеризущие последнее состояние установки*/         
        private function lastAction(){
          
            $val_arr = Array();
            $dns = new DB_connect;
            $vl = $dns->selectAllValue();			
            return $vl;	
        }

/**
 * При загрузке страницы Загружаем последние текущие значение из базы*/       
        private function defaultAction(){		
  		
            $l_v = $this->lastAction();
/**
 * передаем значения переменным на странице из массива полученного из базы*/    
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
         /**Из базы данных загружаем все записи в журнал в журнал*/
                    $dns = new DB_connect;
                    $ms = $dns->selectAllMsg();
        /**открываем буфер*/            
                    ob_start();
         /**подключаем код описывающий журнал*/           
                     require'view/journal_all.php';
        /**передаем из буфера данные в переменную*/             
                    $journal = ob_get_contents();
        /**закрываем и очищаем буфер*/            
                    ob_get_clean();
                    $id_content = $_GET['id_content']	;
                    require 'view/fan_general.php';
            }
            
            
/** Вставляем из массива GET[] величины в базу и передаем их обратно в массив,
 * который в дальнейшем используется для обновления страницы */			
        private function valueAction(){
                $dns = new DB_connect;
                $dns->insertMsg();
/**получение канкретного значения из базы данных*/						
                $vl = $dns->selectValue();
        //      require 'view/fan_general.php';
                return  $vl;	;
        }


    }

