<?php




//echo "$tireqty";

//echo "$oilqty";

 

  require ('page_6.inc');

  

  

    

  class OrderformPage extends Page

  {

    var $row2buttons = array( 'Re-engineering' => 'orderform_6.php',

                              'Standards Compliance' => 'orderform_6.php',

                              'Buzzword Compliance' => 'buzzword.php', 

                              'Mission Statements' => 'mission.php'

                            );

// var $tireqty ;

// var $oilqty ;

// var $sparkqty ;

// var $address ;

    




    function Display_1($tireqty)

    {




      //$this->tireqty=$tireqty ;




      //echo $this->tireqty;




        echo $tireqty; }







    

    function Display($tireqty, $oilqty, $sparkqty, $address, $DOCUMENT_ROOT, $fio)

    {

      echo "<html>\n<head>\n";

      $this -> DisplayTitle();

      $this -> DisplayKeywords();

      $this -> DisplayStyles();

      echo "</head>\n<body>\n";

      $this -> DisplayHeader();

      $this -> DisplayMenu($this->buttons);

      $this -> DisplayMenu($this->row2buttons);

?> <table width=100% height=100% border=1><tr><td class=cont > <? echo $this->zakaz($tireqty, $oilqty, $sparkqty, $address, $DOCUMENT_ROOT, $fio); ?> </td></table> <?







      $this -> DisplayFooter();

      //echo "</body>\n</html>\n";

    }



















function zakaz($tireqty, $oilqty, $sparkqty, $address, $DOCUMENT_ROOT, $fio)

{




// <?php




  // Создать короткие имена переменных

  //$tireqty = $HTTP_POST_VARS['tireqty'];

  //$oilqty = $HTTP_POST_VARS['oilqty'];

  //$sparkqty = $HTTP_POST_VARS['sparkqty'];

  //$address = $HTTP_POST_VARS['address'];

  //$DOCUMENT_ROOT = $HTTP_SERVER_VARS['DOCUMENT_ROOT'];













//подключаемся к базе данных




$hostname="localhost";

$user="root";

//$password="root";

$db="lab3";




if(!$link = mysql_connect($hostname, $user, $password))




{

//echo "<br> Не могу соединиться с сервером базы данных <br>";

exit();

}

//echo "<br> Cоедининение с сервером базы данных прошло успешно <br>";







if (!mysql_select_db($db, $link))

{ 

//echo "<br> Не могу выбрать базу данных<br>";

exit();

}

else

{

//echo "<br> Выбор базы данных прошел успешно <br>";

}




?>




<h2>Автозапчасти от Боба</h2>

<h3>Результаты заказа</h3>




<?php 

  $totalqty = 0;

  $totalqty += $tireqty;

  $totalqty += $oilqty;

  $totalqty += $sparkqty;

  

  $totalamount = 0.00;

 

  define('TIREPRICE', 100);

  define('OILPRICE', 10);

  define('SPARKPRICE', 4);




  $date = date('H:i, jS F');

 

  echo '<p>Заказ обработан в ';

  echo $date;

  echo '<br />';

  echo '<p>Список вашего заказа:';

  echo '<br />';




  if( $totalqty == 0 )

  {

    echo 'Вы ничего не заказали на предыдущей странице!<br />';

  }

  else

  {

    if ( $tireqty>0 )

      echo $tireqty.' автопокрышек<br />';

    if ( $oilqty>0 )

      echo $oilqty.' бутылок с маслом<br />';

    if ( $sparkqty>0 )

      echo $sparkqty.' свечей зажигания<br />';

  }




  $total = $tireqty * TIREPRICE + $oilqty * OILPRICE + $sparkqty * SPARKPRICE; 

  $total=number_format($total, 2, '.', ' ');

 

  echo '<P>Итого по заказу: '.$total.'</p>';




  echo '<P>ФИО клиента: '.$fio.'</p>';

  

  echo '<P>Адрес доставки: '.$address.'<br />';




  $outputstring = $date."\t".$tireqty." автопокрышек \t".$oilqty." масла\t"

                  .$sparkqty." свечей\t\$".$total

                  ."\t Адрес доставки товара\t ". $address."\t ФИО клиента:".$fio." \n";




  // Открыть файл для добавления

  




$date_1=date ( "Y-m-d H:i:s",mktime ());







$query="insert into zakaz (fio,adress,data) values ('$fio','$address','$date_1')";

$result=mysql_query ($query);










$query_1="select zakaz.id  from zakaz where  zakaz.fio='$fio' ";

$result_1=mysql_query ($query_1);




while ($row=mysql_fetch_array ($result_1)) {




$id=$row["id"];




}




$query="insert into tovar (id, tiregty,oilgty,sparkgty) values ('$id','$tireqty','$oilqty','$sparkqty')";

$result=mysql_query ($query);







echo '<p>Заказ сохранен.</p>'; 




?>




<a href="vieworders_password_6.php"> Интерфейс персонала для просмотра файла заказов </a> <?}}













$services = new OrderformPage();

$content ='cddc';







$services -> SetContent($content);




$services -> SetTitle('Лабораторная работа по теме: ООП на РНР');

$services -> Setnazvanie('Лабораторные работы по курсу Разработка интернет приложений в сфере коммерциии посредством PHP и MySQL <br> Студента группы ПИ-83: Иванова Виталия Владимировича <br> Проверил: к.т.н. доц. Назимов А.С.');







//$services -> Display_1($tireqty);

 

 $services -> Display($tireqty, $oilqty, $sparkqty, $address, $DOCUMENT_ROOT, $fio);




// $services -> zakaz($tireqty, $oilqty, $sparkqty, $address, $DOCUMENT_ROOT, $fio);













?>

