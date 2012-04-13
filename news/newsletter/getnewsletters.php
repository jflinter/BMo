<?php
	$docs = getScribdNewsletters();
	$dates = array_keys($docs);
	$curr_year = substr($dates[0], 0, 4);
	echo "<div id='newsletters'>";
	echo "<h2>$curr_year</h2>";
	foreach ($dates as $date) {
		$doc = $docs[$date];
		$link = $doc["link"];
		$title = trim($doc["title"]);
		$author = $doc["author"];
		if (substr($date, 0, 4) != $curr_year) {
			$curr_year = substr($date, 0, 4);
			echo "<h2>$curr_year</h2>";
		}
		echo "<div class='newsletter_link'>";
        echo "<a href='$link' target='_blank'>$title</a> ";
        echo " by $author";
        echo "</div>";
	}
	echo "</div>";
    
function getScribdNewsletters() {
	$xml = simplexml_load_file("http://www.scribd.com/api/?method=collections.listDocs&api_key=104rd0xmkmcqb3tffydj0&collection_id=3205096");
	$results = array();
	foreach( $xml->result_set[0]->result as $result ) {
		$id = $result->doc_id;
		$docxml = simplexml_load_file("http://www.scribd.com/api/?method=docs.getDownloadUrl&api_key=104rd0xmkmcqb3tffydj0&doc_id=$id&doc_type=original");
		$link = $docxml->download_link;
		$pubdate = date("Y/m/d", strtotime($result->tags));
		$results[$pubdate] = array("title" => (string)$result->title, "author" => $result->description, "link" => $link);
	}
	krsort($results);
	return $results;
}

?>