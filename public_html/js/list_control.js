/* 
 управление списком вентиляторов
 */


function logging_on_off(in_id){
 //  alert('In logging_on_off in_id = '+in_id);	
                   var fan_number = document.getElementById('NAME').innerText;
                   var mass = new Array("EVENT","ALARM","LOG","ALL");
//alert(in_id);
                   var id_st  = document.getElementById(in_id);
                   if(id_st.className == "button_off"){
                           id_st.className = "button_on"; 
var fan_number ='П1';
   /*обращаемся к серверу для загрузки данныз в таблице*/
           /*переводим в нижний регистр для PHP метода*/		
                           var status = in_id.toLowerCase();
        /*place - клас отвечающий за страницу,  status - елемент (соотвтетсвующя кнопка)*/                   
                           var req = 'obj=List/'+status+'&fan_num='+fan_number;
 // alert(req);
                           callServer(req,"scroll_area");

   /*возвращаем остальные кнопки в исходное состояние*/			
                           for(var i=0; i < mass.length; i++){
                                   if(in_id != mass[i]){ /*alert(document.getElementById(mass[i]).className+' - '+in_id);*/
                                           document.getElementById(mass[i]).className = "button_off";					
                                   }
                           }
                   }else{
                           id_st.className = "button_off";
                   }

                            document.body.onselectstart = null;
                   return false;	 
           }

 //alert('In List');

   var xmlHttp = false;
   try {
     xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
   } catch (e) {
     try {
       xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
     } catch (e2) {
       xmlHttp = false;
     }
   }

   if (!xmlHttp && typeof XMLHttpRequest != 'undefined') {
     xmlHttp = new XMLHttpRequest();
   }	


   /*соеденение с сервером  в параметрах передаем команду для контроллера и id дива
   куда будут вставленны полученные данные*/

   function callServer(target_name, div_id) {



   //alert('in callServer() div_id ='+div_id);
           /* Получить значения из web-формы

           /*передаем URL журнала предназначенного для загрузки */	
             var url = 'index.php?'+encodeURI(target_name);//alert(decodeURI(url));
//alert('url - '+url);
           // Открыть соединение с сервером
             xmlHttp.open("GET", url, true);
//alert(xmlHttp.readyState);
           // Установить функцию для сервера, которая выполнится после его ответа
             xmlHttp.onreadystatechange = function(){
 // alert('onreadystate = '+xmlHttp.readyState);
                             if (xmlHttp.readyState == 4) {
                           var response = xmlHttp.responseText;
                           /*берем элемент со страницы и вставляем во внутрь код/текст.
           НАДО понять какая вкладка открыта и вставить данные соотвтетствующие это вкладке
                   для этого проверяем какой текущий класс элемента "button_on" или "button_off"
                   и в зависимости от этого загружается соотвтетсвующая страница сервера 	*/

                     document.getElementById(div_id).innerHTML = response;

                   }		  
               };
           // SПередать запрос
                   xmlHttp.send(null);
           }


// }           
