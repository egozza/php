
<?php
function conprint($data,$type)
{
	switch ($type) {
		case '1':
			$string="OK 		".$data;
			$string.="     время:". date("H:i:s")." и дата:". date("m.d.y") ."\n";
	file_put_contents('logOK.txt',$string,FILE_APPEND);
			break;
		
		case '0':
			$string="ERROR      ".$data;
			$string.="     время:". date("H:i:s")." и дата:". date("m.d.y") ."\n";
	file_put_contents('logERROR.txt',$string,FILE_APPEND);
	break;
		case 'server':
		$string="SERVER      ".$data;
			$string.="     время:". date("H:i:s")." и дата:". date("m.d.y") ."\n";
	file_put_contents('server/ServerLog.txt',$string,FILE_APPEND);
		break;
	}
	
}
function CreateValueTwo($NameValue,$Type)// ОЧИСТКА ПЕРЕМЕНОЙ ОТ тегов
{
	


	switch($Type)
	{
	case 'Var':		
	return strip_tags($_POST[$NameValue]);
	break;
	case 'Array':
	return $_POST[$NameValue];
	break;
	default:
	return strip_tags($_POST[$NameValue]);
	break;



}



}
function CreateValue($NameValue,$Type)// ОЧИСТКА ПЕРЕМЕНОЙ ОТ тегов
{
	
	
request_url();
	

	switch($Type)
	{

	case 'Var':		
	return strip_tags($_REQUEST[$NameValue]);
	break;
	case 'Array':
	 return json_decode(trim(file_get_contents('php://input')), true);

	 
	break;
	default:
	return strip_tags($_REQUEST[$NameValue]);
	break;



}



}
function request_url()
{
  $result = ''; // Пока результат пуст
  $default_port = 80; // Порт по-умолчанию
 
  // А не в защищенном-ли мы соединении?
  if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
    // В защищенном! Добавим протокол...
    $result .= 'https://';
    // ...и переназначим значение порта по-умолчанию
    $default_port = 443;
  } else {
    // Обычное соединение, обычный протокол
    $result .= 'http://';
  }
  // Имя сервера, напр. site.com или www.site.com
  $result .= $_SERVER['SERVER_NAME'];
 
  // А порт у нас по-умолчанию?
  if ($_SERVER['SERVER_PORT'] != $default_port) {
    // Если нет, то добавим порт в URL
    $result .= ':'.$_SERVER['SERVER_PORT'];
  }
  // Последняя часть запроса (путь и GET-параметры).
  $result .= $_SERVER['REQUEST_URI'];
  // Уфф, вроде получилось!
  $arrayUrl=parse_url($result);
	$path=explode(":",$arrayUrl["path"]);
	$result=explode("/",$path[1]);
	
  return $result;
}

function generateCode($length=6) {

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";

    $code = "";

    $clen = strlen($chars) - 1;  
    while (strlen($code) < $length) {

            $code .= $chars[mt_rand(0,$clen)];  
    }

    return $code;

}



?>