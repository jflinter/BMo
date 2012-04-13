<?php

$rootdir = $ROOT."images/photos";
$years = getPicasaAlbums("brownianmotionultimate");

if (!isset($_GET['year'])) {
    echo "<h1>Photos</h1>";
	echo "<div class='photosbyyear'><div id ='album_thumbs'>";
    foreach(array_keys($years) as $year) {
		$key = array_rand($years[$year], 1);
		echo "<div class='album_thumb'>";
        $url = $years[$year][$key]["url"];
        echo "<a href='?year=$year'>
        <img src='$url' /></a><br>
        <a href='?year=$year'>$year</a>";
        echo "</div>";
    }
	echo "</div></div>";
}

elseif (!isset($_GET['album'])) {
    $year = $_GET['year'];
    if (array_key_exists($year, $years)) {
        echo "<a href='?'>Photos</a> / <a href='?year=$year'>$year</a><br>";
        echo "<div id='album_thumbs'>";
        $albums = $years[$year];
        foreach(array_keys($albums) as $album) {
            echo "<div class='album_thumb'>";
            $url = $years[$year][$album]["url"];
            echo "<a href='?year=$year&album=$album'>
            <img src='$url' /></a><br>
            <a href='?year=$year&album=$album'>$album</a>";
            echo "</div>";
        }
        echo "</div>";
    }
    else {
        echo "Sorry, that album does not exist. <a href='/Athletics/Mens_Ultimate/media/photos/'>Photos Home</a>";
    }
}

else {
    $year = $_GET['year'];
    $album = $_GET['album'];
	if (array_key_exists($year, $years) && array_key_exists($album, $years[$year])) {
    	$url = $years[$year][$album]["url"];
		$googleAlbum = $years[$year][$album]["googleAlbum"];
        
        echo "<a href='?'>Photos</a> / <a href='?year=$year'>$year</a> / <a href='?year=$year&album=$album'>$album</a>";
        echo "<script src='/Athletics/Mens_Ultimate/javascript/galleria/galleria-1.2.5.min.js'></script>";
        echo "<script src='/Athletics/Mens_Ultimate/javascript/galleria/themes/classic/galleria.classic.min.js'></script>";
        echo "<script src='/Athletics/Mens_Ultimate/javascript/galleria/plugins/picasa/galleria.picasa.min.js'></script>";
        echo "<div id='galleria'></div>";
        echo "<script>$('#galleria').galleria({
            width:700,
            height:500,
            picasa: 'useralbum:brownianmotionultimate/$googleAlbum',
            picasaOptions: {
                description: true
            }
        })</script>";
    }
    else {
        echo "Sorry, that album does not exist. <a href='/Athletics/Mens_Ultimate/media/photos/'>Photos Home</a>";
    }
}

function getPicasaAlbums($user) {
    $userid = "$user@gmail.com";
    
    // build feed URL
    $feedURL = "http://picasaweb.google.com/data/feed/api/user/$userid?kind=album";
    // Read feed into SimpleXML object
    $sxml = simplexml_load_file($feedURL);
    $years = array();
    // Loop through and get info about each album
    foreach( $sxml->entry as $entry ) {
		$googleAlbum = $entry->children('http://schemas.google.com/photos/2007')->name;
        $media = $entry->children('http://search.yahoo.com/mrss/');
        $thumbnail = $media->group->thumbnail[0];
        $url = (string)$thumbnail->attributes()->{'url'};
        $title = (string)$entry->title;
		if ($title == "Profile Photos" || $title == "Full Team Photos") continue;
        $year = substr($entry->published, 0, 4);
        if (array_key_exists($year, $years)) {
            $years[$year][$title] = array("url" => $url, "googleAlbum" => $googleAlbum);
        }
        else {
            $years[$year] = array($title => array("url" => $url, "googleAlbum" => $googleAlbum));
        }
    }
    foreach($years as $year) {
        ksort($year);
    }
    krsort($years);
    return $years;
    
}

?>