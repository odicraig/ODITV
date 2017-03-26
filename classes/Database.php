<?php
	require_once 'config/Config.php';
        class Database {
                private $DBHost;
                private $DBName;
                private $DBUsername;
                private $DBPassword;
                private $charset;
                private $dsn;
                private $opt;
                private $pdo;

                function __construct() {
			$config = new Config();
                        $this->DBHost = $config->getDBHost();
                        $this->DBName = $config->getDBName();
                        $this->DBUsername = $config->getDBUserName();
                        $this->DBPassword = $config->getDBPassword();
                        $this->charset = $config->getCharset();
                        $this->dsn = "mysql:host=".$this->DBHost.";dbname=".$this->DBName.";charset=".$this->charset;
                        $this->opt = [
                                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                                PDO::ATTR_EMULATE_PREPARES   => false
                        ];
		}

		function PDOConnect() {
			try {
                        	$this->pdo = new PDO($this->dsn, $this->DBUsername, $this->DBPassword, $this->opt);
			} catch  (PDOException $e) {
				print "Error!: " . $e->getMessage() . "<br/>";
				die();
			}
                        unset ($this->DBUserName, $this->DBPassword, $DBUsername, $DBPassword);
			return $this->pdo;
                }
	}
?>
