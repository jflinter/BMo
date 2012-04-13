<?php require($ROOT.'constants.php'); ?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Brownian Motion - Brown Mens Ultimate</title>
		<meta name="description" content="Official home of the Brown men's ultimate frisbee team. Contains team information, results, schedule, photos, tips and more." />
        <link rel="stylesheet" href="/Athletics/Mens_Ultimate/css/style.css"></link>
		<link rel="stylesheet" href="/Athletics/Mens_Ultimate/css/jquery.lightbox-0.5.css"></link>
        <link rel="shortcut icon" href="/Athletics/Mens_Ultimate/images/favicon.ico"></link>
        <script src="/Athletics/Mens_Ultimate/javascript/jquery-1.6.min.js"></script>
        <script src="/Athletics/Mens_Ultimate/javascript/jquery.cross-slide.min.js"></script>
		<script src="/Athletics/Mens_Ultimate/javascript/jquery.lightbox-0.5.min.js"</script>
        <script>
        $(document).ready(function() {
            $("<?php echo '#'.$currlink; ?>").css("background", "#ea0000"); 
        });
        </script>
        <!--google analytics stuff -->
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-25162175-1']);
            _gaq.push(['_trackPageview']);
          
            (function() {
              var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
              ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
              var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>
    </head>
    <body>
        <div id="title"><a href="/Athletics/Mens_Ultimate/"><img src="/Athletics/Mens_Ultimate/images/title_brownian_motion.png" alt="Brownian Motion" /></a></div>
		<div id="main_about">
		Brown University Men's Ultimate Frisbee
		</div>
        <div id="nav">
            <ul>
                <li class="first"><a href="/Athletics/Mens_Ultimate/" id="home">Home</a></li>
                <li><a href="/Athletics/Mens_Ultimate/news" id="news">News</a>
                <ul>
                    <li><a href="http://scores.usaultimate.org/scores/#college-open/team/1200" target="_blank">Results</a></li>
					<li ><a href="/Athletics/Mens_Ultimate/news/schedule" id="schedule">Schedule</a></li>
                    <li ><a href="/Athletics/Mens_Ultimate/news/newsletter" id="newsletter">Newsletter</a></li>
                    <li><a href="http://twitter.com/#!/<?php echo $site_constants['twitter_name']; ?>" target="_blank">Twitter</a></li>
                </ul>
                </li>
                <li><a href="/Athletics/Mens_Ultimate/about" id="about">Team Info</a>
                <ul>
                    <li><a href="/Athletics/Mens_Ultimate/about/roster" id="roster">Roster</a></li>
                </ul>
                </li>
                <!--<li><a href="/Athletics/Mens_Ultimate/history" id="history">History</a>
                <ul>
                    <li><a href="/Athletics/Mens_Ultimate/history/awards" id="awards">Awards</a></li>
                    <li><a href="/Athletics/Mens_Ultimate/history/alumni" id="alumni">Alumni</a></li>
                </ul>
                </li>-->
                <li><a href="/Athletics/Mens_Ultimate/media" id="media">Media</a>
                <ul>
                    <li><a href="/Athletics/Mens_Ultimate/media/photos" id="photos">Photos</a></li>
                    <li><a href="http://www.youtube.com/user/BrownUltimate" target='blank' id="videos">Videos</a></li>
                    <li><a href="/Athletics/Mens_Ultimate/media/zipstips" id="zipstips">Zip's Tips</a>
                    <li><a href="/Athletics/Mens_Ultimate/media/links" id="links">Other Links</a></li>
                </ul>
                </li>
                <li><a href="/Athletics/Mens_Ultimate/support" id="support">Support</a>
                <ul>
                    <li><a href="/Athletics/Mens_Ultimate/support/donate" id="donate">Donate</a></li>
                    <li><a href="/Athletics/Mens_Ultimate/support/merchandise" id="merchandise">Merchandise</a></li>
                </ul>
                </li>
            </ul>
        </div>