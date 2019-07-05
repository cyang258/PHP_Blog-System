<?php

$commentsFound = isset( $allComments );
if($commentsFound === false){
    trigger_error('views/comments-html.php needs $allComments' );
}

$allCommentsHTML = "<ul id='comments'>";

while($commentData = $allComments->fetchObject()){
	$allCommentsHTML .= "
		<li>
			$commentData->author wrote:
			<p>$commentData->txt</p>
		</li>";
}

$allCommentsHTML .= "</ul>";
if(!$rowOfComments){
	$allCommentsHTML .= "<p>Be the first to comment this article</p>";
}
return $allCommentsHTML;