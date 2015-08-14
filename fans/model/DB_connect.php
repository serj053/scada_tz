<?php 
	
	class DB_connect{
		
    static private $dbh = null;
 
    static function getDbh(){
        if(self::$dbh == null) {
            $dbh = "mysql:host=localhost;dbname=fan_log";
			$dbh =	new Pdo($dbh, 'root', '3141');
			$dbh->exec("SET NAMES utf8");
            return $dbh;
        }else{
            return self::$dbh;
        }
    }
/*вставляем любое сообщение в базу данных*/	
	function insertMsg(){
//echo'In insertMdg()';		
	/*вставляем данные в две таблицы в зависимсти от назначения
	данные для журнала в таблицу P1_messages, данные величин таких какаяскорость вентилятора температура уставки и прочих в p1_value*/
	 $dbh = self::getDbh();
		if(isset($_GET['fan_num']) && isset($_GET['what']) && isset($_GET['str'])){
		$fan_num = $_GET['fan_num'];
		$id_str = $_GET['what'];
		$ms_str	= $_GET['str'];
        $sq = 'insert into p1_messages(elem_id,fan_number,message, status)
				values("'.$id_str.'","'.$fan_num.'","'.$ms_str.'","uncheked")';	      
        $sth = $dbh->prepare($sq);
       $sth->execute();
	   }
	   if(isset($_GET['fan_val'])){//скорость вращения	
		    $fan_val = $_GET['fan_val'];	
		   $fan_num = $_GET['fan_num'];			     
		   $row_el = 'SELECT fan_number FROM p1_value where fan_number="'.$fan_num.'"';
		   $sth = $dbh->query($row_el);
		   $elem = $sth->fetch(PDO::FETCH_ASSOC);
				if($elem != false){
			$sq_up = 'UPDATE p1_value set VEL_IND ='.$fan_val.' where fan_number ="'.$fan_num.'"';	
					$sth = $dbh->prepare($sq_up);
					$sth->execute();	
				}else{
		/*берем из GET[] номер установки и добавляем или перезаписываем*/
			if(isset($_GET['fan_num'])){
			$fan_num = $_GET['fan_num'];
			}		
			   $sq = 'insert into p1_value(fan_number,VEL_IND) values("'.$fan_num.'","'.$fan_val.'")';
			   $sth = $dbh->prepare($sq);
			   $sth->execute();
				}
	   }
	   if(isset($_GET['tmp_val'])){//уставка
		   $tmp_val = $_GET['tmp_val'];
		   $fan_num = $_GET['fan_num'];
		   $row_el = 'SELECT fan_number FROM p1_value where fan_number="'.$fan_num.'"';
		   $sth = $dbh->query($row_el);
		   $elem = $sth->fetch(PDO::FETCH_ASSOC);
				if($elem != false){
					$sq_up = 'UPDATE p1_value set SET_IND = '.$tmp_val.' where fan_number ="'.$fan_num.'"';		
					$sth = $dbh->prepare($sq_up);
					$sth->execute();	
				}else{
			if(isset($_GET['fan_num'])){
			$fan_num = $_GET['fan_num'];
			}		
			   $sq = 'insert into p1_value(fan_number,SET_IND) values("'.$fan_num.'","'.$tmp_val.'")';
			   $sth = $dbh->prepare($sq);
			   $sth->execute();
				}
	   }	
	   if(isset($_GET['TE3'])){// в канале
		   $te3 = $_GET['TE3'];	   
		   $fan_num = $_GET['fan_num'];
		   $row_el = 'SELECT fan_number FROM p1_value where fan_number="'.$fan_num.'"';
		   $sth = $dbh->query($row_el);
		   $elem = $sth->fetch(PDO::FETCH_ASSOC);
				if($elem != false){
					$sq_up = 'UPDATE p1_value set TE3 = '.$te3.' where fan_number ="'.$fan_num.'"';	
					$sth = $dbh->prepare($sq_up);
					$sth->execute();	
				}else{
			if(isset($_GET['fan_num'])){
			$fan_num = $_GET['fan_num'];
			}			
			   $sq = 'insert into p1_value(fan_number,TE3) values("'.$fan_num.'","'.$te3.'")';
			   $sth = $dbh->prepare($sq);
			   $sth->execute();
				}
	   }
	    if(isset($_GET['TE2'])){
		   $te2 = $_GET['TE2'];	   
		   $fan_num = $_GET['fan_num'];
			$row_el = 'SELECT fan_number FROM p1_value where fan_number="'.$fan_num.'"';
		   $sth = $dbh->query($row_el);
		   $elem = $sth->fetch(PDO::FETCH_ASSOC);
				if($elem != false){
					$sq_up = 'UPDATE p1_value set TE2 = '.$te2.' where fan_number ="'.$fan_num.'"';	
					$sth = $dbh->prepare($sq_up);
					$sth->execute();	
				}else{
			if(isset($_GET['fan_num'])){
			$fan_num = $_GET['fan_num'];
			}				
			   $sq = 'insert into p1_value(fan_numberTE2) values("'.$fan_num.'","'.$te2.'")';
			   $sth = $dbh->prepare($sq);
			   $sth->execute();
				}
	   }	
	   if(isset($_GET['TE1'])){
		   $te1 = $_GET['TE1'];	   
		   $fan_num = $_GET['fan_num'];
		   $row_el = 'SELECT fan_number FROM p1_value where fan_number="'.$fan_num.'"';
		   $sth = $dbh->query($row_el);
		   $elem = $sth->fetch(PDO::FETCH_ASSOC);
				if($elem != false){
					$sq_up = 'UPDATE p1_value set TE1 = '.$te1.' where fan_number ="'.$fan_num.'"';		
					$sth = $dbh->prepare($sq_up);
					$sth->execute();	
				}else{
			if(isset($_GET['fan_num'])){
			$fan_num = $_GET['fan_num'];
			}				
			   $sq = 'insert into p1_value(fan_numberTE1) values("'.$fan_num.'","'.$te1.'")';
			   $sth = $dbh->prepare($sq);
			   $sth->execute();
				}
	   }
		if(isset($_GET['INC_NUM'])){
		   $inc_num = $_GET['INC_NUM'];	   
		   $fan_num = $_GET['fan_num'];
			$row_el = 'SELECT fan_number FROM p1_value where fan_number="'.$fan_num.'"';
		   $sth = $dbh->query($row_el);
		   $elem = $sth->fetch(PDO::FETCH_ASSOC);
				if($elem != false){
					$sq_up = 'UPDATE p1_value set INC_NUM = '.$inc_num.' where fan_number ="'.$fan_num.'"';	
					$sth = $dbh->prepare($sq_up);
					$sth->execute();	
				}else{
			if(isset($_GET['fan_num'])){
			$fan_num = $_GET['fan_num'];
			}				
			   $sq = 'insert into p1_value(fan_number,INC_NUM) values("'.$fan_num.'","'.$inc_num.'")';
			   $sth = $dbh->prepare($sq);
			   $sth->execute();
				}
		}
		if(isset($_GET['WATERBACK_IND'])){
		   $wat = $_GET['WATERBACK_IND'];	   
		   $fan_num = $_GET['fan_num'];
			$row_el = 'SELECT fan_number FROM p1_value where fan_number="'.$fan_num.'"';
		   $sth = $dbh->query($row_el);
		   $elem = $sth->fetch(PDO::FETCH_ASSOC);
				if($elem != false){
					$sq_up = 'UPDATE p1_value set WATERBACK_IND = '.$wat.' where fan_number ="'.$fan_num.'"';		
					$sth = $dbh->prepare($sq_up);
					$sth->execute();	
				}else{
			if(isset($_GET['fan_num'])){
			$fan_num = $_GET['fan_num'];
			}				
			   $sq = 'insert into p1_value(fan_number,WATERBACK_IND) values("'.$fan_num.'","'.$wat.'")';
			   $sth = $dbh->prepare($sq);
			   $sth->execute();
				}
		}
	   
//var_dump($sth);   
     // return($sth->fetchAll(PDO::FETCH_ASSOC));
    }
/*выводим все записи из таблицы P1_messages базы данных_*/	
	function selectAllValue(){
		$fan_num = $_GET['fan_num'];
	    $sq = 'select * from p1_value where fan_number="'.$fan_num.'"';
        $dbh = self::getDbh();
		$sth = $dbh->prepare($sq);
		$sth->execute();
	//var_dump($sth); SELECT * FROM table ORDER BY id DESC LIMIT 1  	
		return($sth->fetchAll(PDO::FETCH_ASSOC));		  
	}
	

	/*выводим все записи ПО КРИТЕРИЮ какая вкладка из базы данных"FAIL_FAN_BTN","FAIL_FREEZ_BTN","FAIL_VALVE_BTN","RESET"  */	
	function selectSomeMsg($arr, $flag=''){
		$fan = $_GET['fan_num'];	
		if($flag =='operation' || $flag == 'event'){
		$arr = implode('","',$arr);	
		$sq = 'select * from p1_messages where elem_id not in("'.$arr.'") and fan_number="'.$fan.'"';
		}else{	
		$arr = implode('","',$arr);		
	    $sq = 'select * from p1_messages where elem_id in("'.$arr.'") and fan_number="'.$fan.'"';
		}
        $dbh = self::getDbh();
		$sth = $dbh->prepare($sq);
		$sth->execute();
//	var_dump($sth);   
		return($sth->fetchAll(PDO::FETCH_ASSOC));
		  
	}
	
	/*выводим данные из таблицы p1_value*/
	function selectAllMsg(){
//echo 'IN selectAllMessage() ';
		$fan = $_GET['fan_num'];	
	    $sq = 'select * from P1_messages where fan_number="'.$fan.'"';
        $dbh = self::getDbh();
		$sth = $dbh->prepare($sq);
		$sth->execute();
//		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
//var_dump($res);		
		return($sth->fetchAll(PDO::FETCH_ASSOC));		  
	}
	
	
/*запись конкретного значениея в таблицу*/
	function insertValue($val){
		$sq = 'SELECT "'.$val.'" FROM p1_value'; 
		$dbh = self::getDbh();
		$sth = $dbh->prepare($sq);
		return ($sth->execute());
	}		
	
	
/*получение кокретного значениея из таблицы значений*/
	function selectValue(){
		$fan_num ='П1'; //= $_GET['fan_num'];
		$val = $_GET['clm'];	
		$sq = 'SELECT "'.$val.'" FROM p1_value where fan_number="'.$fan_num.'"'; 
		$dbh = self::getDbh();
		$sth = $dbh->prepare($sq);
		return ($sth->execute());
	}	
	
/*удаление записи из базы*/	
	function deleteMsg($id){
//var_dump($date_time);		
	    $sq = 'delete from p1_messages where id ="'.$id.'"';
        $dbh = self::getDbh();
		$sth = $dbh->prepare($sq);
		$sth->execute();
 
	}
	
	/*обновление записи из базы*/	
	function updateMsg(){
		$id = $_GET['id'];
		$true_false = $_GET['what'];	
//echo 'id - '.$id.'<br>';
//echo 'what - '.$true_false.'<br>';		
	    $sq = 'update P1_messages  set status = "'.$true_false.'" where id ="'.$id.'"';
	
        $dbh = self::getDbh();
		$sth = $dbh->prepare($sq);
		$sth->execute();
	}
	
	/**Выбор данных для списка устройств*/
	function getList(){
		$sq = 'SELECT * FROM p1_value ';
		 $dbh = self::getDbh();
		$sth = $dbh->prepare($sq);
		$sth->execute();
		
	}
	
	
}
	//$obj = new DB_connect;	
	//$ms = $obj->insertMsg();
	//$ms = $obj->selectMsg();
	//var_dump($ms);	



/*
function insertMsg(){
		$arr = array('stop'=>'stop','button'=>'button','comm'=>'нажата кнопка stop','cheked'=>'true');
        $sq = 'insert into all_messages(type,source,message, status)
				values(:stop,:button,:comm,:cheked)';
        $dbh = self::getDbh();
       $sth = $dbh->prepare($sq);
       $sth->execute($arr);
	var_dump($sth);   
     // return($sth->fetchAll(PDO::FETCH_ASSOC));
    }



 static function getAll(){
        $sq = 'select * from '.static::$table;
        $dbh = self::getDbh();
       $sth = $dbh->prepare($sq);
       $sth->execute();
      return($sth->fetchAll(PDO::FETCH_ASSOC));
    }

    static function getOne($id){
        $sq = 'select * from '.static::$table.' where id_art = :id';
        $arr = array(':id' => $id);
        $dbh = self::getDbh();
        $sth = $dbh->prepare($sq);
        $sth->execute($arr);
        return $sth->fetch();
    }
*/


		
	

