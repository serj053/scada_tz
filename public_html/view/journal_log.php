<!---->
        <?php


        $id = 0;

        foreach($operation_ms as $v):

        //if(isset(explode('/',$v['message'])[1])){
        $id++;
        $el_id = 'id_'.$id;

        ?>
        <div >
                <div class="date_td"><span class="delete_" id="<?php echo $el_id;?>" title="удаление строки">X</span><?php echo $v['date_time'] ?></div>
                <div class="source_td"><?php echo $v['fan_number'] ?></div>
                <div class="message_td">
                        <?php 
        //echo'message - '.$v['message'];	
                        $arr = explode(':',$v['message']);
                        //if(isset($str)){
                        $operation_ms = $arr[1];
                        echo $operation_ms;
                        //}else{
                        //echo'';	
                        //}	
                        ?>
                </div>
                <div class="status_td">
                      <!-- <input type="checkbox" <?php echo $v['status']; ?> />
                       <?php
                            if($v['status'] == 'checked') echo '"УСТР."';
                            else echo'"АКТ."';
                         ?> -->
                </div>	
                <div class="hidden"><?php echo $v['id'] ?></div>
        </div>	
        <?php  
        endforeach ;

                ?>
<!--	-->
