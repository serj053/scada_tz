<html>
    <head><title></title>
        <script type="text/javascript" src="ajax.js">
        </script>
        <style>
            #insert{
                width:200px;
                height: 40px;
                border:1px solid #ccc;
            }
        </style>
        
    </head>
    <body >
        <form method="get">
            <input type="button" value="button"
             onclick="getData('data.php?c=control','insert')"/>
        </form>
        <div id="insert"></div>
        
    </body>
</html>

<?php



