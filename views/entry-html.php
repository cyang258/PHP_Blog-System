<?php
// check if required data is available
$entryDataFound = isset($entryData);
if($entryDataFound === false){
	trigger_error('views/entry-html.php needs a $entryData object');
}
// properties available in $entry: entry_id, title, entry_text, date_created
return "
<article>
	<h1>$entryData->title</h1>
	<div class='date'>$entryData->date_created</div>
	$entryData->entry_text
</article>
";