<?php
	include_once 'Table.php';

	class OSVersions extends Table {

                private $Table_Name;
                private $IdField = "Id";
                private $VersionField = "Version";
                private $OSField = "OS";
                private $NameField = "Name";
                private $Version = "";
                private $Id = 0;
                private $OS = "";
		private $Name = "";

                function __construct() {
			$this->Table_Name = $this->getOSVersionsTable();
			$db = new Database();
			$this->pdo = $db->PDOConnect();
                }

		public function setName($name) {
			$this->Name = $name;
		}
	
                public function setOS($os) {
                        $this->OS = $os;
                }

		public function setVersion($version) {
			$this->Version = $version;
		}

                public function getVersionById($Id) {
			if (is_int($Id)) {
				$this->Id = $Id;
			} else {
				$this->Id = 0;
				return "ERROR: ID:".$Id." is invalid!";
			}

			try {
                                $stmt = $this->pdo->prepare('SELECT ' . $this->VersionField . ' FROM ' . $this->Table_Name .
                                                            ' WHERE ' . $this->IdField . ' = :Id');
                                $stmt->bindParam(':Id', $Id);
                                $stmt->execute();
                        } catch  (PDOException $e) {
                                print "Error!: " . $e->getMessage() . "<br/>";
                                die();
                        }
                       	$row = $stmt->fetch();
			$this->Version = "ERROR: Id ".$Id." Not Found";
			if (count($row) > 0 ) {
				$this->Version= $row[$this->VersionField];
			}
                        return $this->Version;

                }

                function getOSById($Id) {
                        if (is_int($Id)) {
                                $this->Id = $Id;
                        } else {
                                $this->Id = 0;
                                return "ERROR: ID:".$Id." is invalid!";
                        }

                        try {
                                $stmt = $this->pdo->prepare('SELECT ' . $this->OSField . ' FROM ' . $this->Table_Name .
                                                            ' WHERE ' . $this->IdField . ' = :Id');
                                $stmt->bindParam(':Id', $Id);
                                $stmt->execute();
                        } catch  (PDOException $e) {
                                print "Error!: " . $e->getMessage() . "<br/>";
                                die();
                        }
                        $row = $stmt->fetch();
                        $this->OS = "ERROR: Id ".$Id." Not Found";
                        if (count($row) > 0 ) {
                                $this->OS = $row[$this->OSField];
                        }
                        return $this->Version;

                }

		public function getOS() {
			return $this->OS;
		}

		public function getVersion() {
			return $this->Version;
		}

		public function getId() {
			if ( ($this->Id == 0) && (strlen($this->Version) > 0) && (strlen($this->OS) > 0) ) {
                        try {
                                $stmt = $this->pdo->prepare('SELECT ' . $this->IdField . ' FROM ' . $this->Table_Name .
                                                            ' WHERE ' . $this->OSField . ' = :OS AND ' . $this->VersionField . ' = :Version');
                                $stmt->bindParam(':OS', $this->OS);
                                $stmt->bindParam(':Version', $this->Version);
                                $stmt->execute();
                        } catch  (PDOException $e) {
                                print "Error!: " . $e->getMessage() . "<br/>";
                                die();
                        }
                        $row = $stmt->fetch();
                        $this->Id = 0;
                        if (count($row) > 0 ) {
                                $this->Id = $row[$this->IdField];
                        }
	
			}
			return $this->Id;
		}

		public function getName() {
			return $this->Name;
		}
	}

?>
