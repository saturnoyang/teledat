<head>
<script language="javascript" src="calendar/calendar.js"></script>
</head>
<body>
<form action="prueba1.php" method="post">
<?php
$theDate = isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
echo "fecha enviada: ".$theDate."<br>\n";


//get class into the page
require_once('calendar/classes/tc_calendar.php');
$year3 = date("Y")+3;

//instantiate class and set properties
$myCalendar = new tc_calendar("fnac", true);
$myCalendar->setPath("calendar/");
$myCalendar->setTimezone("America/Santiago");
$myCalendar->setYearInterval(1940, $year3 );
$myCalendar->setIcon("calendar/images/iconCalendar.gif");
//output the calendar
$myCalendar->writeScript();	  


?>

<input type='submit' name='button' id='button' value='Guardar y Continuar' />
</form>
</body>     