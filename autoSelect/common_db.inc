<?php
$dbhost = 'localhost';
$dbusername = 'admin';
$dbuserpassword = 'admin';
$default_dbname = 'DataBase';
$MYSQL_ERRNO = '';
$MYSQL_ERROR = '';


function db_connect($dbname) {
	
global $dbhost, $dbusername, $dbuserpassword, $default_dbname;
global $MYSQL_ERRNO, $MYSQL_ERROR;
$link_id = mysql_connect($dbhost, $dbusername, $dbuserpassword);
if(!$link_id) 
{
$MYSQL_ERRNO = 0;

$MYSQL_ERROR = " $data_error: Не удалось подключиться к узлу $dbhost.";
return 0;
}
else 
	if(!empty($dbname))
		if(!mysql_select_db($dbname)) {
			echo $dbname;
$MYSQL_ERRNO = mysql_errno();

$MYSQL_ERROR = mysql_error();
return 0;
}
else 
	return $link_id;
}
function sql_error() {
global $MYSQL_ERRNO, $MYSQL_ERROR;
if(empty($MYSQL_ERROR)) {
$MYSQL_ERRNO = mysql_errno();
$MYSQL_ERROR = mysql_error();
}
return "$MYSQL_ERRNO: $MYSQL_ERROR";
}
?>



