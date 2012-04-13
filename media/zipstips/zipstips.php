<script>
function hideTips() {
    $(".tip").hide();
}
function showTips() {
    $(".tip").show();
}
$.ready = function() {
    $(".tip_label").click(function() {
        var myClass = $(this).attr("id");
        var selector = "#"+myClass+".tip";
        if ($(selector).is(":visible")) {
            $(selector).hide();
        }
        else {
            $(selector).show();
        }
    });
}
</script>
<h1>Zip's Tips</h1>
<h2>Written by Josh Ziperstein '05</h2><br>
<a href="#" onclick='showTips()'>Expand All</a>
<a href="#" onclick='hideTips()'>Collapse All</a>
<br><br>
        
<?php
try {
    $db = new PDO('sqlite:'.$ROOT.'admin/database.db');
    $result = $db->query("select strftime('%m/%d/%Y', date, 'unixepoch') as date2, title, tip from zipstips order by date");
    $i = 0;
    foreach($result as $row) {
        $id = 'tip'.$i;
        echo $row['date2']." - ";
        echo "<span class='tip_label' id='$id'>";
        echo "\"".$row['title']."\"</span><br>";
        echo "<div class='tip' id='$id'>".$row['tip']."</div>";
        $i++;
    }
    $db = NULL;
}
catch (PDOException $e) {
    echo "Error Connecting to Database: " . $e->getMessage();
}
?>