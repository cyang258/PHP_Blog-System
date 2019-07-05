<?php
// complete code for controllers/blog.php
include_once "models/Blog_Entry_Table.class.php";
$entryTable = new Blog_Entry_Table( $db );
$isEntryClicked = isset( $_GET['id'] );
if ($isEntryClicked ) {
	//show one entry ... soon
	$entryId = $_GET['id'];
	$entryData = $entryTable->getEntry($entryId);
	$blogOutput = include_once "views/entry-html.php";

	// display comment
	$blogOutput .= include_once "controllers/comments.php";
} else {
    //list all entries
    $entries = $entryTable->getAllEntries();
    $blogOutput = include_once "views/list-entries-html.php";
}
return $blogOutput;