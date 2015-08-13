<!DOCTYPE html>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/control_panel.css" type="text/css">
    </head>
    <body>
        <div id="wrapper">  
			<div id="control_panel">
				
				<div class="" id="system">
				
				</div> 
				<div class="function" id="manual_startup">
					<div id="manual_startup_label" class="label_control_panel">
					РУЧНОЙ ЗАПУСК
					</div>
					<div id="control">

						<div id="start_stop">						    
								<form action='main.php' method='get' id='start'>
							ПУСК        
								<input type='range' id='weight' min='0'
									   value="<?php								   
									   if(isset($_GET['range']) and $_GET['range'] < 1000){
										   echo'0';
									   }else{
										   echo '2000';
									   }							   
									   ?>"  max='500' step='10' length='50'
									   name="range">							
							СТОП  
								<br>       
							<!--	<input type="submit" value="send"/>-->
								</form>
						</div>

						<div id="fan_img">
							<img src="../img/fan_1.png" alt="Вентилятор"
						</div>
					</div>
				</div>
				
				<div class="function" id="run_timetable">
					<div class="label_control_panel">
						ЗАПУСК ПО РАСПИСАНИЮ
					</div>
					<div id="run_table">
					
					</div>
				
				</div>
				
				<div class="function" id="working_mode">
				
				</div>
				
				<div class="function" id="fan_speed">
				
				</div>
				
				<div class="function" id="temperature_values">
				
				</div>
				
				<div class="" id="">
				
				</div>
				
				<div class="" id="">
				
				</div>
				<div class="" id="">
				
				</div>
				
				<div class="" id="">
				
				</div>
			
			</div>		
		</div>
    </body>
</html>
