<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once "models/Page_Data.class.php";
$pageData = new Page_Data();
$pageData->title = "PHP/MySQL blog demo";
$pageData->addCSS("css/blog.css");
$pageData->addScript("js/editor.js");

// load navigation
//$pageData->content = include_once "views/admin/admin-navigation.php";

// database connection
$dbInfo = "mysql:host=localhost;dbname=simple_blog";
$dbUser = "root";
$dbPassword = "";
$db = new PDO($dbInfo, $dbUser, $dbPassword);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

include_once "models/Admin_User.class.php";
$admin = new Admin_User();
$pageData->content = include_once "controllers/admin/login.php";

if($admin->isLoggedIn()){
	$pageData->content .= include_once "views/admin/admin-navigation.php";
	// check if navigation was clicked
	$navigationIsClicked = isset($_GET['page']);
	if($navigationIsClicked){
		// prepare to load corresponding controller
		$contrl = $_GET['page'];
	} else {
		// prepare to load default controller
		$contrl = "entries";
	}

	// load the controller
	$pageData->content .=include_once "controllers/admin/$contrl.php";
}

$page = include_once "views/page.php";
echo $page;