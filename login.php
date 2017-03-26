<?php
	error_reporting(E_ALL);
	include_once 'config/Config.php';
	include_once 'classes/User.php';
	include_once 'classes/Login.php';
	include_once 'classes/KODIVersions.php';
	include_once 'classes/ODITVVersions.php';
	include_once 'classes/RetrODIVersions.php';
	include_once 'classes/OSVersions.php';
/*$_POST["username"]="kevin";
$_POST["password"]="kevins";
$_POST["KODIVersion"]="16.1.000";
$_POST["ODITVVersion"]="1.0";
$_POST["RetrODIVersion"]="1.9.0";
$_POST["ArchBit"]="64";
$_POST["OSVersion"]="6.2";
$_POST["OSType"]="Windows";
*/
	
	if ( (isset($_POST["username"])) && 
	     (isset($_POST["password"])) && 
	     (strlen($_POST["username"]) > 3) &&
	     (strlen($_POST["password"]) > 3) ) {
		$config = new Config();
		$login = new Login();
		$user = new User();
		$KodiVersion = new KODIVersions();
		$ODITVVersion = new ODITVVersions();
		$RetrODIVersion = new RetrODIVersions();
		$OSVersion = new OSVersions();
		$OSVersion->setOS($_POST["OSType"]);
		$OSVersion->setVersion($_POST["OSVersion"]);
		$result = $user->authenticate(urldecode($_POST["username"]), urldecode($_POST["password"]));
		if ($user->getId() <= 0) {
		   $user->getUserByUsername($_POST["username"]);
		}
		$login->setUserId($user->getId());
		$login->setKODIVersion($KodiVersion->getIdByVersion($_POST["KODIVersion"]));
		$login->setODITVVersion($ODITVVersion->getIdByVersion($_POST["ODITVVersion"]));
		$login->setRetrODIVersion($RetrODIVersion->getIdByVersion($_POST["RetrODIVersion"]));
		$login->setArchBit($_POST["ArchBit"]);
		$login->setOS($OSVersion->getId());
		$login->setUserAgent($_SERVER['HTTP_USER_AGENT']);
		$login->addLoginAttempt();
		header('Content-type: application/json;charset=utf-8');
		echo $result;
	}
?>
