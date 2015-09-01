<!---->
        <?php
if(isset($ms)){
        $id = 0;
        foreach($ms as $v): 
        $id++;
        $el_id = 'id_'.$id;
        $ch_id = 'ch_'.$id;

        ?>
        <div class="control">
                <div class="date_td"><span class="delete_" id="<?php echo $el_id;?>" title="удаление строки">X</span><?php echo $v['date_time'] ?></div>
                <div class="source_td"><?php echo $v['fan_number'] ?></div>
                <div class="message_td"><?php echo $v['message'] ?></div>
              <div class="status_td" >
              <?php
              /*вставляем поле с чек боксом для аварийных кнопок  для этого проверяем что
выводмиое поле принадлежит одной из аварийных кнопок то есть проверяем "id" равен
одному  из рассматриваемого массива*/
            $arr_id= array('FAIL_FAN_BTN','FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
    
          foreach($arr_id as $current){
             if($v['elem_id'] == $current){
                  
            ?>
       
              <input type="checkbox" <?php echo $v['status']; ?> 
                           id="<?php echo $v['id'];  ?>"/>  
              <?php
                  if($v['status'] == 'checked') echo '"УСТР."';
                  else echo'"АКТ."';
             }
        }
                                    
          ?>  
<?php /*создаем скрытый элемент для хранения значениея идентификактора строки для того 
что бы при клике по строке получить это значение и обратитья по нему в базу данных   */           ?>   
        </div>	
                <div class="hidden"><?php echo $v['id'] ?></div>
        </div>	
        <?php endforeach ;

        }	?>
<!--	-->
