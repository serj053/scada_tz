<?php
/*вставляем поле с чек боксом для аварийных кнопок  для этого проверяем что
выводмиое поле принадлежит одной из аварийных кнопок то есть проверяем "id" равен
одному  из рассматриваемого массива*/
$arr_id= array('FAIL_FAN_BTN','FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
    
    foreach($arr_id as $current){
        if($items['elem_id'] == $current){
            ?>
        }

              <input type="checkbox" <?php echo $pt['status']; ?> 
                           id="<?php echo $pt['id'];  ?>"/>  
              <?php
        }
        
    }