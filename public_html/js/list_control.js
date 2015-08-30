/* 
 управление списком вентиляторов
 */

window.onload = function(){

window.onmousedown = function(e){
    e = e ||window.event;
    var el_id = e.target.getAttribute('id');
 //   alert("ID - "+el_id)
    if(e.target.parentNode.className == 'status_lt'){
        /*меняем состояние атрибута checked после нажатия на закладку */
        if(e.target.checked == false){
     /*присваиваем переменной состояние атррибута checked*/              
            e.target.checked = true;
            is_ch = 'checked';
        }else{       
            e.target.checked = false;
            is_ch = null;
        }
    
    //alert(is_ch+' - '+el_id); 
    /*определяем название текущей закладки что бы ей же и вернуть результат */
        var current_table = currentTable();
        var str = 'obj=List/checked&what='+is_ch+'&id_ch='+el_id+'&table_name='+current_table;
 //alert('astr - '+str)      ;
        callServer(str,'table_list');
        

    }
    
};//end onmousedown()

/*временное окно где будет выводиться исследовательская информация*/
    var el = document.createElement('div');
    el.style.cssText ='position:absolute;'+
                                'width:1000px;'+
                               ' height:100px;'+
                                'border:1px solid;'+
                               ' top:500px;'+
                                'left:130px;';

        document.body.appendChild(el);
      //  var hi = window.history.length;
        el.innerHTML = hi;
                                
}

function logging_on_off(in_id){
 //  alert('In logging_on_off in_id = '+in_id);	
                   var fan_number = document.getElementById('NAME').innerText;
                   var mass = new Array("EVENT","ALARM","LOG","ALL");
//alert(in_id);
                   var id_st  = document.getElementById(in_id);
                   if(id_st.className == "button_off"){
                           id_st.className = "button_on"; 
//var fan_number ='П1';
   /*обращаемся к серверу для загрузки данныз в таблице*/
           /*переводим в нижний регистр для PHP метода*/		
                           var status = in_id.toLowerCase();
        /*place - клас отвечающий за страницу,  status - елемент (соотвтетсвующя кнопка)*/                   
                           var req = 'obj=List/'+status;//+'&fan_num='+fan_number;
 // alert(req);
                           callServer(req,"table_list");

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

           /* Получить значения из web-формы

           /*передаем URL журнала предназначенного для загрузки */	
             var url = 'index.php?'+encodeURI(target_name);//alert(decodeURI(url));
 // alert('url - '+url);
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
           
           
  /*определяем АКТИВНУЮ вкладку (которая в данный момент открыиа)
           И ПЕРЕДАЕМ СЕРВЕРУ ДЛЯ ЗАГРУЗКИ СООТВТЕТСТВУЮЩЕЙ соотвтетствующей 
           это вкладке СТРАНИЦЫ*/
           function currentTable(){
                   var mass = new Array("EVENT","ALARM","LOG","ALL");
                   for(var i=0; i<mass.length; i++){
                           var choose_el = document.getElementById(mass[i]);
                           if(choose_el.className == 'button_on')
                                   txt = mass[i].toLowerCase();
                   }
                   return txt;
           }	          


// }           
