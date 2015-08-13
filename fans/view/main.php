<html>
<head><title></title>
    <link rel="stylesheet" href="../css/main.css" type="text/css"/>


</head>
<body>
    <div id="wrapper">
        <div>
            
            
            <form action='main.php' method='get'>
        Пуск        
            <input type='range' id='weight' min='0'
                   value='<?php
                   
                   if(isset($_GET['range']) and $_GET['range'] < 1000){
                       echo'0';
                   }else{
                       echo '2000';
                   }
                   
                   
                   ?>'
                   max='2000' step='10'
                   name="range">
            
        Стоп  
            <br>       
            <input type="submit" value="send"/>
            </form>
        </div>

    </div>       
</body>
</html>

<?php

$var = isset($_GET['range'])?$_GET['range']:'';
echo '$var = '.$var;
echo'<br>';

