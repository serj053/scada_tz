<!---->
        <?php	
        $id = 0;
        foreach($event_ms as $v):
        $id++;
        $el_id = 'id_'.$id;

        ?>
        <div >
                <div class="date_td"><span class="delete_" id="<?php echo $el_id;?>" title="удаление строки">X</span><?php echo $v['date_time'] ?></div>
                <div class="source_td"><?php echo $v['fan_number'] ?></div>
                <div class="message_td">
                        <?php /*разделяем сообщение на две части и вставляем соотвтетствующую*/
                        $str = explode(':',$v['message']);
                        if(isset($str)){
                        $event_ms = $str[0];
                        echo $event_ms;
                        }else{
                        echo'';	
                        }	
                        ?>
                </div>
                <div class="status_td">
                        <input type="checkbox" <?php echo $v['status']; ?> />
                       <?php
                            if($v['status'] == 'checked') echo '"УСТР."';
                            else echo'"АКТ."';
                        ?>
                </div>	
                <div class="hidden"><?php echo $v['id'] ?></div>
        </div>	
        <?php  
        endforeach ;
                ?>
<!--	-->
