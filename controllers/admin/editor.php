<?php
// complete source code for controllers/admin/editor.php

// Include class definition and create an object
include_once "models/Blog_Entry_Table.class.php";
$entryTable = new Blog_Entry_Table($db);

// was editor form submitted?
$editorSubmitted = isset($_POST['action']);
if($editorSubmitted){
	$buttonClicked = $_POST['action'];
	// was "save" button clicked
	$save = ($buttonClicked === 'save');
	$id = $_POST['id'];
	$insertNewEntry = ($save && $id === '0');
	$deleteEntry = ($buttonClicked === 'delete');
	$updateEntry = ( $save and $insertNewEntry === false );
	// get title and entry data from editor form
	$title = $_POST['title'];
	$entry = $_POST['entry'];

	if($insertNewEntry){
		// save the new entry
		$savedEntryId = $entryTable->saveEntry($title, $entry);
	} else if($updateEntry){
		$entryTable->updateEntry($id, $title, $entry);
		$savedEntryId = $id;
	} else if($deleteEntry){
		$entryTable->deleteEntry($id);
	}
}

$entryRequested = isset($_GET['id']);
if($entryRequested){
	$id = $_GET['id'];
	$entryData = $entryTable->getEntry($id);
	$entryData->entry_id = $id;
	$entryData->message = "";
	$entryData->legend = "Edit";
}

$entrySaved = isset($savedEntryId);
if($entrySaved){
	$entryData = $entryTable->getEntry($savedEntryId);
	$entryData->message = "Entry was saved";
	$entryData->legend = "Saved";
}

$editorOutput = include_once "views/admin/editor-html.php";
return $editorOutput;