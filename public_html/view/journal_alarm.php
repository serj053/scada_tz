<!---->
	<?php
if(isset($ms)){
	$id = 0;
	foreach($ms as $v): 
	$id++;
	$el_id = 'id_'.$id;
	?>
                <div >
                        <div class="date_td"><span class="delete_" id="<?php echo $el_id;?>" title="удаление строки">X</span><?php echo $v['date_time'] ?></div>
                        <div class="source_td"><?php echo $v['fan_number'] ?></div>
                        <div class="message_td"><?php echo $v['message'] ?></div>
                        <div class="status_td">
                                <input type="checkbox" <?php echo $v['status']; ?> />
                                    <?php
                                         if($v['status'] == 'checked') echo '"УСТР."';
                                         else echo'"АКТ."';
                                       ?>
                        </div>
<?php /*создаем скрытый элемент для хранения значениея идентификактора строки для того 
что бы при клике по строке получить это значение и обратитья по нему в базу данных   */           ?>                          
                        <div class="hidden"><?php echo $v['id'] ?></div>
	</div>	
	<?php endforeach ;
	
	}	?>
<!--	-->
