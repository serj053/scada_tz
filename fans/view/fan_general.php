<!DOCTYPE html>

<html>
<head>
	<title>TODO supply a title</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--	<script type="text/javascript" src="js/fan_rail.js"></script>

	<script type="text/javascript" src="js/summer_winter.js"></script>
-->	
	<script type="text/javascript" src="js/fan_control.js"></script>
	<link rel="stylesheet" href="css/control_panel.css" type="text/css">
	<script type="text/javascript">
		
	</script>
</head>
<body>
	<div id="wrapper">  
	<div id="id_cont"><?php echo $id_content;?></div>
	<!-- ******************** ПАНЕЛЬ УПРАВЛЕНИЯ УСТАНОВКОЙ  ************************-->
		<div id="control_panel" class="font">
			
			<div id="system">
				<div  class="font_title" id="NAME"><?php echo $fan_num;?> </div>
				<div class="font_title" id="SState_1"> СИСТЕМА В НОРМЕ</div>				
			</div> 
			<div class="function" id="manual_startup">
				<div id="manual_startup_label" class="label_control_panel">
				РУЧНОЙ ЗАПУСК
				</div>
				  <div id="control">

				<div id="start_stop" >
					
					<div id="start" class="font_content" > пуск </div>       
									<img src="img/stop1.png" alt="" id="img_start_stop">	
					<div id="stop" class="font_content" > стоп </div> 

					<div id="fan_1">
						   
					</div>
					
				</div>
				</div>
			</div>
			
			<div class="function" id="run_timetable">
				<div class="label_control_panel">
					ЗАПУСК ПО РАСПИСАНИЮ
				</div>
				<div id="run_table" class="font_content">
					<span>вкл</span><input type="text" value="22:10"  />
					<span>выкл</span><input type="text" value="24:55"  />
					<span id="BTN_T" class="turn_off" onclick="onclick_acivate()"> АКТИВИРОВАТЬ </span>
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
												<img src="img/stop1.png" alt="" id="img_summer_winter">	
								<div id="winter" class="font_content" 
								onclick="click_summer()"> зима </div> 

						</div>

						<div id="lamp_img">
								<img id="lm_img" src="img/flag_winter.png" alt="индикатор"/>
						</div>
					</div>
			</div>	
			<div class="function" id="working_mode">
				<div id="manual_startup_label" class="label_control_panel">
				СКОРОСТЬ ВЕНТИЛЯТОРА
				</div>
				<div id="box"><!---->

					<div id="fan_speed" >
						<div id="left_p"></div>
						<div id="fish"></div>
						<div id="rail"></div>
						<div id="right_p"></div>
					</div>
					<div id="pro">
						<?php  echo $VEL_IND; ?>
					</div>
					<div id="_pro">%</div>
				</div><!---->
			
			</div>
			
			<div class="function" >
				<div class="label_control_panel">
				ТЕМПЕРАТУРНЫЕ ЗНАЧЕНИЯ
				</div>
				<div id="ustavka" class="font_content">
					уставка				
				</div>
				<div id="reguliator">
					<div id="left_s"></div>
					<div id ="polzun"> </div>
					<div id="reika"></div>	
					<div id="right_s"></div>
				</div>	
				
				<div id="SET_IND">
					<?php echo $SET_IND;?>
				</div>
				<div id="label_tempr">o</div>
							
				
			</div>
			
			<div class="function"  id="tempr_list" >
				<div id="TE2_1" class="font_content">
					<div id ="v_kan" >в канале </div>
					<div id="win_1">
						<form action="" method="">
						<input type="text" id="TE2" value="<?php echo $TE2;?>"/>
						</form>
					</div>
					<div class="label_gr">o</div>
				</div>
				<div id="TE3_DIV" class="font_content">
					<div id ="obr_v">обратной воды </div>
					<div id="win_2">
						<form action="" method="">
						<input type="text" id="TE3" value="<?php echo $TE3;?>"/>
						</form>
					</div>
					<div class="label_gr">o</div>
				</div>
				<div id="naruj" class="font_content">
					<div id ="nar">наружняя </div>
					<div id="win_3">
						<form action="" method="">
							<input type="text" id="TE1" value="<?php echo $TE1;?>"/>
						</form>
					</div>
					<div class="label_gr">o</div>
				</div>
				
				
			</div>
	
		
		</div>	
<!-- ******************** МОДЕЛЬ УСТАНОВКИ  ************************-->	
<!-- ******************** НАДПИСИ НАД УСТАНОВКОЙ ************************-->	
		<div id="menu">
			<div id="vl_ind" >
				<div class="menu_label">ЗАСЛОНКА </div>
				<div id="VALVE_IND">ЗАКР. </div>
			</div>
			<div id="F_1" >
				<div class="menu_label">ФИЛЬТР </div>
				<div id="F1">НОРМА </div>
			</div>
			<div id="F_2" >
				<div class="menu_label">ФИЛЬТР </div>
				<div id="F2">НОРМА </div>
			</div>
			<div id="th_ind"> 
				<div class="menu_label">ТЕРМОСТАТ </div>
				<div id="THERM_IND">НОРМА </div>
			</div>
			<div id= "md_">
				<div class="menu_label">ВЕНТИЛЯТОР </div>					
				<div id="MD_1">	</div>
			</div>			
		</div>
<!-- ******************** МОДЕЛЬ УСТАНОВКИ  ************************-->				
		<div id="fan_mashin">
			<div class="inc_ind_off"  id="inc_ind" > </div>
			<div id="mashin_color">
				<div id="empty_1"> </div>
				<div id="empty_2"> </div>
				<div id="empty_3"> </div>
				<div id="empty_4"> </div>
				<div id="empty_5"> </div>
				<div id="warm">
					<div id="warm_ind"></div>
					<div id="warm_sys_ind"></div>
					<div id="hotflow_ind"> </div>
				</div>
				<div id="empty_6">	</div>
				<div id = "cool">
					<div  id="cool_ind"> </div>
					<div id="cool_sys_ind"></div>
					<div id="coldflow_ind"> </div>
				</div>
				<div id="fan_2"> </div>
			</div>
			<div id="out_ind"> </div>
		</div>
<!-- ******************** НАДПИСИ ПОД УСТАНОВКОЙ ************************-->	
		<div id="menu_under"><!--первая линия указателей-->
			<div id="level_1">
				<div id="left_top"> 
					<div class="mash_label">ТЕМПЕРАТУРА ВХОДА ПОТОКА</div>
					<div id="INC_NUM_div">
						<form action="" method="">
							<input type="text" id="INC_NUM" value="<?php echo $INC_NUM;?>"/>
						</form>
					</div>
				</div> 
				<div id="right_top">
					<div class="mash_label">ТЕМПЕРАТУРА В КАНАЛЕ</div>
					<div id="TE2_2"> 
						<form action="" method="">
							<input type="text" id="input_TE2_2"/>
						</form>
					</div>
				</div>
			</div>
			<div id="level_2"><!--вторая линия указателей-->
				<div id="middle_1">
					<div class="mash_label">СОСТОЯНИЕ НАСОСА </div>
					<div id="PUMP_IND" >ВКЛ. </div>
				</div>
				<div id="middle_2">
					<div class="mash_label">ДАТЧИК ДАВЛЕНИЯ </div>
					<div id="PS1">НОРМА</div>
				</div>
				<div id="middle_3"> 
					<div class="mash_label">ДАТЧИК ДАВЛЕНИЯ </div>
					<div id="PS2">НОРМА </div>
				</div>
			</div>
			<div id="level_3"><!--третья линия указателей-->
				<div id="mid_1">
					<div class="mash_label">ТЕМПЕРАТУРА ОБР. ВОДЫ </div>
					<div id="WATERBACK_IND_div"> 
						<form action="" method="">
							<input type="text" id="WATERBACK_IND" value="<?php echo $WATERBACK_IND;?>"/>
						</form>
					</div>
				</div>
				<div id="mid_2">
					<div class="mash_label">3-Х ХОДОВОЙ КЛАПАН </div>
					<div id="Hott">ОТКР </div>
				</div>
				<div id="mid_3"> 
					<div class="mash_label">3-Х ХОДОВОЙ КЛАПАН </div>
					<div id="Cold">ОТКР </div>
				</div>
			</div>
			<div id="buttons">	<!--линия указателей аварийности-->
				<div id="FAIL_FAN_BTN"  class="button_off" > АВАРИЯ ВЕНТИЛЯТОРА</div>
				<div id ="FAIL_F_BTN"  class="button_off" >АВАРИЯ ФИЛЬТРА </div>
				<div id="FAIL_FREEZ_BTN"  class="button_off" >АВАРИЯ ЗАМАРОЗКА</div>
				<div id ="FAIL_VALVE_BTN"  class="button_off" >АВАРИЯ ЗАСЛОНКИ </div>
				<div id="RESET"     class="button_on" >СБРОС</div>
			</div>
		</div>

<!-- ******************** ЖУРНАЛ УСТАНОВКИ  ************************-->	
	<div id="logging">
		<div id="buttons_log">	<!--линия указателей аварийности-->
			<div id="EVENT"  class="button_off" onmousedown = "logging_on_off('EVENT')"> СОБЫТИЯ</div>
			<div id ="ALARM" class="button_off" onmousedown = "logging_on_off('ALARM')">ПРЕДУПРЕЖДЕНИЯ </div>
			<div id="LOG" class="button_off" onmousedown = "logging_on_off('LOG')">ЖУРНАЛ ОПЕРАЦИЙ</div>
			<div id ="ALL" class="button_on" onmousedown = "logging_on_off('ALL')">ВСЕ </div>
		</div>
		<div id="clear_1"></div>
			<div id="table_log">
				<div id="DATA">ДАТА</div>
				<div id="SOURCE">ИСТОЧНИК</div>
				<div id="MESSAGE">СООБЩЕНИЕ</div>
				<div id="STATUS">СТАТУС</div>
				<div id="scroll_area" >
				<?php  echo $journal; ?>
				</div>
			</div>
	</div>
		
	</div>
</body>
</html>
