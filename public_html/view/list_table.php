

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
            <input type="checkbox" <?php echo $pt['status']; ?> 
                   id="<?php echo $pt['id'];  ?>"/>             
        </div>

    </div>
<?php  endforeach; ?>