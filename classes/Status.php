<?php
	include_once 'Table.php';

	class Status extends Table {

                private $Table_Name;
                private $IdField = "Id";
                private $StatusField = "Status";
                private $Status = "";
                private $Id = 0;

                function __construct() {
			$this->Table_Name = $this->getStatusTable();
			$db = new Database();
			$this->pdo = $db->PDOConnect();
                }

                function getStatusById($Id) {
			if (is_int($Id)) {
				$this->Id = $Id;
			} else {
				$this->Id = 0;
				return "ERROR: ID:".$Id." is invalid!";
			}

			try {
                                $stmt = $this->pdo->prepare('SELECT ' . $this->StatusField . ' FROM ' . $this->Table_Name .
                                                            ' WHERE ' . $this->IdField . ' = :Id');
                                $stmt->bindParam(':Id', $Id);
                                $stmt->execute();
                        } catch  (PDOException $e) {
                                print "Error!: " . $e->getMessage() . "<br/>";
                                die();
                        }
                       	$row = $stmt->fetch();
			$this->Status = "ERROR: Id ".$Id." Not Found";
			if (count($row) > 0 ) {
				$this->Status = $row[$this->StatusField];
			}
                        return $this->Status;

                }

		function getStatus() {
			return $this->Status;
		}

		function getId() {
			return $this->Id;
		}
	}

?>
