<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Listserv Removal Tool</title>
        <link rel="stylesheet" href="style.css"></link>
        <link rel="shortcut icon" href="/Athletics/Mens_Ultimate/images/favicon.ico"></link>
        <script src="/Athletics/Mens_Ultimate/javascript/jquery-1.6.min.js"></script>
		<script src="/Athletics/Mens_Ultimate/javascript/jquery.validate.min.js"></script>
		<script src="jquery.cookie.js"></script>
		<script>
		function getMessage(timeout) {
			return "Sorry, but the BMOTION listserv has experienced too many concurrent requests. <br /> Please try your query again in " + timeout + " seconds, or try again later.";
		}
		function setCountdown() {
			$.cookie("listserv", "true");
			$("input").prop('disabled', true);
			$("label").css("color","grey");
			var timeout = 20;
			$("#wait").html("<p style='color:red'>"+getMessage(timeout)+"</p>");
			var id = setInterval(function() {
				timeout = timeout-1;
				$("#wait").html("<p style='color:red'>"+getMessage(timeout)+"</p>");
			}, 1000);
			setTimeout(function() {
				clearInterval(id);
				$("input").prop('disabled', false);
				$("label").css("color","black");
				$("#wait").html("");
				$.cookie("listserv", null);
				var d = new Date();
				var src = $("#captchaimg").attr("src");
				$("#captchaimg").attr("src", src +"?"+d.getTime());
				$("input[type='text']").each(function() {
					$(this).val('');
				});
			}, 20000);
		}
		function disableContent() {
			$("#wait").html("<img src='/Athletics/Mens_Ultimate/images/spinner.gif' />");
			$("input").prop('disabled', true);
			$("label").css("color","grey");
		}
		
		function disableSubmit() {
			disableContent();
		setTimeout(function() {
			setCountdown();
		}, Math.floor(3000+Math.random()*5000));
		}
		
		function ajaxSubmit() {
		        var n = $("#username").val(),
				e = $("#useremail").val();

		    /* Send the data using post and put the results in a div */
		    $.post( "listservpost.php", { username: n , useremail: e},
		      function( data ) {
				disableSubmit();
		      }
		    );
		}
		</script>
    </head>
    <body>
        <div id="title"><a href="/Athletics/Mens_Ultimate/"><img src="/Athletics/Mens_Ultimate/images/title_brownian_motion.png" alt="Brownian Motion" /></a></div>
		<div id="content">
<h2>Listserv Removal Tool</h2>
<form id="listservform" action="listservpost.php">
	<label for="username">Your name: </label><input type="text" id="username" name="username" class="required" /><br />
	<label for="useremail">Your brown email: </label><input type="text" id="useremail" name="useremail" class="required email"/><br />
	<label for="captcha">Enter the code below (to prove you are not a robot): </label><input type="text" id="captcha" name="captcha" class="required"/><br>
	<img border=1 id="captchaimg" src="http://www.captcha.cc/img.cgi?cap_k=LSUxsMpCEvjLNqNZQWMpwoHbfAOtQkDX"><br>
	<input type="submit" name="submit"/>
</form>
<div id="wait"></div>
</div>
<script>
	if ($.cookie("listserv") == "true") {
		setCountdown();
	}
	$("#listservform").validate({
	   submitHandler: function(form) {
	   	ajaxSubmit();
	   }
	});
</script>