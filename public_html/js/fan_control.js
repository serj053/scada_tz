
/**
 * Javascript
 * */

window.onload = function(){
        
        /*перезагрузка страницы каджые 30 секунд*/   
                //  setTimeout(function(){   location.reload();}, 30000);
    //<?php header('refresh: 5'); ?>
            /*определяем номер установки (вентилятора)*/
                   var fan_number = document.getElementById('NAME').innerText;


   /*прячем элементы показывающие поток охлаждающей жидкости*/
           var cold_flow = document.getElementById('coldflow_ind');
           cold_flow.style.visibility = "hidden";
           var hot_flow = document.getElementById('hotflow_ind');
           //hot_flow.style.visibility = "hidden";

   /*Значение числового индикатора наружной температуры задаваемое случайным образом
           var win_tr_out = document.getElementById('T1');
           var tr_out = Math.floor(Math.random()*60 - 30);

           win_tr_out.value = tr_out;
   */
   /* РЕГУЛИРОВКА СКОРОСТИ  ВЕНТИЛЯТОРА*/

    /*получеам доступ к элементу "rail" -рейка которая определяет диапазон движение
           ползунка "bal"*/
                   var rail = document.getElementById('rail');

    /*получаем доступ к элементу "bal" */	
                   var fish = document.getElementById('fish');

    /*Получаем значение из окошка со страницы зафиксированное и переданное из базы данных) 
         * что бы   установить положение ползунка*/
                   var coor = parseInt(document.getElementById('pro').textContent);
                   fish.style.left = 8+coor+'px';
                   
        /*внутри функии onmousedown() управляем движением ползунка который
         регулирует скрость вращениея вентилятора * */
           fish.onmousedown = function(e){

                   e = e||window.event;
                   var fish = this;
    /*получаем координату крайнего левого положениея ползунка*/         
                   var r_f = rail.offsetLeft;
    /*смещение левой координаты ползунка относительно клика мыши где e.pageX это
    * координата клика, а координата левого верхнего угла элемента*/		
                   var x = e.pageX - fish.offsetLeft;
    /*вырываем ползунок из общего потока*/
                   fish.style.position = 'absolute';
    /*устанавливаем позицию ползунка с учетом смещения клика  при клике по 
    * ползунку*/       
                   fish.offsetLeft = e.pageX -x +'px';

                   fish.onmousemove = function(e){
                       
    /*организукм перемещение ползунка регулировки скорости*/         
                           move(e);

    /*расчет показаний скорости вращения в окошке на странице на */			
                    sz = (fish.offsetLeft - rail.offsetLeft )/1;
                    prc = parseInt(sz);
                    if(prc > 100){
                    prc = 100;
                    }else if(prc < 0){
                    prc = 0;}
                    pro.innerHTML = prc;
             //отображение скорости в окошке над установкой
                    var speed_value=document.getElementById("MD_1");
                    speed_value.innerHTML = prc;

                   };
   //contr.innerHTML = 'e.pageX='+e.pageX+'<br>rail.offsetLeft='+rail.offsetLeft+'<br>fish.offsetLeft='+fish.offsetLeft;					

                    document.onmouseup = function(){

                    // очистить обработчики, т.к перенос закончен
                    document.onmousemove = null;
                    document.onmouseup = null;
                    document.ondragstart = null;
                    document.body.onselectstart = null;
                    fish = null;

    /*передаем скорсть вращения вентилятору при условии что установка включена*/
    /*берем значение из окошка, в окошко занчение передается из базы
    *  при загрузке страницы */		
                     var el_cool = document.getElementById('inc_ind');
    /*если установлен у элемента класс  "inc_ind_on" значит установка включена*/     
                     if(el_cool.className === "inc_ind_on"){
                         var sp_win = parseInt(document.getElementById('pro').textContent);
                         var sp_win = 20/sp_win;

    /*передаем значения скорости в функцию анимацию вращения*/
                                    fan_speed(sp_win);
                            }	


    /*С помощью объекта XMLHTTPrequest  заносяться в две таблицы базы данных
    *  значение в одну значеиня параметров установки скорость и т.д. в другую 
    *  сообщения  о   процесах*/

    /**СТРОКА которая заноситься в базу*/	
                   var str = "Скорость вентилятора изменена до "+prc+' %.'+
                   ':Изменение скорости вентилятора';
    /*ТЕКУЩАЯ АКТИВНАЯ ВКЛАДКА*/	
    /*определяем текущую активную вкладку, что бы после обработки и перезагрузки вставить
    обратно именно в нее	*/
           var tab = currentTable();	
    /*ИДЕНТИФИКАТОР элемента страницы в который будут вставляться полученные с сервера данные*/	
                   var div_id = "scroll_area";
    /*Формируем строку для передачи XNKHTTPrequest объекту*/               
    /*Имя класса/ метод обработчика на сервере с прицепленными к нему данными, 
    * которые будут переданны в массив GET[] и использоваться базами даных.
    -класс/метод- + id элемента на который нажали + строка с инф. для журнала событий
    + номер установки*/	

                   var target_name = 'obj=Journal/add&what=fish&str='+str+'&fan_num='+fan_number+'&id_table='+tab+'&fan_val='+prc; 
             //alert(target_name);		
    /*Функция для передачи данных серверу*/	
                           callServer(target_name, div_id);

                   };		
        /******************************************************************************/
/*функция движения ползунка*/
            function move(e){

                    fish.style.left = e.pageX-x+'px' ;
    /*остановка ползунка при выходе за границы рейки*/	
                    if(fish.offsetLeft  < r_f)	{fish.style.left = 8+'px';	};
                    if(fish.offsetLeft > rail.offsetWidth - 6)	{ fish.style.left = 113+'px'; 	};
            };
                       // отменить перенос и выделение текста при клике на тексте
                       document.ondragstart = function() { return false ;};
                       document.body.onselectstart = function() { return false ;};

                       return false;
            };
   /////////////////////////////////////////////////////////////////////////////////////////////

   /*РЕГУЛИРОВКА ТЕМПЕРАТУРЫ*/
           /*получаем елемент ползун*/
           var polzun = document.getElementById('polzun');
           /*получаем елемент рейку по которой ползет ползун*/
           var reika = document.getElementById('reika');

    /*получаем доступ к окошку вывода температуры уставки   куда из базы данных
    загружается значение и передаем координате ползуна*/
            var wind = document.getElementById('SET_IND');
            var in_wind = wind.textContent;
            var tmp = parseInt(in_wind);
            polzun.style.left = tmp+'px';
  
    /*обрабатываем клик по ползуну , внутри функции клика организуем функцию пе*/
   polzun.onmousedown = function(e){
                   e = e || window.event;
                   var polzun = this;

    /*определяем разницу междк точкой клика и левым верхним углом елемента*/	
                   var x = e.pageX - polzun.offsetLeft;

                   //polzun.style.position ='absolute';

                   polzun.onmousemove = function(e){

                           move(e);

    /*расчитываем температуру для вывода в окошко */
                   val_tempr = ( polzun.offsetLeft - reika.offsetLeft)/0.93;
                   if(val_tempr < 0) val_tempr = 0;
                   if(val_tempr > 50) val_tempr = 50;
                   tmp = parseInt(val_tempr);
                   wind.innerHTML = tmp;


    /*расчитываем температуру в канале с учетом -+ 1 градус
                   var tmp_rand = Math.floor(Math.random()*2+(tmp - 1))
                   var win_1 = document.getElementById('input_TE2_1');
                           win_1.value = tmp_rand;

                   var tr_ch = document.getElementById("TE2_2");
                           tr_ch.innerHTML = tmp_rand;

                   */// теперь берктся из базы
                   };

            document.onmouseup = function(){
                  
    // очистить обработчики, т.к перенос закончен
                 document.onmousemove = null;
                 document.onmouseup = null;
                 document.ondragstart = null;
                 document.body.onselectstart = null;
                 polzun = null;
                 
    /*Формируем строку для передачи XNKHTTPrequest объекту*/               
    /*Имя класс/ метод обработчика на сервере с прицепленными к нему данными, 
    * которые будут переданны в массив GET[] и использоваться базами даных.
    -класс/метод- + id элемента на который нажали + строка с инф. для журнала событий
    + номер установки*/
    /**СТРОКА которая заноситься в базу*/	
                   var str = "Уставка зменена до "+tmp+"<strong><sup>0</sup></strong> С:"+
                   "Изменение уставки"
                   ;
    /*ТЕКУЩАЯ АКТИВНАЯ ВКЛАДКА*/	
           var tab = currentTable();//определяем активную вкладку, что после абработкт вставить именно в нее		
    /*ИДЕНТИФИКАТОР элемента в который будут вставляться полученные с сервера данные*/	
                   var div_id = "scroll_area";
                   
    /*АДРЕС файла обработчика на сервере с прицепленными к нему данными 
    -класс/метод- + id элемента на который нажали + строка с инф. + номер установки*/	
                   var target_name = 'obj=Journal/add&what=polzun&str='+str+'&fan_num='+fan_number+'&id_table='+tab+'&tmp_val='+tmp; 
    /*Функция для передачи данных серверу*/
                           callServer(target_name, div_id);

                   };

    /*функция перемещения ползунка*/       
                   function move(e){

                           polzun.style.left = e.pageX - x+'px';

                   if(polzun.offsetLeft < -1){
                                   polzun.style.left = -1+'px';
                           }
                           if(polzun.offsetLeft > 47){
                                   polzun.style.left = 47+'px';
                           }
    //contr.innerHTML = 'poilzun.offsetLeft ='+polzun.offsetLeft+'  reika.offsetLeft = '+reika.offsetLeft;			
                   };

                   document.ondragstart = function() { return false; };
                                   document.body.onselectstart = function() { return false ;};
                   return false;
           };

   /*ТЕМПЕРАТУРА В КАНАЛЕ обработка изменений в окнах*/
   /*Заносим значение из поля(окошко) температуры в базу данных и при загрузке страницы 
    * берем значение из базы переносим в поле температуры*/
   
    /*Получаем ссылку на поле(окошко) температуры*/
           var te2 = document.getElementById('TE2');
    //alert('target_vallue - '+target_value);         
    /*Функция отслеживающая изменение в окошке*/
                   te2.onchange = function(){                    
    /*Получаем значение из поля(окошка)*/              
                           var val_t2 = this.value;
    /*Получаем идентификатор поля для обратной загрузки*/	
                           var div_id = 'TE2';
   /*Готовим строку для передачи XNLHTTPrequest  объекту.
    * класс/метод которому передается значение + передаваемая величина + номер установки*/	
                           var target_value = 'obj=Fan/value&clm=TE2&TE2='+val_t2+'&fan_num='+fan_number;	

                           callServer(target_value, div_id);//со  строки 1020

                   };

   /*ТЕМПЕРАТУРА ОБРАТНОЙ ВОДЫ обработка изменений в окнах*/
           var te3 = document.getElementById('TE3');	
                   te3.onchange = function(){				
                           var val_t3 = this.value;	
                           var div_id = 'TE3';	
                           var target_value = 'obj=Fan/value&clm=TE3&TE3='+val_t3+'&fan_num='+fan_number;	

                           callServer(target_value, div_id);

                   };

   /*ТЕМПЕРАТУРА НАРУЖНЯЯ обработка изменений в окнах*/
           var te2 = document.getElementById('TE1');	
                   te2.onchange = function(){				
                           var val_t1 = this.value;	
                           var div_id = 'TE1';	
                           var target_value = 'obj=Fan/value&clm=TE1&TE1='+val_t1+'&fan_num='+fan_number;		
  // alert(target_value);

                           callServer(target_value, div_id);

                   };

   /*ЧИСЛОВОЙ ИНДИКАТОР ТЕМПЕРАТУРЫ ВХОДЯЩЕГО ПОТОКА обработка изменений в окнах*/
           var te2 = document.getElementById('INC_NUM');	
                   te2.onchange = function(){				
                           var val_inc_num = this.value;
                   /*то на странице куда будет возвращено значенпи после фиксации в базе*/	
                           var div_id = 'INC_NUM';
                   /*класс которому передается значение и передаваемая величина*/	
                           var target_value = 'obj=Fan/value&clm=INC_NUM&INC_NUM='+val_inc_num+'&fan_num='+fan_number;		
   //alert(target_value);

                           callServer(target_value, div_id);

                   };

   /*ЧИСЛОВОЙ ИНДИКАТОР ТЕМПЕРАТУРЫ ОБРАТНОЙ ВОДЫ обработка изменений в окнах*/
           var te2 = document.getElementById('WATERBACK_IND');	
                   te2.onchange = function(){				
                   var val_wat = this.value;
                   /*то на странице куда будет возвращено значенпи после фиксации в базе*/	
                   var div_id = 'WATERBACK_IND';
                   /*класс которому передается значение и передаваемая величина*/	
                   var target_value = 'obj=Fan/value&clm=WATERBACK_IND&WATERBACK_IND='+val_wat+'&fan_num='+fan_number;		
   //alert(target_value);

                           callServer(target_value, div_id);

                   };		

   }; //End of window.onload()



   window.document.onmousedown = function(e){

           /*узнаем номер установки (вентилятора)*/
                   var fan_number = document.getElementById('NAME').innerText;
   //alert('fan_number - '+fan_number);
   /*функция запрещающая выделение  строка примерно 1084*/
           disableSelection(document.body);


   /*отменяем выделение строки при смещении текста*/	
           //window.document.onscroll = function(){window.document.body.onselectstart= false;};

   /*УДАЛЕНИЕ СТРОКИ. ловим все события "НАЖАТИИЕ КНОПКИ" и определяем "id" элемента*/	
        /*получаем атррибут элемента по которому кликнули*/
           var el = e.target.getAttribute('id');
   /*выделяем те нажатия которые имеют отношения к журналу событий, то есть имеющие
   префикс "id_" для того что бы выбрать элемент из таблицы */
           if(el !== null  && el.slice(0,3)==='id_'){
    /*определяем элемент который связан с событием является пятым дочерним у родителя*/
                   var del_element = document.getElementById(el).parentNode;
    /*определяем id элемента связанного с  событием*/	
                   var txt = del_element.parentNode.children[4].textContent;
   //alert(txt);
   /*формируем строку для передачи объекту XMLHTTPrequest*/
    /*определяем  закладку куда будут переданы обновленные значения после перезагрузки
    * тоесть текущую закладку*/
                   var div_id = currentTable();
    /*получаем значение элемента(время)  и передает его в GET по которому будем искать его в базе*/	
                   var val_date = del_element.textContent.slice(1);	
           var div_id = "scroll_area";//элемент страницы куда будет вставляться код 
           var tab = currentTable();//определяем активную вкладку, что бы после абработкт вставить именно в нее	
                   var target_name = 'obj=Journal/del&id='+txt+'&id_table='+tab+'&fan_num='+fan_number;
   //alert('стр 28 -'+target_name);		
                           callServer(target_name, div_id)	;
           }
   /*СТАВИМ ИЛИ УБИРАЕМ галку в checkBOX*/
   /*выбираем элемент с классом характерным для элемента предназначенного для галки*/
           if(e.target.parentNode.className ==='status_td'){
   //alert('e.target.parentNode.className -'+e.target.parentNode.className);		
                   var sss = e.target.parentNode.parentNode.children[4].textContent;
                   var el_ch;
           e.target.onmouseup = function(){
   //alert('In checked');
                   if(e.target.checked === false){
                           e.target.checked = true;
                           var el_ch = 'checked';
                   }else{
                   e.target.checked = false;
                           var el_ch = null;
                   }
                   

     /*Организуем строку для передачи XMLHTTPrequest объекту для передачи базе данных*/

    /*определяем id элемента который записан как текст в срытом элементе
    *  и  связанного с  событием для нахождения его в базе*/
           var del_element = e.target.parentNode;
                   var txt = del_element.parentNode.children[4].textContent;	
    /*ТЕКУЩАЯ АКТИВНАЯ ВКЛАДКА*/	
           var tab = currentTable();//определяем активную вкладку, что бы после абработкт вставить именно в нее
           var div_id = "scroll_area";//элемент страницы куда будет вставляться код 

    /*АДРЕС файла обработчика на сервере с прицепленными к нему данными для массива GET[]
           -класс/метод- + строка с инф.+ id элемента на который нажали + номер активной вкладки */	
   //alert('el_ch = '+el_ch);	
           var target_name = 'obj=Journal/checked&what='+el_ch+'&id_ch='+txt+'&id_table='+tab+'&fan_num='+fan_number;
   //alert('target_name = '+target_name);	
                           callServer(target_name, div_id);						
                   };	
           }
       
       
/*Выбоор элементов по идентификаторам и бработка кликов*/

           switch(el){	
   /*нажимает старт ВУ*/	
           case"start": 
   /*Организуем строку для передачи XMLHTTPrequest объекту для передачи базе данных*/
    /*определяем номер установки (вентилятора)*/
    //d var fan_number = document.getElementById('NAME').innerText;
    /**СТРОКА которая заноситься в базу*/	
                       var str = "Установка запущена:Запуск установки";
    /*ИДЕНТИФИКАТОР элемента в который будут вставляться полученные с сервера данные*/	
                       var div_id = "scroll_area";
    /*определяем активную вкладку, что бы после абработкт вставить именно в нее*/	
               var tab = currentTable();	
    /*АДРЕС файла обработчика на сервере с прицепленными к нему данными для масива GET[]
    -класс/метод- + id элемента на который нажали + строка с инф. + номер установки 
    + номер активной вкладки */	
                   var target_name = 'obj=Journal/add&what='+el.toLowerCase()+'&str='+str+'&fan_num='+fan_number+'&id_table='+tab; 

                    callServer(target_name, div_id);

/*перевод рычажка в положение включить*/	
                        var el = document.getElementById('img_start_stop');
                        el.src = 'img/pusk1.png';
                        var el_cool = document.getElementById('inc_ind');
    //Запуск прогресс бара	
    /*если установка уже включена то не запускать прогрессБар*/	
                        if(el_cool.className === "inc_ind_off"){
    /*функция создания прогресс бара*/
                                                fun_on_off(true);
                        }else{
                                return;
                        }			
    /*индикация состояния насоса*/		
                        var state_pump = document.getElementById("PUMP_IND");
                        state_pump.innerHTML = "ВКЛ.";
                        state_pump.style.backgroundColor = "#5D7809";

            break;
   /*нажимаем стоп ВУ*/		
           case"stop": 
    /*Организуем строку для передачи XMLHTTPrequest объекту для передачи базе данных*/
                   /* номер установки (вентилятора) "fan_number" определн выше*/
    /**СТРОКА сообщениея которая заноситься в базу*/	
                   var str = "Установка остановлена : Остановка установки";
    /*определяем активную вкладку, что после абработкт вставить именно в нее	*/	
           var tab = currentTable();	
    /*ИДЕНТИФИКАТОР элемента в который будут вставляться полученные с сервера данные*/	
                   var div_id = "scroll_area";
    /*АДРЕС файла обработчика на сревере с прицепленными к нему данными для массива GET[]
           -класс/метод- + id элемента на который нажали + строка с инф. + номер установки*/	
                   var target_name = 'obj=Journal/add&what='+el.toLowerCase()+'&str='+str+'&fan_num='+fan_number+'&id_table='+tab; 
   //alert('fan_number - '+fan_number);		
                           callServer(target_name, div_id);

    /*превод рычажка в положение выключить*/		
                                   var el = document.getElementById('img_start_stop');
                                   el.src = 'img/stop1.png';
    /*если className == "inc_ind_on" то установка включена */		
                                   var el_cool = document.getElementById('inc_ind');
                                   if(el_cool.className === "inc_ind_on"){
                                                           fun_on_off(false,'gray',true);
                                   }else{
                                           return;
                                   }		

    /*индикация состояния насоса*/		
                           var state_pump = document.getElementById("PUMP_IND");
                           state_pump.innerHTML = "ВЫКЛ.";
                           state_pump.style.backgroundColor = "#4C4849";

                   break;
   /*"BTN_T" активации установки по таймеру*/		
           case"BTN_T": 
    /*Организуем строку для передачи XMLHTTPrequest объекту для передачи базе данных*/
    /* номер установки (вентилятора) "fan_numer" определн выше*/
    /**СТРОКА которая заноситься в базу*/	
                   var str = "Установка актвирована по таймеру : Активация установки по таймер";
    /*ИДЕНТИФИКАТОР элемента в который будут вставляться полученные с сервера данные*/	
                   var div_id = "scroll_area";
    /*ТЕКУЩАЯ АКТИВНАЯ ВКЛАДКА*/	
           var tab = currentTable();//определяем активную вкладку, что после абработкт вставить именно в нее		
    /*АДРЕС файла обработчика на сревере с прицепленными к нему данными 
    -класс/метод- + id элемента на который нажали + строка с инф. + номер установки*/	
                   var target_name = 'obj=Journal/add&what='+el.toLowerCase()+'&str='+str+'&fan_num='+fan_number+'&id_table='+tab; ; 

                           callServer(target_name, div_id);

                   var ell = document.getElementById("BTN_T");
                   if(ell.className == "active"){//нсли кнопка вжата
                           ell.className = "turn_off";
                           ell.innerHTML ="АКТИВИРОВАТЬ";
                   }else if(ell.className == "turn_off"){//кнопка отжата то есть выключена
                           ell.className = "active"; 
                           ell.innerHTML ="ОТКЛЮЧИТЬ";
                   };

                   ;
                   break;
   /*SUMMER переключение режима зима-лето*/		
           case"summer": 
  /*Организуем строку для передачи XMLHTTPrequest объекту для передачи базе данных*/
  /* номер установки (вентилятора) "fan_number" определн выше*/
  /**СТРОКА которая заноситься в базу*/	
                   var str = "Режим зима-лето изменен на режим -зима : Изменение режима зима лето";
/*ИДЕНТИФИКАТОР элемента в который будут вставляться полученные с сервера данные*/	
                   var div_id = "scroll_area";
    /*определяем активную вкладку, что после абработкт вставить именно в нее*/	
           var tab = currentTable();		
           /*АДРЕС файла обработчика на сревере с прицепленными к нему данными для массива GET[]
           -класс/метод- + id элемента на который нажали + строка с инф. + номер установки*/	
                   var target_name = 'obj=Journal/add&what='+el.toLowerCase()+'&str='+str+'&fan_num='+fan_number+'&id_table='+tab;  

                           callServer(target_name, div_id);
    /*присваиваем элементам соотвтетвующие моменту изображения*/
                var el = document.getElementById('img_summer_winter');
                     el.src = 'img/pusk1.png';
                     var el1 = document.getElementById('lm_img');
                     el1.src = 'img/flag_summer.png';
                     var warm = document.getElementById('warm_ind');
                     warm.style.backgroundImage = "url('img/warm_ind_1.png')";
                     var cool = document.getElementById('cool_ind');
                     cool.style.backgroundImage = "url('img/ind_out.png')";
                     var cold_flow = document.getElementById('coldflow_ind');
                     cold_flow.style.visibility = "hidden";
                     var hot_flow = document.getElementById('hotflow_ind');
                     hot_flow.style.visibility = "visible";

                     var vl_ind = document.getElementById("VALVE_IND");
                     vl_ind.innerHTML = "ОТКР.";
                     vl_ind.style.backgroundColor ="#5D7809";
                     var vl_ind = document.getElementById("PUMP_IND");
                     vl_ind.innerHTML = "ВЫКЛ.";
                     vl_ind.style.backgroundColor ="#4C4849";	

                   ;
                   break;
   /*WINTER переключение режима зима-лето*/			
           case"winter": 
    /*Организуем строку для передачи XMLHTTPrequest объекту для передачи базе данных*/
     /* номер установки (вентилятора) "fan_numer" определн выше*/
           /**СТРОКА которая заноситься в базу*/	
                   var str = "Режим зима-лето изменен на режим зима : Изменение режима зима-лето";
    /*ИДЕНТИФИКАТОР элемента в который будут вставляться полученные с сервера данные*/	
                   var div_id = "scroll_area";
    /*ТЕКУЩАЯ АКТИВНАЯ ВКЛАДКА*/	
           var tab = currentTable();//определяем активную вкладку, что после абработкт вставить именно в нее		
    /*АДРЕС файла обработчика на сревере с прицепленными к нему данными 
    -класс/метод- + id элемента на который нажали + строка с инф. + номер установки*/	
                   var target_name = 'obj=Journal/add&what='+el.toLowerCase()+'&str='+str+'&fan_num='+fan_number+'&id_table='+tab; 

                           callServer(target_name, div_id);

            var el = document.getElementById('img_summer_winter');
                     el.src = 'img/stop1.png';
                     var el1 = document.getElementById('lm_img');
                     el1.src = 'img/flag_winter.png';
                     var warm = document.getElementById('warm_ind');
                     warm.style.backgroundImage = "url('img/ind_out.png')";
                     var cool = document.getElementById('cool_ind');
                     cool.style.backgroundImage = "url('img/cool_ind_1.png')";
                     var cold_flow = document.getElementById('coldflow_ind');
                     cold_flow.style.visibility = "visible";
                     var hot_flow = document.getElementById('hotflow_ind');
                     hot_flow.style.visibility = "hidden";

                     var vl_ind = document.getElementById("VALVE_IND");
                      vl_ind.innerHTML = "ЗАКР.";
                      vl_ind.style.backgroundColor ="#6950B6";
                     var vl_ind = document.getElementById("PUMP_IND");
                      vl_ind.innerHTML = "ВКЛ.";
                      vl_ind.style.backgroundColor ="#5D7809";	
                   ;
                   break;
   /*АВАРИЯ ВЕНТИЛЯТОРА*/
           case "FAIL_FAN_BTN":
    /*Организуем строку для передачи XMLHTTPrequest объекту для передачи базе данных*/
     /* номер установки (вентилятора) "fan_number" определн выше*/
           /*если установка не включена то работа кнопок заблокирована*/	
           /*проверяем включена ли установка если всключени то отключаем если нет то выход*/
                   var el_cool = document.getElementById('inc_ind');
                   if(el_cool.className != "inc_ind_on"){ return;}	

           /**СТРОКА которая заноситься в базу*/	
                   var str = "АВАРИЯ ВЕНТИЛЯТОРА. Установка «СТОП»";
           /*ИДЕНТИФИКАТОР элемента в который будут вставляться полученные с сервера данные*/	
                   var div_id = "scroll_area";
           /*определяем активную вкладку, что после абработкт вставить именно в нее	*/	
           var tab = currentTable();//		
           /*АДРЕС файла обработчика на сервере с прицепленными к нему данными 
           -класс/метод- + id элемента на который нажали + строка с инф. + номер установки*/	
                   var target_name = 'obj=Journal/add&what='+el+'&str='+str+'&fan_num='+fan_number+'&id_table='+tab; 

                           callServer(target_name, div_id);
    /*проверяем состояние аварийных кнопок по классу если пред кликом она отжата то
     * вжать ее и наоборот  */
                   var that = document.getElementById("FAIL_FAN_BTN");
                   if(that.className === "button_on"){//если кнопка вжата
                                   that.className = "button_off";
                           }else if(that.className === "button_off"){//если кнопка отжата то есть выключена		
                                   that.className = "button_on"; 
                           }
    /*получаем доступ к элементу содержащему текст для его замены*/
                   var st_f = document.getElementById("SState_1");//надпись "СИСТЕМА В НОРМЕ" или другая

    /*если текущая кнопка нажата то поменять текст внутри элемнтов*/
                   if(that.className === "button_on"){	//alert(that.className);		
                           st_f.innerHTML ="АВАРИЯ ВЕНТИЛЯТОРА";
                           st_f.style.color = "red";
                           var md_1 = document.getElementById("MD_1");
                           md_1.innerHTML = "АВАРИЯ";
                           md_1.style.cssText ="color:#fff; background-color:red; font-weight:bold";

        /*функция прогресс бара -  остановка установки*/			
                                   fun_on_off(false,'red',false);

   /****сообщаем window.opener что произошла АВАРИЯ     */

   /***********************************************************************/					
    /*перевод рычажка в положение выключить*/		
                    var el = document.getElementById('img_start_stop');
                    el.src = 'img/stop1.png';
    /*перевод кнопки сброса в состояние поднята*/
                    document.getElementById("RESET").className = "button_off"; 	
    /*отключение кнопки*/
                    document.documentElement.onmouseup = function(){that.className = "button_off";};
                   }	
                   ;
                   break;
   /*АВАРИЯ ФИЛЬТРА*/		
           case "FAIL_F_BTN":
           /*посылаем(добавляем) сообщение  в журнал и базу данных*/
           /*если установка не включена то работа кнопок заблокирована*/	
           /*проверяем включена ли установка если всключени то отключаем если нет то выход*/
                   var el_cool = document.getElementById('inc_ind');
                   if(el_cool.className !== "inc_ind_on"){ return;}

                   /*определяем номер установки (вентилятора)*/
                   //d var fan_number = document.getElementById('NAME').innerText;
           /**СТРОКА которая заноситься в базу*/	
                   var str = "АВАРИЯ ФИЛЬТРА. Установка «СТОП»";
           /*ИДЕНТИФИКАТОР элемента в который будут вставляться полученные с сервера данные*/	
                   var div_id = "scroll_area";
           /*определяем активную вкладку, что бы после абработкт вставить именно в нее*/	
           var tab = currentTable();			
           /*АДРЕС файла обработчика на сревере с прицепленными к нему данными для мссиваGET[]
           -класс/метод- + id элемента на который нажали + строка с инф. + номер установки*/	
                   var target_name = 'obj=Journal/add&what='+el+'&str='+str+'&fan_num='+fan_number+'&id_table='+tab; 
   //alert(target_name);
   
                           callServer(target_name, div_id);
    /*получаем кнопку*/
            var that = document.getElementById("FAIL_F_BTN");
     /*если вжата то отжимаем и наоборот*/       
            if(that.className === "button_on"){//если кнопка вжата
                            that.className = "button_off";
                    }else if(that.className === "button_off"){//если кнопка отжата то есть выключена
                            that.className = "button_on"; 
                    }
    /*получаем элемент для изменений текста в нем*/                
            var st_f = document.getElementById("SState_1");//надпись "СИСТЕМА В НОРМЕ" или другая

            if(that.className === "button_on"){
            var st_f = document.getElementById("SState_1");	
                    st_f.innerHTML ="АВАРИЯ ФИЛЬТРА";
                    st_f.style.color = "red";
                    var f_1 = document.getElementById("F1");
                    f_1.innerHTML = "ЗАСОР";
                    f_1.style.cssText ="color:#fff; background-color:red; font-weight:bold";
   /****сообщаем window.opener что произошла АВАРИЯ  -'red'   */

    /*остановка установки*/			
                        fun_on_off(false,'red',false);
    /*перевод рычажка в положение выключить*/		
                        var el = document.getElementById('img_start_stop');
                        el.src = 'img/stop1.png';
    /*перевод кнопки сброса в состояние поднята*/
                document.getElementById("RESET").className = "button_off"; 		
    /*отключение кнопки*/
                        document.documentElement.onmouseup = function(){that.className = "button_off";};
                   }
                   ;
                   break;
   /*АВАРИЯ ТЕРМОСТАТА*/
           case "FAIL_FREEZ_BTN":
    /*Организуем строку для передачи XMLHTTPrequest объекту для передачи базе данных*/
     /* номер установки (вентилятора) "fan_number" определн выше*/
    /*если установка не включена то работа кнопок заблокирована*/	
    /*проверяем включена ли установка если всключени то отключаем если нет то выход*/
                   var el_cool = document.getElementById('inc_ind');
                   if(el_cool.className !== "inc_ind_on"){ return;};

                   /*определяем номер установки (вентилятора)*/
                   //d var fan_number = document.getElementById('NAME').innerText;
           /**СТРОКА которая заноситься в базу*/	
                   var str = "АВАРИЯ ЗАМОРОЗКА. Установка «СТОП»";
           /*ИДЕНТИФИКАТОР элемента в который будут вставляться полученные с сервера данные*/	
                   var div_id = "scroll_area";
           /*ТЕКУЩАЯ АКТИВНАЯ ВКЛАДКА*/	
           var tab = currentTable();//определяем активную вкладку, что после абработкт вставить именно в нее			
           /*АДРЕС файла обработчика на сревере с прицепленными к нему данными 
           -класс/метод- + id элемента на который нажали + строка с инф. + номер установки*/	
                   var target_name = 'obj=Journal/add&what='+el+'&str='+str+'&fan_num='+fan_number+'&id_table='+tab; 
	
                           callServer(target_name, div_id);


                   var that = document.getElementById("FAIL_FREEZ_BTN");
                if(that.className === "button_on"){//если кнопка вжата
                                that.className = "button_off";
                        }else if(that.className === "button_off"){//если кнопка отжата то есть выключена
                                that.className = "button_on"; 
                        }
     /*получаем доступ к элементам для изменеия текста*/                   
                   var st_f = document.getElementById("SState_1");//надпись "СИСТЕМА В НОРМЕ" или другая
    /*если кнопка вжата то меняем надписи*/
               if(that.className === "button_on"){
                   var st_f = document.getElementById("SState_1");	
                    st_f.innerHTML ="АВАРИЯ ЗАМАРОЗКА";
                    st_f.style.color = "red";
                    var trm = document.getElementById("THERM_IND");
                    trm.innerHTML = "ЗАМОРОЗКА";
                    trm.style.cssText ="color:#fff; background-color:red; font-weight:bold";
   /****сообщаем window.opener что произошла АВАРИЯ   'red'  */

                /*остановка установки*/			
                        fun_on_off(false,'red',false);
                /*перевод рычажка в положение выключить*/		
                        var el = document.getElementById('img_start_stop');
                        el.src = 'img/stop1.png';
                /*перевод кнопки сброса в состояние поднята*/
                document.getElementById("RESET").className = "button_off"; 		
                /*отключение кнопки*/
                document.documentElement.onmouseup = function(){that.className = "button_off";};
                }		
                   ;
                   break;
   /*АВАРИЯ ЗАСЛОНКА*/
           case "FAIL_VALVE_BTN":
    /*Организуем строку для передачи XMLHTTPrequest объекту для передачи базе данных*/
     /* номер установки (вентилятора) "fan_numer" определн выше*/
                   /*если установка не включена то работа кнопок заблокирована*/	
           /*проверяем включена ли установка если всключени то отключаем если нет то выход*/
                   var el_cool = document.getElementById('inc_ind');
                   if(el_cool.className !=="inc_ind_on"){ return;}
    /**СТРОКА которая заноситься в базу*/	
                   var str = "АВАРИЯ ЗАСЛОНКА. Установка «СТОП»";
    /*ИДЕНТИФИКАТОР элемента в который будут вставляться полученные с сервера данные*/	
                   var div_id = "scroll_area";
    /*определяем активную вкладку, что бы после абработкт вставить именно в нее*/	
           var tab = currentTable();			
    /*АДРЕС файла обработчика на сревере с прицепленными к нему данными  для массива GET[]
    -класс/метод- + id элемента на который нажали + строка с инф. + номер установки*/	
                   var target_name = 'obj=Journal/add&what='+el+'&str='+str+'&fan_num='+fan_number+'&id_table='+tab; 
   //alert(target_name);	
                           callServer(target_name, div_id);
    /*обращаемся к текущему элементу*/
                   var that = document.getElementById("FAIL_VALVE_BTN");
    /*меняем состояние с помощью клика*/           
                if(that.className === "button_on"){//если кнопка вжата
                                 that.className = "button_off";
                     }else if(that.className === "button_off"){//если кнопка отжата то есть выключена
                                 that.className = "button_on"; 
                     }
     /*меняем текст в элементах*/                              
                   var st_f = document.getElementById("SState_1");//надпись "СИСТЕМА В НОРМЕ" или другая

                if(that.className === "button_on"){
                     var st_f = document.getElementById("SState_1");	
                     st_f.innerHTML ="АВАРИЯ ЗАСЛОНКА";
                     st_f.style.color = "red";
                     var vl_1 = document.getElementById("VALVE_IND");
                     vl_1.innerHTML = "АВАРИЯ";
                     vl_1.style.cssText ="color:#fff; background-color:red; font-weight:bold";
    /****сообщаем window.opener что произошла АВАРИЯ  'red'   */

    /*остановка установки*/			
                            fun_on_off(false,'red',false);
    /*перевод рычажка в положение выключить*/		
                            var el = document.getElementById('img_start_stop');
                            el.src = 'img/stop1.png';
      /*перевод кнопки сброса в состояние поднята*/
                    document.getElementById("RESET").className = "button_off"; 		
    /*отключение кнопки*/
                    document.documentElement.onmouseup = function(){that.className = "button_off";};
                   }	 

                   ;
                   break;
   /*СБРОС АВАРИЙНЫХ КНОПОК*/		
           case"RESET": 
   /*Организуем строку для передачи XMLHTTPrequest объекту для передачи базе данных*/
    /* номер установки (вентилятора) "fan_numer" определн выше*/
    /**СТРОКА которая заноситься в базу*/	
                   var str = "Сброс в состояние - зима";
    /*ИДЕНТИФИКАТОР элемента в который будут вставляться полученные с сервера данные*/	
                   var div_id = "scroll_area";
    /*ТЕКУЩАЯ АКТИВНАЯ ВКЛАДКА*/	
           var tab = currentTable();		
    /*АДРЕС файла обработчика на сревере с прицепленными к нему данными 
    -класс/метод- + id элемента на который нажали + строка с инф. + номер установки*/	
                   var target_name = 'obj=Journal/add&what='+el+'&str='+str+'&fan_num='+fan_number+'&id_table='+tab; 
	
                           callServer(target_name, div_id);

   /****сообщаем window.opener что аварийные кнопки сброшены меняем цвет строки текущей установки    */
   var text_cont = document.getElementById("id_cont").textContent;
                var object = window.opener.document.getElementById(text_cont);
            for (var childItem in object.childNodes) {
             if (object.childNodes[childItem].nodeType === 1)
            object.childNodes[childItem].style.backgroundColor = '#eee';
            }
                object.childNodes[5].innerHTML = 'ОТКЛ.';		

                object.childNodes[5].innerHTML = 'ОТКЛ.';	
                var st_f = document.getElementById("SState_1");	
                st_f.innerHTML ="СИСТЕМА В НОРМЕ";
                st_f.style.color = "#37CD23";
                var md_1 = document.getElementById("MD_1");
                md_1.innerHTML = "НОРМА";
                md_1.style.cssText ="color:#fff; background-color:#5D7809; font-weight:bold";
                var f_1 = document.getElementById("F1");
                f_1.innerHTML = "НОРМА";
                f_1.style.cssText ="color:#fff; background-color:#5D7809; font-weight:bold";
                var trm = document.getElementById("THERM_IND");
                trm.innerHTML = "НОРМА";
                trm.style.cssText ="color:#fff; background-color:#5D7809; font-weight:bold";
                var vl_1 = document.getElementById("VALVE_IND");
                vl_1.innerHTML = "ЗАКР.";
                vl_1.style.cssText ="color:#fff; background-color:#6950B6; font-weight:bold";
                document.getElementById("RESET").className = "button_on"; 	
               ;
               break;


   /*УДАЛЕНИЕ СТРОКИ ИЗ БАЗЫ ДАННЫХ*/	
           case"delete_": 

                   break;
           }
/*строка прогресса*************************************************************************/
/*Функция запускающая строку прогресса на запуск и на остановку устройства при передаяи параметра
 * bin = false происходит остановка уствновки и при передачи параметра bin = true происходит 
 * запуск установки , текст строоки зависит от события аварийное оно или нет, в случае если аварийное 
 * то передается параметр is_alarm, если не аварийное то по умолчанию, параметр win_open 
 * принимает значение или red или green  передается когда надо передать на родительскую страницу 
 * (список устройств) сообщение о   запуске или остановке какого либо из устройств цветом строки 
 * и надписью "ВКЛ" или "ОТКЛ"
 * */
        function fun_on_off(bln, win_open,is_alarm ){

    /*ОТКЛЮЧЕНИЕ УСТАНОВКИ*/	
                if(!bln){//отключение установки
        /*создаем контейнер прогресс бара*/            
                var box = document.createElement('div');
                        box.style.cssText ="width:440px; height:160px; background-color:black; position:fixed;"+
                        "top:210px; left: 410px";
                        box.setAttribute('id','box');
        /*контейнер для прогресс бара*/
                       var str = document.createElement('div');
         /*Меняем надпись в заисимости от ситуации */		
                    if(is_alarm){
                            str.innerHTML = "ОСТАНОВКА УСТАНОВКИ";
                            str.style.cssText = "width:260px; color:#F4F2F5; margin:36px 100px 20px;word-spacing:8px;"+
                            " font-weight:bold; font-family:Arial, sans-serif; font-size:18px";
                    }else{
                            str.innerHTML = "<div style='text-align:center'>АВАРИЙНАЯ</div> <div style='text-align:center'>ОСТАНОВКА УСТАНОВКИ</div>";
                            str.style.cssText = "width:260px; color:#F4F2F5; margin:16px 100px 20px;word-spacing:8px;"+
                            " font-weight:bold; font-family:Arial, sans-serif; font-size:18px";
                    }	
                            //     str.setAttribute('id','str');
        /*контейннер для текста*/
                    var bar = document.createElement('div');
                            bar.style.cssText = "width:350px; height:38px; margin:25px auto;"+
                            "padding-left:6px; background-color:#969495";
                            //  bar.setAttribute('id','bar');
                            box.appendChild(str);
                            box.appendChild(bar);
        /*добавляем прогресс бар на страницу*/
                            var bd = document.documentElement;
                            bd.appendChild(box);
        /*вставляем саму строку прогресса*/
                    for(var i = 0; i < 18; i++){
                             var elem = document.createElement('div');	
                            elem.style.cssText = "width:16px; height:30px; "+
                            "float:left; background-color:#F0EEEF; margin:4px 1px";
                                            bar.appendChild(elem);
                    }	

        /*запускаем строку прогресса на выключение (исчезающие элементы)*/	
                            var inter = 150;//длительность интервала между вызовами функции				
                            var nn =0;
        /*установка иинтервала работы строки прогресса*/                    
                            interval = setInterval(function(){
                                    bar.removeChild(bar.lastChild); nn++ ;
                                    if(nn>17){clearInterval(interval);
                                    box.parentNode.removeChild(box);
                            ////////////////////////////////////////////////////	

    /*по окончанию строки  остановка  вентилятора	*/
                           fan_speed(null);
   /*сообщаем window.opener что установка ОТКЛЮЧЕНА и меняем цвет строки на списке устройств
    *  на краснй и текст вставлется "ОТКЛ" */

                if(win_open === 'red'){
                         var text_cont = document.getElementById("id_cont").textContent;
                         var object = window.opener.document.getElementById(text_cont);
                         for (var childItem in object.childNodes) {
                         if (object.childNodes[childItem].nodeType === 1)
                         object.childNodes[childItem].style.backgroundColor = '#D1667A';
                         }
                        object.childNodes[5].innerHTML = 'ОТКЛ.';		
                }			
 /*сообщаем window.opener что установка ВКЛЮЧЕНА и меняем цвет строки на списке устройств
  *  на зеленый и текст вставляется "ВКЛ" */
                   if(win_open === 'gray'){
                        var text_cont = document.getElementById("id_cont").textContent;
                        var object = window.opener.document.getElementById(text_cont);
                    for (var childItem in object.childNodes) {
                        if (object.childNodes[childItem].nodeType === 1)
                        object.childNodes[childItem].style.backgroundColor = '#eee';
                        }
                        object.childNodes[5].innerHTML = 'ОТКЛ.';		
                   }			
   /***********************************************************************/				

                   /*отключение картинки с потоком воздуха*/	
                        var el_cool = document.getElementById('inc_ind');
                        el_cool.className  = "inc_ind_off";
                        var el_out = document.getElementById('out_ind');
                        el_out.style.backgroundImage = "none";	

                     }/*clear inerval*/;	
                   }/*end off setInertval*/, inter);
                                               return;	

           }else{
           /*ЗАПУСК УСТАНОВКИ*/	
                   /*создаем элементы строки прогресса******************/
                           //
                    var box = document.createElement('div');
                    box.style.cssText ="width:440px; height:160px; background-color:black; position:fixed;"+
                    "top:210px; left: 410px";
                    box.setAttribute('id','box');

                    var str = document.createElement('div');
                    str.innerHTML = "ЗАПУСК  УСТАНОВКИ";
                    str.style.cssText = "width:240px; color:#F4F2F5; margin:36px 120px 20px;word-spacing:8px;"+
                    " font-weight:bold; font-family:Arial, sans-serif; font-size:18px";
                    str.setAttribute('id','str');

                    var bar = document.createElement('div');
                    bar.style.cssText = "width:350px; height:38px; margin:25px auto;"+
                    "padding-left:6px; background-color:#969495";
                    bar.setAttribute('id','bar');

                    box.appendChild(str);
                    box.appendChild(bar);

                    var bd = document.documentElement;
                    bd.appendChild(box);

            /*создаем элементы роста строки*/	
                    var inter = 150;//длительность интервала между вызовами функции				
                    var nn =0;
                    interval = setInterval(function(){
                      var elem = document.createElement('div');	
                    elem.style.cssText = "width:16px; height:30px; "+
                    "float:left; background-color:#F0EEEF; margin:4px 1px";
                        bar.appendChild(elem); nn++ ;
                if(nn>18){
                    clearInterval(interval);
                    box.parentNode.removeChild(box);

    /*Берем данные скорости вращения вентилятора из базы данных
                   и передаем функции регулирущейскорость вентилятора*/
                   var sp_win = parseInt(document.getElementById('pro').textContent);
                   var sp_win = 20/sp_win;
                           fan_speed(sp_win);

    /*включение картинки с потоком воздуха*/
                    var el_cool = document.getElementById('inc_ind');
                    el_cool.className ='inc_ind_on';
/****сообщаем window.opener что установка запущена***************** */
                var text_cont = document.getElementById("id_cont").textContent;
              var object = window.opener.document.getElementById(text_cont);
                   for (var childItem in object.childNodes) {
                   if (object.childNodes[childItem].nodeType=== 1)
                   object.childNodes[childItem].style.backgroundColor = '#ADD13D';
                   }	
                   object.childNodes[5].innerHTML = 'ВКЛ.';
   /***********************************************************************/	
                               var el_out = document.getElementById('out_ind');
                               el_out.style.backgroundImage = "url('img/out.png')";		

                               };	
                       }, inter);
               }
       }


                   //alert(el);
   };//end off onmousedown

   /*Переключатель вкладки журнала событий */

    function logging_on_off(in_id){
   //alert('In logging_on_off in_id = '+in_id);	
            var fan_number = document.getElementById('NAME').innerText;
            var mass = new Array("EVENT","ALARM","LOG","ALL");
//alert(in_id);
            var id_st  = document.getElementById(in_id);
            if(id_st.className === "button_off"){
                    id_st.className = "button_on"; 

   /*обращаемся к серверу для загрузки данныз в таблице*/
           /*переводим в нижний регистр для PHP метода*/		
            var status = in_id.toLowerCase();
        /*place - клас отвечающий за страницу,  status - елемент (соотвтетсвующя кнопка)*/                   
            var req = 'obj=Journal/'+status+'&fan_num='+fan_number;
 // alert(req);
                           callServer(req,"scroll_area");

   /*возвращаем остальные кнопки в исходное состояние*/			
                           for(var i=0; i < mass.length; i++){
                                   if(in_id !== mass[i]){ /*alert(document.getElementById(mass[i]).className+' - '+in_id);*/
                                           document.getElementById(mass[i]).className = "button_off";					
                                   }
                           }
                   }else{
                           id_st.className = "button_off";
                   }

                            document.body.onselectstart = null;
                   return false;	 
           }

   /* Создание нового объекта XMLHttpRequest для общения с Web-сервером */
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

   if (!xmlHttp && typeof XMLHttpRequest !== 'undefined') {
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

           // Установить функцию для сервера, которая выполнится после его ответа
             xmlHttp.onreadystatechange = function(){
   //alert('oneadystate = '+xmlHttp.readyState);
                             if (xmlHttp.readyState === 4) {
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

   /*ФУНКЦИЯ выбора id аблицы(вкладки) в зависимости от размещаемой там записи*/
           function chooseTable(){
                   var table_names = Array('FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
           }
   /*массив идентификаторов аварийных кнопок*/
   var table_names = Array('FAIL_F_BTN','FAIL_FREEZ_BTN','FAIL_VALVE_BTN','RESET');
   
   /*функции запрещающая выделение текста*/ 
   function disableSelection(target){
       if (typeof target.onselectstart!=="undefined") // для IE:
           target.onselectstart=function(){return false;};
       else if (typeof target.style.MozUserSelect!=="undefined") //для Firefox:
           target.style.MozUserSelect="none";
       else // для всех других (типа Оперы):
           target.onmousedown=function(){return false;};
       target.style.cursor = "default";
   }

   /*определяем АКТИВНУЮ вкладку (которая в данный момент открыиа)
           И ПЕРЕДАЕМ СЕРВЕРУ ДЛЯ ЗАГРУЗКИ  соотвтетствующей 
           этой вкладке СТРАНИЦЫ*/
           function currentTable(){
                   var mass = new Array("EVENT","ALARM","LOG","ALL");
                   for(var i=0; i<mass.length; i++){
                           var choose_el = document.getElementById(mass[i]);
                           if(choose_el.className === 'button_on')
                                   txt = mass[i].toLowerCase();
                   }
                   return txt;
           }	

   /*функция запрета выделения*/
   function disableSelection(target){ 
               if (typeof target.onselectstart!=="undefined") 
                  target.onselectstart=function(){return false;}; 
               else if (typeof target.style.MozUserSelect!=="undefined")  
                  target.style.MozUserSelect="none" ;
               else target.onmousedown=function(){return false;} ;
                                   target.style.cursor = "default" ;

           if (document.getElementById("noselect"))  
               disableSelection(document.getElementById("noselect")); 
           } 

   /*Функция определения типа браузера*/
   function browser(){
       var ua = navigator.userAgent;

       if (ua.search(/MSIE/) > 0) return 'IE';
       if (ua.search(/Firefox/) > 0) return 'Firefox';
       if (ua.search(/Opera/) > 0) return 'Opera';
       if (ua.search(/Chrome/) > 0) return 'Google Chrome';
       if (ua.search(/Safari/) > 0) return 'Safari';
       if (ua.search(/Konqueror/) > 0) return 'Konqueror';
       if (ua.search(/Iceweasel/) > 0) return 'Debian Iceweasel';
       if (ua.search(/SeaMonkey/) > 0) return 'SeaMonkey';

       // Браузеров очень много, все вписывать смысле нет, Gecko почти везде встречается
       if (ua.search(/Gecko/) > 0) return 'Gecko';

       // а может это вообще поисковый робот
       return 'Search Bot';
   }

   /*ФУНКЦИЯ изменяющая скорость вращениея вентилятора*/
           function fan_speed(sp){
   //	 
            /*сылка на малый вентилятор*/
            var lt_fan = document.getElementById('fan_1');
            /*сылка на большой венилятор*/
             var bg_fan = document.getElementById('fan_2');
           var what = browser().toUpperCase();
                   if (what === 'GECKO'){
   //alert('In fan_speed() sp -'+sp);			
                           lt_fan.style.cssText = "-ms-animation: spin "+sp+"s infinite linear";	
                           bg_fan.style.cssText = "-ms-animation: spin "+sp+"s infinite linear";
                   }else if(what === "GOOGLE CHROME"){
                           lt_fan.style.cssText = "-webkit-animation: spin "+sp+"s infinite linear";	
                           bg_fan.style.cssText = "-webkit-animation: spin "+sp+"s infinite linear";
                   }else if(what === "FIREFOX"){
                           lt_fan.style.cssText = "-moz-animation: spin "+sp+"s infinite linear";
                           bg_fan.style.cssText = "-moz-animation: spin "+sp+"s infinite linear";
                   }else {
                           lt_fan.style.cssText = "animation: spin "+sp+"s infinite linear";
                           bg_fan.style.cssText = "animation: spin "+sp+"s infinite linear";
                   }

           }

   /*


   var object = window.opener.document.getElementById('list');
   //alert(object.childNodes[1].childNodes[1].childNodes[1].textContent);
           for (var childItem in object.childNodes){

                   if(object.childNodes[childItem].hasChildNodes()){
   alert(object.childNodes[childItem].childNodes[1].childNodes[1].textContent);
   alert('fan_number -'+fan_number);
                           var txt_cont = object.childNodes[childItem].childNodes[1].childNodes[1].textContent;

   alert('txt -'+txt_cont+' -fan_number.slice(1)-'+fan_number.slice(1)+'-W '+txt_cont.slice(0));

                           if(txt_cont == fan_number){
   alert('In IF');				
                                   for (var childItem in object.childNodes[childItem]) {
                                   object.childNodes[childItem].style.backgroundColor = '#ADD13D';
                                   }
                           }
                   }	
           }	

   */




