<?php 
	//function __autoload($class){
		require 'Mod.php';
		//require 'view.php';
	//}
	
	class smthContr{
		public function action($mth){
			$method = $mth.'Action';
			if(method_exists($this, $method)){
				$this->$method();
			}
		}
		
		private function mthAction(){
			$msg = Mod::getMsg();
			require 'view.php';
		}
		
	}

