<!DOCTYPE html>

<html>
<head>
        <title>Список ВУ</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">	
        <script type="text/javascript" src=""></script>
        <link rel="stylesheet" href="css/list.css" type="text/css">
        <script type="text/javascript">

        </script>
</head>
<body>
        <div id="wrap">
            <div id="cap">
                    <div id="">УСТАНОВКА</div>
                    <div id="">№ ПОМЕЩЕНИЯ</div>
                    <div id="">СОСТОЯНИЕ</div>
                    <div id="tmp_cap">ТЕМПЕРАТУРА <sup>o</sup> С</div>
                    <div id="spd_cap">СКОРОСТЬ
                            <sup  id="sup_cap">об</sup>
                            <sub id="sub_cap">мин</sub>
                    </div>
                    <div id="">ОБСЛУЖ. ПОМ.</div>
                    <div id="">РАСПОЛОЖЕНИЕ</div>			
            </div>
            <div id="str_ms">

                             ОБЩЕОБМЕННАЯ ВЕНТИЛЯЦИЯ

            </div>

            <div id="list">
            <?php 
            $count_content =0;
            foreach($arr as $val){
            $count_content++;
            $id_content ='id_content'.$count_content ;
            ?>
            <a href="index.php?obj=Fan/default&fan_num=<?php echo $val['fan_number']; ?>&id_content=<?php echo $id_content;?> "target="_blank">
            <div class="content" id="<?php echo $id_content;?>">
                    <div id="">
                            <?php echo $val['fan_number']; ?> 
                    </div>
                    <div id=""> </div>
                    <div id="state">ОТКЛ. </div>
                    <div id="">
                    <?php echo $val['SET_IND']; ?> 
                    </div>
                    <div id="">
                    <?php echo $val['VEL_IND']; ?> 
                    </div>
                    <div id="">ТОРГ. ЗАЛ 1 ЗТ. </div>
                    <div id="">ВЕНТКАМЕРА 1 </div>
            </div>
            </a>		
            <?php };?>
            </div>
            
              <div id="marg">  </div>
              
                     
              


              <div id="logging">
                <div id="buttons_list">	<!--линия указателей аварийности-->
                        <div id="EVENT"  class="button_off" onmousedown = "logging_on_off('EVENT')"> СОБЫТИЯ</div>
                        <div id ="ALARM" class="button_off" onmousedown = "logging_on_off('ALARM')">ПРЕДУПРЕЖДЕНИЯ </div>
                        <div id="LOG" class="button_off" onmousedown = "logging_on_off('LOG')">ЖУРНАЛ ОПЕРАЦИЙ</div>
                        <div id ="ALL" class="button_on" onmousedown = "logging_on_off('ALL')">ВСЕ </div>
                </div>

                        <div id="table_list">
                            <div id="top_name">
                                <div id="DATA"  class="date_lt">ДАТА</div>
                                <div id="SOURCE"  class="source_lt">ИСТОЧНИК</div>
                                <div id="MESSAGE"  class="message_lt">СООБЩЕНИЕ</div>
                                <div id="STATUS"  class="status_lt">СТАТУС</div>
                            </div>    

                                <div id="scroll_area" >
                                     <?php foreach($item as $pt): ?>
                                        <div id="gen_journal">
                                            <div class="date_lt">
                                                <?php echo $pt['date_time']; ?>
                                            </div>
                                            <div class="source_lt">
                                                 <?php echo $pt['fan_number']; ?>
                                            </div>
                                            <div class="message_lt">
                                                 <?php
                                                  $msg = explode(':',$pt['message']);
                                                 // if(isset($msg[0]))
                                                      echo $msg[0];
                                                   //   else echo '';
                                                 ?>
                                            </div>
                                            <div class="status_lt">
                                                 <?php echo $pt['status']; ?>
                                            </div>

                                        </div>
                                  <?php  endforeach; ?>

                                </div>
                        </div>
        </div>
    </div>
</body>
</html>	