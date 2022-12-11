<?php
$con = mysqli_connect('localhost', 'root', '', 'fishing');
 
if (!$con)
{
	echo "Не подключается БД, ошибка какая-то! <br>";
	echo mysqli_connect_error();
	exit();
}

if(session_id() == '') {
    session_start();
}

?>