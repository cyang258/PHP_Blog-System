<?php
include_once "models/Admin_Table.class.php";

// is form submitted?
$createNewAdmin = isset($_POST['new-admin']);
// if it is 
if($createNewAdmin){
	$newEmail = $_POST['email'];
	$newPassword = $_POST['password'];
	$adminTable = new Admin_Table($db);
	try{
		$adminTable->create($newEmail, $newPassword);
		$adminFormMessage = "New user created with email: $newEmail";
	}catch(Exception $e){
		$adminFormMessage = $e->getMessage();
	}
}

$newAdminForm = include_once "views/admin/new-form-html.php";
return $newAdminForm;