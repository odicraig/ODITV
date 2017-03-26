<?php
	require_once 'Table.php';
	require_once 'Status.php';

	class Login extends Table {

                private $Table_Name;
                private $Id_Field = "Id";
                private $User_Id_Field = "User_Id";
                private $IP_Address_Field = "IP_Address";
                private $Attempt_Number_Field  = "Attempt_Number";
                private $Attempt_Status_Field  = "Attempt_Status";
                private $User_Agent_Field  = "User_Agent";
                private $OS_Field  = "OS";
                private $ODITV_Version_Field  = "ODITV_Version";
                private $KODI_Version_Field  = "KODI_Version";
                private $RetrODI_Version_Field  = "RetrODI_Version";
                private $Arch_Bit_Field  = "Arch_Bit";
                private $Timestamp_Field = "Timestamp";
                private $Id = 0;
                private $User_Id = 0;
                private $IP_Address = "0.0.0.0";
                private $Attempt_Number = "0";
                private $Attempt_Status = "0";
                private $User_Agent = "UNKNOWN";
                private $OS = "0";
                private $ODITV_Version = "0";
                private $KODI_Version = "0";
                private $RetrODI_Version = "0";
                private $Arch_Bit = "32";
                private $Timestamp = "";

                function __construct() {
                        $this->Table_Name = $this->getLoginsTable();
                        $db = new Database();
                        $this->pdo = $db->PDOConnect();
			$this->setIPAddress();
                }

                function addLoginAttempt() {
			$status = new Status();
			try {
                                $stmt = $this->pdo->prepare('INSERT INTO ' . $this->Table_Name .
							   " (" . $this->User_Id_Field .",". 
								 $this->IP_Address_Field . "," .
								 $this->Attempt_Number_Field . "," .
								 $this->Attempt_Status_Field . "," .
								 $this->User_Agent_Field . "," .
								 $this->OS_Field . "," .
								 $this->ODITV_Version_Field . "," .
								 $this->KODI_Version_Field . "," .
								 $this->RetrODI_Version_Field . "," .
								 $this->Arch_Bit_Field . 
							    ") VALUES (" .
							    ":UserId, " .
							    ":IP_Address, " .
							    ":Attempt_Number, " .
							    ":Attempt_Status, " .
							    ":User_Agent, " .
							    ":OS, " .
							    ":ODITV_Version, " .
							    ":KODI_Version, " .
							    ":RetrODI_Version, " .
							    ":Arch_Bit " .
							    ") ");
                                $stmt->bindValue(':UserId', $this->User_Id);
                                $stmt->bindValue(':IP_Address', $this->IP_Address);
                                $stmt->bindValue(':Attempt_Number', $this->Attempt_Number);
                                $stmt->bindValue(':Attempt_Status', $this->Attempt_Status);
                                $stmt->bindValue(':User_Agent', $this->User_Agent);
                                $stmt->bindValue(':OS', $this->OS);
                                $stmt->bindValue(':ODITV_Version', $this->ODITV_Version);
                                $stmt->bindValue(':KODI_Version', $this->KODI_Version);
                                $stmt->bindValue(':RetrODI_Version', $this->RetrODI_Version);
                                $stmt->bindValue(':Arch_Bit', $this->Arch_Bit);
                                $stmt->execute();
                        } catch  (PDOException $e) {
                                print "Error!: " . $e->getMessage() . "<br/>";
				print_r($e);
                                die();
                        }
                }

		public function setUserID($user_id) {
			$this->User_Id = $user_id;
		}
                public function setID($id) {
                        $this->Id = $id;
                }
		public function setAttemptNumber($attempt_number) {
                        $this->Attempt_Number = $attempt_number;
                }
                public function setAttemptStatus($attempt_status) {
                        $this->Attempt_Status = $attempt_status;
                }
		public function setUserAgent($user_agent) {
                        $this->User_Agent = $user_agent;
                }
                public function setOS($os) {
                        $this->OS= $os;
                }
		public function getIPAddress() {
			return $this->IP_Address;
		}
		public function setIPAddress() {
			if (getenv('HTTP_CLIENT_IP'))
				$ipaddress = getenv('HTTP_CLIENT_IP');
			else if(getenv('HTTP_X_FORWARDED_FOR'))
				$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
			else if(getenv('HTTP_X_FORWARDED'))
				$ipaddress = getenv('HTTP_X_FORWARDED');
			else if(getenv('HTTP_FORWARDED_FOR'))
				$ipaddress = getenv('HTTP_FORWARDED_FOR');
			else if(getenv('HTTP_FORWARDED'))
				$ipaddress = getenv('HTTP_FORWARDED');
			else if(getenv('REMOTE_ADDR'))
				$ipaddress = getenv('REMOTE_ADDR');
			else
				$ipaddress = 'UNKNOWN';
			$this->IP_Address = $ipaddress;
		}
		public function setODITVVersion($ODITV_Version) {
			$this->ODITV_Version = $ODITV_Version;
		}
                public function setKODIVersion($KODI_Version) {
                        $this->KODI_Version = $KODI_Version;
                }
                public function setRetrODIVersion($RetrODI_Version) {
                        $this->RetrODI_Version = $RetrODI_Version;
                }
                public function setArchBit($Arch_Bit) {
                        $this->Arch_Bit = $Arch_Bit;
                }
	}
?>
