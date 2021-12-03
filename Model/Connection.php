<?php

class Connection
{

	public static function connect()
	{

		try {

			$cnx = new PDO("mysql:host=localhost;dbname=mvc_app", "root", "");
			$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$cnx->exec("SET CHARACTER SET UTF8");
		} catch (Exception $e) {

			die("Error " . $e->GetMessage());
		}

		return $cnx;
	}
}
