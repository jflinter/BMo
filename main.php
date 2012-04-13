<?php require($ROOT.'constants.php');?>

<script>
$(function() {
    $('#slideshow').crossSlide({
        fade: 1
        }, [
            {
                src: '/Athletics/Mens_Ultimate/images/main_slideshow/1.jpg',
                alt: 'brown ultimate',
                from: 'bottom left .5x',
                to: '66% 25% 1x',
                time:2.8
            }
            ,{
                src: '/Athletics/Mens_Ultimate/images/main_slideshow/2.jpg',
                alt: 'brown ultimate',
                from: '66% 25% 1.5x',
                to: '50% 50% .7x',
                time:2.8
            }
            ,{
                src: '/Athletics/Mens_Ultimate/images/main_slideshow/3.jpg',
                alt: 'brown ultimate',
                from: '66% 60% 1x',
                to: '10% 40% 1x',
                time:2.8
            }
            ,{
                src: '/Athletics/Mens_Ultimate/images/main_slideshow/4.jpg',
                alt: 'brown ultimate',
                from: '0% 50% 1x',
                to: '80% 50% 1x',
                time:2.8
            }
        ]);
});
</script>
<div id="slideshow"></div>

<script src="/Athletics/Mens_Ultimate/javascript/widget.js"></script>
<div id=content_right style="float:left">
	<div style="float:none">
<div id="twitter_widget">
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 8,
  interval: 6000,
  width: 250,
  height: 170,
  theme: {
    shell: {
      background: '#333333',
      color: '#ffffff'
    },
    tweets: {
      background: '#000000',
      color: '#ffffff',
      links: '#ff0f0f'
    }
  },
  features: {
    scrollbar: true,
    loop: false,
    live: false,
    hashtags: true,
    timestamp: true,
    avatars: false,
    behavior: 'all'
  }
}).render().setUser('<?php echo $site_constants['twitter_name']; ?>').start();
</script>
</div>
</div>
<div id="tipofday">
    <p style="font-weight:bold;font-size:14px;float:left">Today's Zip Tip</p>
<div id='tiplinks'><a id="randomTip" href="#">Random Tip</a><a href="/Athletics/Mens_Ultimate/media/zipstips">More Tips</a></div>
<div id="tip">
    <?php
    $db = new PDO('sqlite:'.$ROOT.'admin/database.db');
    $date = date("m/d");
    $result = $db->query("select * from zipstips where strftime('%m/%d', date, 'unixepoch') = '$date'");
	$row = ($result->fetchAll());
    if (!$row) {
        $count = $db->query("select count(*) from zipstips");
        $count = $count->fetchAll();
        $count = floatval($count[0][0]);
        $fraction = floatval(date("z"))/$count;
        $fraction = $fraction - floor($fraction);
        $rownum = $fraction*$count;
        $result = $db->query("select * from zipstips order by date asc limit 1 offset $rownum");
		$row = ($result->fetchAll());
    }
	$row = $row[0];
    echo "<div id='tipdate'>".date("n/j/y", $row['date'])." - \"".$row['title']."\"</div>";
    echo "<div id='tipbody'>".$row['tip']."</div>";
    ?>
</div>
</div>
</div>
<script>
	$("#randomTip").click(function() {
		$.get("getrandomtip.php", function(data) {
			var json = $.parseJSON(data);
			$("#tipbody,#tipdate").fadeOut(500, function() {
				$("#tipbody").text($('<div/>').html(json.tip).text());
				var date = $('<div/>').html(json.date).text();
				var title = $('<div/>').html(json.title).text();
				$("#tipdate").html(date + " - &quot;" + title+"&quot;");
				$("#tipbody,#tipdate").fadeIn(500);
			});
		});
	});
</script>