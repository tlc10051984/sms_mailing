<?php
class DB_conect{
	const DB_HOST ='localhost';
	const DB_LOGIN ='root';
	const DB_PASSWORD ='';
	const DB_NAME ='bd_sms';

	function __construct(){
		//подключаемся к БД
		$this->link= new mysqli(self::DB_HOST, self::DB_LOGIN, self::DB_PASSWORD, self::DB_NAME);
		if ($link->connect_errno) {
			printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
			exit();
		}
	}
}
?>