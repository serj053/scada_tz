<!DOCTYPE html>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/control_panel.css" type="text/css">
		<script type="text/javascript">
			var timer;
			function click_start(){
				var el = document.getElementById('img_start_stop');
				el.src = '../img/pusk1.png';
				var img_1 = document.getElementById('rotor');
				var arr = new Array();
				arr[0] = '../img/fan_21.png';
				arr[1] = '../img/fan_31.png';
				arr[2] = '../img/fan_11.png';
				var n =0;
				timer = setInterval(function(){img_1.src = arr[n]; n++; if(n ==3)n=0;
				}, 30);
				
			}
			function click_stop(){
				var el = document.getElementById('img_start_stop');
				el.src = '../img/stop1.png';
				clearInterval(timer);
			}
			
			function click_winter(){
				var el = document.getElementById('summer_winter');
				el.src = '../img/pusk1.png';
				var el1 = document.getElementById('lm_img');
				el1.src = '../img/flag_summer.png';
				
			}
			function click_summer(){
				var el = document.getElementById('summer_winter');
				el.src = '../img/stop1.png';
				var el1 = document.getElementById('lm_img');
				el1.src = '../img/flag_winter.png';
				
			}
			
		</script>
    </head>
    <body>
        <div id="wrapper">  
            <div id="control_panel" class="font">

                <div id="system">
                    <div  class="font_title" id="top_1"> П1</div>
                    <div class="font_title" id="sys_state"> СИСТЕМА В НОРМЕ</div>				
                </div> 
                <div class="function" id="manual_startup">
                    <div id="manual_startup_label" class="label_control_panel">
                    РУЧНОЙ ЗАПУСК
                    </div>
                    <div id="control">

                    <div id="start_stop" >
                        
                        <div id="start" class="font_content" onclick="click_start()"> пуск </div>       
                                        <img src="../img/stop1.png" alt="" id="img_start_stop">	
                        <div id="stop" class="font_content" onclick="click_stop()"> стоп </div> 

                        <div id="fan_img">
                                <img id="rotor"  src="../img/fan_11.png" alt="Вентилятор"/>
                        </div>
                        
                    </div>
               </div>

                    <div class="function" id="run_timetable">
                        <div class="label_control_panel">
                                ЗАПУСК ПО РАСПИСАНИЮ
                        </div>
                        <div id="run_table" class="font_content">
                            <span>вкл</span><input type="text" value=""/>
                            <span>выкл</span><input type="text" value=""/>
                            <span id="activate"> АКТИВИРОВАТЬ </span>
                        </div>

                    </div>
                    <div  class="function">
                        <div id="manual_startup_label" class="label_control_panel">
                        РЕЖИМ РАБОТЫ
                        </div>
                        <div id="control">

                            <div id="work_mode" >						    
                                    <div id="summer" class="font_content"
                                    onclick="click_winter()"> лето </div>       
                                                    <img src="../img/pusk1.png" alt="" id="summer_winter">	
                                    <div id="winter" class="font_content" 
                                    onclick="click_summer()"> зима </div> 

                            </div>

                            <div id="lamp_img">
                                    <img id="lm_img" src="../img/flag_summer.png" alt="индикатор"/>
                            </div>
                        </div>
                    </div>	
                    <div class="function" id="working_mode">
                        <div id="manual_startup_label" class="label_control_panel">
                        СКОРОСТЬ ВЕНТИЛЯТОРА
                        </div>
                        <div id="control">

                                <div id="fan_speed" >						    


                                </div>


                        </div>

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
