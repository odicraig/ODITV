<?php
	require_once 'Database.php';

	class Table extends Database {

		private $USERSTABLENAME = "Users";
		private $ADDRESSESTABLENAME = "Addresses";
		private $CITIESTABLENAME = "Cities";
		private $COUNTRIESTABLENAME = "Countries";
		private $EMAILADDRESSESTABLENAME = "EmailAddresses";
		private $LOGINSTABLENAME = "Logins";
		private $OSVERSIONSTABLENAME = "OSVersions";
		private $STATESTABLENAME = "States";
		private $STATUSTABLENAME = "Status";
		private $KODIVERSIONSTABLENAME = "KODIVersions";
		private $ODITVVERSIONSTABLENAME = "ODITVVersions";
		private $RETRODIVERSIONSTABLENAME = "RetrODIVersions";
		private $USERSSOFTWARETABLENAME = "UsersSoftware";

		function __construct() {
		}

		function getUsersTable() {
			return $this->USERSTABLENAME;
		}
		function getAddressesTable() {
			return $this->ADDRESSESTABLENAME;
                }
		function getCitiesTable() {
			return $this->CITIESTABLENAME;
                }
		function getCountriesTable() {
			return $this->COUNTRIESTABLENAME;
                }
		function getEmailAddressesTable() {
			return $this->EMAILADDRESSESTABLENAME;
                }
		function getLoginsTable() {
			return $this->LOGINSTABLENAME;
                }
		function getOSVersionsTable() {
			return $this->OSVERSIONSTABLENAME;
                }
                function getStatesTable() {
			return $this->STATESTABLENAME;
                }
                function getStatusTable() {
			return $this->STATUSTABLENAME;
                }
                function getKODIVersionsTable() {
                        return $this->KODIVERSIONSTABLENAME;
                }
                function getODITVVersionsTable() {
                        return $this->ODITVVERSIONSTABLENAME;
                }
                function getRetrODIVersionsTable() {
                        return $this->RETRODIVERSIONSTABLENAME;
                }
                function getUSERSSOFTARETable() {
                        return $this->USERSSOFTWARESTABLENAME;
                }
	}
?>
