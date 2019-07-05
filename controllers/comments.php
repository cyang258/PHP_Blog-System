<?php
//complete code for controllers/comments.php
include_once "models/Comment_Table.class.php";
$commentTable = new Comment_Table($db);
$newCommentSubmitted = isset($_POST['new-comment']);
if($newCommentSubmitted){
	$whichEntry = $_POST['entry-id'];
	$user = $_POST['user-name'];
	$comment = $_POST['new-comment'];
	$commentTable->saveComment($whichEntry, $user, $comment);
}


$comments = include_once "views/comment-form-html.php";
//new code starts here
$allComments = $commentTable->getAllById( $entryId );
$rowOfComments = $allComments->fetch();
//notice the incremental concatenation operator .= 
$comments .=include_once "views/comments-html.php";
return $comments;