<?php
	require_once 'Table.php';

	class User extends Table {
		private $Table_Name;
		private $Id_Field = "Id";
		private $Email_Id_Field = "Email_Id";
		private $Username_Field = "Username";
		private $First_Name_Field = "First_Name";
		private $Last_Name_Field = "Last_Name";
		private $Password_Field = "Password";
		private $Status_Field = "Status";
		private $Last_Successful_Login_Field = "Last_Successful_Login";
		private $Last_Failed_Login_Field = "Last_Failed_Login";
		private $Created_Field = "Created";

		private $Id = 0;
		private $Email_Id = "";
		private $Username = "";
		private $First_Name = "";
		private $Last_Name = "";
		private $Password = "";
		private $Status = "";
		private $Last_Successful_Login = "";
		private $Last_Failed_Login = "";
		private $Created = "";
	
		function __construct() {
			$this->Table_Name = $this->getUsersTable();
			$db = new Database();
			$this->pdo = $db->PDOConnect();
		}

		public function getUserByUsername($username) {
                        try {
                                $stmt = $this->pdo->prepare('SELECT ' . $this->Id_Field. ' FROM ' . $this->Table_Name . 
							    ' WHERE ' . $this->Username_Field . ' = :username . ');
                                $stmt->bindValue(':username', $username);
                                $stmt->execute();
                        } catch  (PDOException $e) {
                                print "Error!: " . $e->getMessage() . "<br/>";
                                die();
                        }
                        while ($row = $stmt->fetch()) {
                                return $row;
                        }
                        return "";
                }

                public function getUserById($UserId) {
                        try {
                                $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->Table_Name . ' WHERE ' . $this->Id_Field . ' = :Id');
                                $stmt->bindParam(':Id', $UserId);
                                $stmt->execute();
                        } catch  (PDOException $e) {
                                print "Error!: " . $e->getMessage() . "<br/>";
                                die();
                        }
                        while ($row = $stmt->fetch()) {
                                return $row;
                        }
                        return "";
                }

                public function authenticate($username, $password) {

                        $status = new Status();
                        if ( !(isset($username)) || (strlen($username) <= 3) ) {
                                $status->getStatusById(100);
                                return json_encode(array('Id' => 100, 'Message' => $status->getStatus()));
                        }
                        if ( !(isset($password)) || (strlen($password) <= 3) ) {
                                $status->getStatusById(101);
                                return json_encode(array('Id' => 101, 'Message' => $status->getStatus()));
                        }
			$this->Id = $this->getIdFromUsername($username);
			if ($this->Id == 0) {
				$status->getStatusById(105);
                                return json_encode(array('Id' => 105, 'Message' => $status->getStatus()));
			}
			if ($this->validPassword($this->Id, $username, $password) == 0) {
                                $status->getStatusById(102);
                                return json_encode(array('Id' => 102, 'Message' => $status->getStatus()));
                        }
			$status->getStatusById(1);
			return json_encode(array('Id' => 1, 'Message' => $status->getStatus()));
                }

		public function getIdFromUsername($username) {
			$result = "";
                         try {
                                $stmt = $this->pdo->prepare('SELECT ' . $this->Id_Field . ' FROM ' . $this->Table_Name .
                                                            ' WHERE ' .
                                                                $this->Username_Field . ' = :Username');
                                $stmt->bindParam(':Username', $username);
                                $stmt->execute();
                                $result = $stmt->fetch();
                        } catch  (PDOException $e) {
                                print "Error!: " . $e->getMessage() . "<br/>";
                                die();
                        }
                        if ($result) {
                                return $result[$this->Id_Field];
                        } else {
                                return 0;
			}
		}

		private function validPassword($id, $username , $password) {

			 $result = "";
			 try {
                                $stmt = $this->pdo->prepare('SELECT ' . $this->Id_Field . ' FROM ' . $this->Table_Name .
                                                            ' WHERE ' . 
								$this->Id_Field . ' = :Id AND ' .
								$this->Username_Field . ' = :Username AND ' .
								$this->Password_Field . ' = :Password');
                                $stmt->bindParam(':Id', $id);
                                $stmt->bindParam(':Username', $username);
                                $stmt->bindParam(':Password', $password);
                                $stmt->execute();
				$result = $stmt->fetch();
                        } catch  (PDOException $e) {
                                print "Error!: " . $e->getMessage() . "<br/>";
                                die();
                        }
			if ($result) {
				return $result[$this->Id_Field];
			} else {
				return 0;
			}
				
		}

		public function getId() {
			return $this->Id;
		}
	}
?>
