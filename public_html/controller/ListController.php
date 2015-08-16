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
                        $item = $sth->fetchAll(PDO::FETCH_ASSOC);
                        
                                require 'view/list.php';
                }

        }


	

	
	