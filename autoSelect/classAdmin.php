<?php
include 'mysql.php';
class AdminServer{
	/**
	 * $mysql
	 * @var object MySQL() объект класса 
	 */

	private $mysql;
	
	
	/**
	 * $NameBase
	 * @var string имя базы данных
	 */
	private $NameBase;
	/**
	 * $NameTable
	 * @var string имя таблицы
	 */
	private $NameTable;
	/**
	 * Конструктор класса AdminServer
	 * @var object MySQL() объект класса 
	 */
	function __construct($NameBase=null,$NameTable=null)
	{
		$this->NameBase=$NameBase;
		$this->NameTable=$NameTable;
		$this->mysql=new MySQL();
		

	}
	public function parseString(){

		switch ($_POST['metod']) {
			case 'get':
					return json_decode($this->getString($_POST['string']));
				break;
			
			case 'set':

				return $this->setString($_POST['string']);
				break;
		}
	}
	/**
	 * Функция получения выборки из базы данных
	 * @var $string string строка для поиска
	 * @return array  
	 */
	public function getString($string){
		if(!strlen($string))
		throw new Exception("Не заданна строка для поиска в базе данных");
	 $mass=$this->mysql->GetTable($this->NameBase,$this->NameTable,null,"string LIKE '%$string%'");
	 
	 if($mass)
	echo json_encode($mass);
		else
		echo "noTable";
	}

	/**
	 * Функция записи строки в базу данных
	 * @return array  
	 */
	public function setString($string){

		if(!strlen($string))
			throw new Exception("Не заданна строка для добавления в базу данных");
			
		if($this->mysql->InsertString($this->NameBase,$this->NameTable,array("string"=>$string)))
			{echo "ok";

			}

		else 
			throw new Exception("Произошла ошибка при добавлении строки в базуданных");

	}
}
?>