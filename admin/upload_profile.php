<?php

$url = $_SERVER['SCRIPT_FILENAME'];
$ROOT = substr($url, 0, strpos($url, "Athletics/Mens_Ultimate") + 24); //This is a hack to find the root directory on the filesystem so we can point to stuff correctly.
require_once($ROOT.'constants.php');

header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$pyear = intval($site_constants['profile_upload_year']);

$error = 0;
if (!empty($_POST['fname'])
    && !empty($_POST['lname'])
    && !empty($_POST['author'])
    && !empty($_POST['profile'])) {
    try {
        $db = new PDO('sqlite:'.$ROOT.'admin/database.db');
        $fname = str_replace("+", " ", ucwords(strtolower($_POST['fname'])));
        $lname = str_replace("+", " ", ucwords(strtolower($_POST['lname'])));
        $nick  = ucwords(strtolower($_POST['nickname']));
        $cyear = intval($_POST['year']);
        $town  = ucwords($_POST['hometown']);
		$height = intval($_POST['height_feet'])*12 + intval($_POST['height_inches']);
        $major = ucwords(strtolower($_POST['major']));
        $profile = $_POST['profile'];
        $author =ucwords(strtolower($_POST['author']));
        $sql = "delete from profiles where fname = ? and lname = ? and profile_year = ?";
        $sth = $db->prepare($sql);
        $sth->execute(array($fname, $lname, $pyear));
        $sth2 = $db->prepare("insert into profiles
                            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $vals = array($fname, $lname, $nick, $cyear,
                            $town, $height, $major, $pyear,
                            $profile, $author);
        $sth2->execute($vals);
        
        $i = 1;
        $removeoldfiles = true;
        foreach($_FILES as $file) {
            if($file['error'] == 0) {
                if($file['type'] == "image/png"
                   || $file['type'] == "image/jpeg"
                   || $file['type'] == "image/gif") {
                    $filename = $file['name'];
                    $ext = substr(strrchr($filename, '.'), 1);
                    $destdir = $ROOT."/images/profilepics/$pyear/";
                    $direxists = true;
                    if (!file_exists($destdir)) {
                        $direxists = false;
                        if (mkdir($destdir, 0770, true)) {
                            $direxists = true;
                        }
                    }
                    if ($direxists) {
                        $tmpname = $fname."_".$lname;
                        $newfileprefix = $tmpname."_".$pyear;
                        $newfilename = $newfileprefix."_".$i.".".$ext;
                        if ($handle = opendir($destdir)) {
                            if ($removeoldfiles) {
                            while (false !== ($dirimage = readdir($handle))) {
                                if (strpos($dirimage, $newfilename) !== false) {
                                    unlink("$destdir$dirimage");
                                    $removeoldfiles = false;
                                }
                            }
                            }
                            closedir($handle);
                        }
                        $destdir .= $tmpname."_".$pyear."_".$i.".".$ext;
                        if (move_uploaded_file($file['tmp_name'], $destdir)) {
                            $i += 1;
                        }
                    }
                }
            }
        }
        
    }
    catch (PDOException $e) {
        $error = 1;
        echo $e->getMessage();
    }
}
else {
    $error = 1;
}
if ($error == 0) {
    echo "<script>alert('Profile uploaded successfully!')</script>";
}
elseif(!(sizeof($_POST) == 0)) {
    echo "<script>alert('Error uploading profile.')</script>";
}
require_once("../header.php");
?>
<script src="/Athletics/Mens_Ultimate/javascript/jquery.validate.min.js"></script>
<script>
$.validator.addMethod("lettersetc", function(value, element) {
	return this.optional(element) || /^[a-z-\s]+$/i.test(value);
}, "Letters, spaces or hyphens only please");
$.validator.addMethod("lettersetc2", function(value, element) {
	return this.optional(element) || /^[a-z-,\s]+$/i.test(value);
}, "Letters, spaces, commas or hyphens only please");
$(document).ready(function(){
    $("#uploadprofileform").validate();
	});
</script>
<div id='content' class='profileupload'>
<h1>Profile Upload Page</h1>
<h3>Note: Uploading a profile will overwrite any existing profile data for that person in that year.</h3>
<h3>This profile will be for the <?php $x=$pyear-1; echo "$x-$pyear"; ?> season. Wrong season? Contact the webmaster.</h3>
<form action="" id="uploadprofileform" method="post" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    <label for="fname">First Name: </label><input type="text" size=20 name="fname" id="fname" class="required lettersetc"/><br>
    <label for="lname">Last Name: </label><input type="text" size=20 name="lname" id="lname" class="required lettersetc"/><br>
    <label for="nickname">Nickname: </label><input type="text" size=20 name="nickname" id="nickname" class="lettersetc"/><br>
    <label for="year">Class Year: </label><select name="year" id="year" class="required digits">
		<option value="-" selected="selected" />
		<?php $i=intval(date("Y")); for($j = $i-1; $j<$i+6; $j++){
			echo "<option value=$j ";
			echo ">$j</option>";
			}?>
	</select><br>
    <label for="hometown">Hometown: </label><input type="text" size=20 name="hometown" id="hometown" class="required lettersetc2"/><br>
    <label for="major">Major: </label><input type="text" name="major" id= "major"  class="required lettersetc2"/><br>
    <label for="height_feet">Height: Feet: </label><select name="height_feet" id = "height_feet" class="required digits">
		<option value="-" selected="selected" />
		<?php for($i=0; $i<10; $i++) {echo "<option value=$i>$i</option>";}?>
	</select> Inches: 
	<select name="height_inches" id ="height_inches" class="required digits">
		<option value="-" selected="selected" />
		<?php for($i=0; $i<12; $i++) {echo "<option value=$i>$i</option>";}?>
	</select><br>
    <label for="author">Author Name: </label><input type="text" size=20 name="author" id="author" class="required lettersetc"/><br>
	<label for="profile">Profile: <br></label><textarea rows=20 cols=70 name="profile" id="profile" class="required"/></textarea><br>
    <div id="addImages">
	<label for="image">Image 1: </label><input type="file" name="image1" id="image1" /><br>
    <label for="image2">Image 2: </label><input type="file" name="image2" id="image2" /><br>
	</div>
	<button type="button" id="addMoreImages">Add more images</button><br>
	<h3>Note: Combined image size cannot exceed 3 Mb</h3>
    <input type="submit" id="submit" />
</form>
<script>
	var numImages = 2;
	$("#addMoreImages").click(function() {
		numImages = numImages + 1;
		if (numImages >= 10) {alert("Enough images asshole");}
		else {
			var text = "<label for='image'>Image "+ numImages + ": </label><input type='file' name=image" + numImages + " id=image"+ numImages + " /><br>";
			$("#addImages").append(text);
		}
	});
</script>
</div>
</body>
</html>