<?php
require($ROOT.'constants.php');
try {
    $db = new PDO('sqlite:'.$ROOT.'admin/database.db');
    $year = $site_constants['profile_year'];
    $result = $db->query("select fname, lname, nickname from profiles where profile_year = $year order by year");
	echo "<div id='profilelinks'><ul>";
    foreach($result as $row) {
        $fname = $row['fname'];
        $lname = $row['lname'];
        $urlname = $fname."_".$lname;
        $urlname = str_replace(" ", "+", $urlname);
        $urlname = "?name=".$urlname;
        echo "<li><a href='$urlname'>$fname $lname</a></li>";
    }
    echo "</li></div><div id='profilecontent'>";
    $db = NULL;
    $profilename = NULL;
    if (isset($_GET['name'])) {
        $profilename = $_GET['name'];
    }
    if ($profilename != NULL) {
        $profilereturned = false;
        $names = explode("_", $profilename);
        if (sizeof($names) == 2) {
            $fname = ucwords(strtolower(str_replace("+", " ", $names[0])));
            $lname = ucwords(strtolower(str_replace("+", " ", $names[1])));
            $db = new PDO('sqlite:'.$ROOT.'admin/database.db');
            $result = $db->query("select * from profiles where fname = '$fname' and lname = '$lname' and profile_year = '$year'");
            $row = $result->fetch();
            if ($row) {
				$images = array();
                $destdir = $ROOT."images/profilepics/$year/";
				$first_image = true;
                if ($handle = opendir($destdir)) {
                    while (false !== ($dirimage = readdir($handle))) {
                        $name = $fname."_".$lname;
                        if (strpos($dirimage, $name) !== false) {
							$imagelink = "/Athletics/Mens_Ultimate/images/profilepics/$year/$dirimage";
							$s="<a href=\"/Athletics/Mens_Ultimate/images/slir/?height=600&amp;width=800&amp;image=$imagelink\" alt=$name />";
							if ($first_image) {
								$first_image = false;
								$s.= "<img src= \"/Athletics/Mens_Ultimate/images/slir/?width=170&amp;height=170&amp;cropratio=1:1&amp;image=$imagelink\" /></a>";
							}
							$s .= "</a>";
                            $images[] = $s;
                        }
                    }
                    closedir($handle);
                }
				if (isset($images)) {
			        echo "<div id='profile_photos'>";
			        foreach ($images as $image) {
			            echo $image;
			        }
			        echo "</div>";
					echo "<script>$('#profile_photos a').lightBox({
						imageBlank:   '/Athletics/Mens_Ultimate/images/lightbox-blank.gif',
						imageLoading: '/Athletics/Mens_Ultimate/images/spinner.gif',
						imageBtnClose: '/Athletics/Mens_Ultimate/images/lightbox-btn-close.gif',
						imageBtnPrev: '/Athletics/Mens_Ultimate/images/lightbox-btn-prev.gif',
						imageBtnNext: '/Athletics/Mens_Ultimate/images/lightbox-btn-next.gif'})</script>";
			    }
                $nickname = $row['nickname'];
                if ($nickname != "") {
                    $fullname = "$fname '$nickname' $lname";
                }
                else $fullname = "$fname $lname";
				$inches = intval($row["height"]);
				$feet = floor($inches/12);
				$inches = $inches - ($feet*12);
				$height = "$feet'$inches\"";
                echo "<div id='profile_info'><div id='name_card'>
					$fullname<br>
					Year: ".$row['year']."<br>
					Major: ".$row["major"]."<br>
					Height: $height<br>
					Hometown: ".$row["hometown"]."<br>
					</div><p>";
					if (($images)) echo "Click thumbnail for larger images";
					echo "</p><div id='roster_tab'><a href='#'>Show Roster</a></div></div>";

			?>
				<script>
				var roster_show = false;
				$("#roster_tab").click(function() {
					if (!roster_show) {
						$("#profilelinks").slideDown("fast");
						$(this).html("<a href='#'>Hide Roster</a>");
						roster_show = true;
					}
					else {
						$("#profilelinks").slideUp("fast");
						$(this).html("<a href='#'>Show Roster</a>");
						roster_show = false;
					}
				});

				</script>
			<?php
                $profiletext = stripslashes(htmlspecialchars($row['profile_text']));
				$profiletext = preg_replace("/\n+/", "<br>", $profiletext);
				echo "<div id='profile_text'>$profiletext<br /><br />Written by ".$row['author']."</div>";
                
                
                $profilereturned = true;
            }
        }
        if (!$profilereturned) {
            echo "That profile could not be found. <a href='/Athletics/Mens_Ultimate/about/roster/'>Back to Profiles</a>";
        }
    }
    else {
		?>
		<script>
			var cssobj = {"display" : "block", "position" : "static", "margin-left" : "10px"};
			var year = <?php echo "\"".$year."\"" ?>;
			var newdiv = "<div style='margin:10px'>" + (parseInt(year)-1) + "-" + year + " Roster<br>Click individual names for player profiles</div>";
			$('#profilelinks').css(cssobj).before(newdiv);
		</script>
		<?php
    }
    echo "</div>";
    
}
catch (PDOException $e) {
    echo "Error Connecting to Database: " . $e->getMessage();
}
?>