<?php

class DB {
	
	protected static $connection;
	
	private static $dbHost = 'localhost';
	private static $dbName = 'library';
	private static $dbUser = 'root';
	private static $dbPass = '';
	
	private function __construct() {
	}
	
	public static function getConnection() {
		if (! self::$connection) {
			self::$connection = new PDO ( 'mysql:host=' . self::$dbHost . ';dbname=' . self::$dbName,
					self::$dbUser, self::$dbPass, 
					[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] );
		}
		
		return self::$connection;
	}
	public static function query($sql, $params) {
		$sth = self::getConnection ()->prepare ( $sql );
		$sth->execute ( $params );

		if (stripos(substr($sql, 0, 8), 'SELECT') !== false) {
			return $sth->fetchAll(PDO::FETCH_ASSOC);
		}
	}
	public static function queryBind($sql, $params) {
		$sth = self::getConnection ()->prepare ( $sql );
		foreach ($params as $key => $value){
			$sth->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
			//me so smart :D
		}
		
		$sth->execute ();

		if (stripos(substr($sql, 0, 8), 'SELECT') !== false) {
			return $sth->fetchAll(PDO::FETCH_ASSOC);
		}
	}
}