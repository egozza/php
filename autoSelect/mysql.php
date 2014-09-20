<?php
/////////////////////////////////////////////////////
include "common_db.inc";
include "functions/function.php";



class MySQL
{


 	private $NameObject,$NameTable,$LinkId,$MassTAble=array();
function __construct()
{


}
function UpdateString($NameBase,$NameTable,$Set,$Where) // Функция обновления строки
{

if(empty($NameBase))
		{
		
			conprint("НЕ ЗАДАННО ИМЯ БАЗЫ ДАННЫХ ПРИ ОБНОВЛЕНИИ СТРОКИ: ","0");
			return false;
		}
		if(empty($NameTable))
		
		{
			conprint("НЕ ЗАДАННО ИМЯ ТАБЛИЦЕ ПРИ ОБНОВЛЕНИИ СТРОКИ: ","0");
			return false;
		}

			$string="UPDATE  ".$NameTable." SET ".$Set;


			if(!empty($Where))
			$string.=" WHERE ".$Where;

			$this->CreateConection($NameBase);

					if($this->Query($string))
					{   conprint("ОБНОВЛЕНИЕ СТРОКИ В ТАБЛИЦЕ: ".$NameTable,"1");
						return true;
					}
					else{
						conprint("ОБНОВЛЕНИЕ СТРОКИ В ТАБЛИЦЕ: ".$NameTable,"0");
						return false;
					}



}



function InsertString($NameBase,$NameTable,$array)//функция вставки строки
{
		if(empty($NameBase))
		
		{
			conprint("НЕ ЗАДАННО ИМЯ БАЗЫ ДАННЫХ ПРИ ВСТАВКИ СТРОКИ: ","0");
			return false;
		}
		if(empty($NameTable))
		{
			conprint("НЕ ЗАДАННО ИМЯ ТАБЛИЦЕ ПРИ ВСТАВКИ СТРОКИ: ","0");
			return false;
		}
		$flag=false;
			$string="INSERT INTO ".$NameTable." (";
			foreach ($array as $key => $value) {
				if($flag){
			$string.=",".$key;

		        }	
		        else{
		        	$string.=$key;
		        	$flag=true;
		        }
			}
			$flag=false;
			$string.=") VALUES(";
foreach ($array as $key => $value) {
			if($flag){
			$string.=",'".$value."'";

		        }	
		        else{
		        	$string.="'".$value."'";
		        	$flag=true;
		        }
			}
			$string.=")";
				
				$this->CreateConection($NameBase);
						if($this->Query($string))
					{   conprint("СОЗДАНИЕ НОВОЙ СТРОКИ В ТАБЛИЦЕ: ".$NameTable,"1");
					
						return true;
					}
					else{
						
						conprint("СОЗДАНИЕ НОВОЙ СТРОКИ В ТАБЛИЦЕ: ".$NameTable,"0");
						return false;
					}





}

function GetTable($NameBase,$NameTable,$NameColomn,$Where)// функция получения выборки из таблицы
{
	$this->MassTAble=array();
		if(empty($NameBase))
			{
			conprint("НЕ ЗАДАННО ИМЯ БАЗЫ ДАННЫХ ПРИ ПОЛУЧЕНИЕ ВЫБОРКИ: ","0");
			return false;
		}
		if(empty($NameTable))
			{
			conprint("НЕ ЗАДАННО ИМЯ ТАБЛИЦЕ ПРИ ПОЛУЧЕНИЕ ВЫБОРКИ: ","0");
			return false;
		}
		$string="SELECT ";
		
				
					if(empty($NameColomn))
						$string.=" * FROM ".$NameTable;
					else 
						$string.=$NameColomn." FROM ".$NameTable;
				
			

				   if(!empty($Where))
						$string.=" WHERE ".$Where;
				   

				
		

		$this->CreateConection($NameBase);
		
		$result=$this->Query($string);

		
		if($result==false)
		{
				  conprint("ПОЛУЧЕНИЕ ВЫБОРКИ ИЗ ТАБЛИЦЫ: ".$NameTable,"0");
				  return false;
					}	
				
				else
				{	
		while($DataQuery=mysql_fetch_array($result,MYSQL_ASSOC))
		{
		
			array_push($this->MassTAble, $DataQuery);


		}
			
					
		conprint("ПОЛУЧЕНИЕ ВЫБОРКИ ИЗ ТАБЛИЦЫ: ".$NameTable,"1");
					
		return $this->MassTAble;
						
}

}
function CreateTable($NameBase,$NameTable,$CreateObjects)// Создание таблицы
{

		if(empty($NameBase))
		{
			conprint("НЕ ЗАДАННО ИМЯ БАЗЫ ДАННЫХ ПРИ СОЗДАНИИ ТАБЛИЦЫ: ","0");
			return false;
		}
		if(empty($NameTable))
			{
			conprint("НЕ ЗАДАННО ИМЯ ТАБЛИЦЕ ПРИ СОЗДАНИИ ТАБЛИЦЫ: ","0");
			return false;
		}
		
		$string="CREATE TABLE `".$NameTable."` (";
		if(empty($CreateObjects))
		{
			conprint("НЕ ЗАДАННЫ ПАРАМЕТРЫ ДЛЯ СОЗДАНИЯ ТАБЛИЦЫ: ","0");
			return false;
		}
		else
			$string.=$CreateObjects.")";

				
		
		


		$this->CreateConection($NameBase);
		
	if($this->Query($string))
					{   conprint("СОЗДАНИЕ ТАБЛИЦЫ В БАЗЕ: ".$NameBASE,"1");
						return true;
					}
					else{
						 conprint("СОЗДАНИЕ ТАБЛИЦЫ В БАЗЕ: ".$NameBASE,"0");
						return false;
					}


}

function CreateView($NameBase,$NameTable,$CreateObjects)// Создание таблицы
{

		if(empty($NameBase))
		{
			conprint("НЕ ЗАДАННО ИМЯ БАЗЫ ДАННЫХ ПРИ СОЗДАНИИ ТАБЛИЦЫ: ","0");
			return false;
		}
		if(empty($NameTable))
			{
			conprint("НЕ ЗАДАННО ИМЯ ТАБЛИЦЕ ПРИ СОЗДАНИИ ТАБЛИЦЫ: ","0");
			return false;
		}
		
		$string="CREATE VIEW  `".$NameTable."` ";
		if(empty($CreateObjects))
		{
			conprint("НЕ ЗАДАННЫ ПАРАМЕТРЫ ДЛЯ СОЗДАНИЯ ТАБЛИЦЫ: ","0");
			return false;
		}
		else
			$string.=$CreateObjects;

				
		
		


		$this->CreateConection($NameBase);
		
	if($this->Query($string))
					{   conprint("СОЗДАНИЕ ПРЕДСТАВЛЕНИЯ В БАЗЕ: ".$NameBASE,"1");
						return true;
					}
					else{
						 conprint("СОЗДАНИЕ ПРЕДСТАВЛЕНИЯ В БАЗЕ: ".$NameBASE,"0");
						return false;
					}


}
function CreateBaseData($NameBase){
	if(empty($NameBase))
		{
			conprint("НЕ ЗАДАННО ИМЯ БАЗЫ ДАННЫХ ПРИ СОЗДАНИИ ТАБЛИЦЫ: ","0");
			return false;
		}
		if($this->Query("CREATE DATABASE `$NameBase` DEFAULT CHARACTER SET 'utf8'"))
			return true;
		else
			return false;
}

function Query($string)//ФУНКЦИЯ ЗАПРОСА К БАЗЕ
{
	header('Content-type: text/html; charset=utf-8');
	mysql_query ("set character_set_client='utf8'");  
	mysql_query ("set character_set_results='utf8'");  
	mysql_query ("set collation_connection='utf8_general_ci'"); 
	
	 conprint("СОЗДАНИЕ ТАБЛИЦЫ В БАЗЕ: ". $string,"0");
  if(!$result=mysql_query($string,$this->LinkId))
   conprint("ЗАПРОС В БАЗУ ДАННЫХ".mysql_error(),"0");
else
	return $result;
  
		


}


function CreateConection($Base)
{

		$this->LinkId=db_connect($Base);//СОЗДАНИЕ СЕДИНЕНИЯ

		 


}


function RemoveTable($NameBase,$NameTable)// УДАЛЕНИЕ ТАБЛИЦЫ
{

	if(empty($NameBase))
			{
			conprint("НЕ ЗАДАННО ИМЯ БАЗЫ ДАННЫХ ПРИ УДАЛЕНИИ ТАБЛИЦЫ: ","0");
			return false;
		}
		if(empty($NameTable))
			{
			conprint("НЕ ЗАДАННО ИМЯ ТАБЛИЦЕ ПРИ УДАЛЕНИИ ТАБЛИЦЫ: ","0");
			return false;
		}
		$string="DROP TABLE `".$NameTable."`";
		
conprint($string,"0");
		$this->CreateConection($NameBase);
		
			if($this->Query($string))
					{   conprint("УДАЛЕНИЕ ТАБЛИЦЫ: ".$NameTable,"1");
						return true;
					}
					else{
						  conprint("УДАЛЕНИЕ ТАБЛИЦЫ:".$NameTable,"0");
						return false;
					}



}



function RemoveString($NameBase,$NameTable,$Where)//ФУНКЦИЯ УДАЛЕНИЯ СТРОКИ
{
	if(empty($NameBase))
		{
			conprint("НЕ ЗАДАННО ИМЯ БАЗЫ ДАННЫХ ПРИ УДАЛЕНИИ СТРОКИ: ","0");
			return false;
		}
		if(empty($NameTable))
		{
			conprint("НЕ ЗАДАННО ИМЯ ТАБЛИЦЕ ПРИ УДАЛЕНИИ СТРОКИ: ","0");
			return false;
		}
		$string="DELETE FROM ".$NameTable;
		
				
				

				   if(empty($Where))
				   {
						conprint("НЕ ЗАДАННО WHERE ПРИ УДАЛЕНИИ СТРОКИ: ","0");
				   }
				    else
					$string.=" WHERE ".$Where;
				
		

		$this->CreateConection($NameBase);
		
			if($this->Query($string))
					{   conprint("УДАЛЕНИЕ СТРОКИ ИЗ ТАБЛИЦЫ: ".$NameTable,"1");
						return true;
					}
					else{
						  conprint("УДАЛЕНИЕ СТРОКИ ИЗ ТАБЛИЦЫ:".$NameTable,"0");
						return false;
					}



}

function 	GetIdInsert()// Получения последнего ID 
{
		$this->CreateConection("DataBase");
		return mysql_insert_id();




}
}


////////////////////////////////////////////////////////
////////////////////////////////////////////////////////
?>