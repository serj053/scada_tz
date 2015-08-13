<?php

	 $dbh = "mysql:host=localhost;dbname=fan_log";
	 $dbh = new Pdo($dbh, 'root', '3141');
	 $sq = 'SELECT * FROM P1_messages where fan_number="П1" and elem_i = "EVENT" ';
	 $sth = $dbh->query($sq);
	// $bl = $sth->execute();
//echo 'bl - '.$bl.'<br>';	 
	 $res = $sth->fetch(PDO::FETCH_ASSOC);
	 //foreach ($res as $k=>$v)
	//echo $res['id_val'].'<br>';
	  print_r($res);
	 /*
       $sth = $dbh->prepare($sq);
       $sth->execute();
	   $num = $sth->rowCount();
	 */  
	  
	   
	   
	   
	   
	   //fetchAll(PDO::FETCH_ASSOC);
	   //$sq = 'SELECT COUNT(*) FROM P1_value';