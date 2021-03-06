<?php
	include_once 'Table.php';

	class ODITVVersions extends Table {

                private $Table_Name;
                private $IdField = "Id";
                private $VersionField = "Version";
                private $Version = "";
                private $Id = 0;

                function __construct() {
			$this->Table_Name = $this->getODITVVersionsTable();
			$db = new Database();
			$this->pdo = $db->PDOConnect();
                }

                function getVersionById($Id) {
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

                public function getIdByVersion($version) {
                        if (is_string($version)) {
                                $this->Version = $version;
                        } else {
                                $this->Version = 0;
                                return "ERROR: Ver:".$version." is invalid!";
                        }

                        try {
                                $stmt = $this->pdo->prepare('SELECT ' . $this->IdField . ' FROM ' . $this->Table_Name .
                                                            ' WHERE ' . $this->VersionField . ' = :Version');
                                $stmt->bindParam(':Version', $version);
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
                        return $this->Id;
                }


		function getVersion() {
			return $this->Version;
		}

		function getId() {
			return $this->Id;
		}
	}

?>
