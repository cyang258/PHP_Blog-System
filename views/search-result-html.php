<?php
$searchDataFound = isset($searchData);
if($searchData === false){
	trigger_error('views/search-reslut-html.php needs $searchData');
}
$rowExist = $searchData->fetch();
$searchHTML = "
	<section id='search'>
		<p>You searched for <em>$searchTerm</em></p>
		<ul>				
";
if(!$rowExist){
	$searchHTML .= "<li>No entries match your search</li>";
}
while($searchRow = $searchData->fetchObject()){
	$href = "index.php?page=blog&amp;id=$searchRow->entry_id";
	$searchHTML .= "<li><a href='$href'>$searchRow->title</li>";
}

$searchHTML .= "</ul></section>";
return $searchHTML;