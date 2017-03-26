<?php

class Config {
	private $APP_BASE_PATH = "";
	private $DBHost = 'oditvdb.cluevey3zbhk.us-west-2.rds.amazonaws.com';
	private $DBName   = 'ODITV';
	private $DBUserName = 'ODIMaster007TV';
	private $DBPassword = '#ODI1999TV';
	private $charset = 'utf8';

	function __construct() {
		$this->APP_BASE_PATH = "/var/www/html/oditv";
	}
	function getAPPBASEPATH() {
		return $this->APP_BASE_PATH;
	}
	function getDBHost() {
		return $this->DBHost;
	}
	function getDBName() {
		return $this->DBName;
	}	
	function getDBUserName() {
		return $this->DBUserName;
	}
	function getDBPassword() {
		return $this->DBPassword;
	}
	function getCharset() {
		return $this->charset;
	}
}

?>
