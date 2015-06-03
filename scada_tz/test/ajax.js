 
 var XHRO = false;
 
 if(window.XMLHttpRequest){
     XHRO = new XMLHttpRequest();
 }else if(window.ActiveXObject){
     XHRO = new ActiveXObject("Microsoft.XMLHTTP");
 }else{
     alert("Браузер не поддерживает Ajax !")
 }
 
 function getData(dataSorce, divID){
     if(XHRO){
         var obj = document.getElementById(divID);
         XHRO.open("get",dataSorce);
         XHRO.onreadystatechange = function(){
             if(XHRO.readyState == 4 && XHRO.status == 200){
                 obj.innerHTML = XHRO.responseText;
             }
         }
        XHRO.send(null) ;
     }
 }