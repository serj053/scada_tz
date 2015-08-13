<?php
	//function __autoload($class){
		//require 'FanController.php';
		require 'Mod.php';
	//}

	class FanController{
		
		public function action($action){
			$method = $action.'Action';
			if(method_exists($this, $method)){
				$method = $action.'Action';
				$this->$method();
			}else{
				echo'Такого метода не существует';
			}
		}
		protected function FanAction(){
			
			$news =  Mod::msgAll();
			require 'view.php';
		}
		
	}