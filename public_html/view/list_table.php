

<?php
$index = 0;
foreach($items as $pt):
   $str_id = 'str_'.($index++); 
    ?>
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
        <div class="status_lt" >
              <?php
              /*вставляем поле с чек боксом для аварийных кнопок  для этого проверяем что
выводмиое поле принадлежит одной из аварийных кнопок то есть проверяем "id" равен
одному  из рассматриваемого массива*/
            $arr_id= array('FAIL_FAN_BTN','FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
    
          foreach($arr_id as $current){
             if($pt['elem_id'] == $current){
                  
            ?>
       
              <input type="checkbox" <?php echo $pt['status']; ?> 
                           id="<?php echo $pt['id'];  ?>"/>  
              <?php
             }
        }
              
              ?>     
        </div>

    </div>
<?php  endforeach; ?>
<div id="signal" class="<?php echo isset($bell_color)?$bell_color:'bell_green'; ?>"> </div>