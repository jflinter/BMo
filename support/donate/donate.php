<!--[if lt IE 9]>
    <script src="/Athletics/Mens_Ultimate/javascript/excanvas.js"></script>
<![endif]-->
<script src="/Athletics/Mens_Ultimate/javascript/canvas.text.js"></script>
<script src="/Athletics/Mens_Ultimate/javascript/faces/helvetiker-normal-normal.js"></script>
<h1>Support BMo!</h1>
<div id="annual" class="thermometers">
    <div class="thermometer_title">
	<h2>Fundraising Goal for Current Fiscal Year<br>
    <?php
    $thisyear = intval(date("Y")) - 1;
    $month = intval(date("n"));
    if ($month >= 7) {
        $thisyear++;
    }
    $nextyear = $thisyear+1;
    echo "(July $thisyear - June $nextyear):";
    ?>
    </h2>
	</div>
    <a href="http://www.sportsfoundation.brown.edu/support/annualUse.html">
    <canvas width=170 height=407 id="annual_thermometer"></canvas>
    </a>
    <h3>Contributions to Club Men's Ultimate Frisbee support the operating budget
    of the club and improve the standing of the club in the eyes of the university.<br>
    <a href="http://www.sportsfoundation.brown.edu/support/annualUse.html">Click here to donate!</a></h3>
</div>
<div id="franzfund" class="thermometers">
	<div class="thermometer_title">
    <h2>Michael Franz '03 Endowment:</h2>
	</div>
    <a href="http://www.sportsfoundation.brown.edu/support/annualUse.html">
    <canvas width=170 height=407 id="franz_thermometer"></canvas>
    </a>
    <h3>Contributions to the Michael Franz '03 Fund provide long term financial stability
    through enhancement of the endowment.<br><a href="http://www.sportsfoundation.brown.edu/support/annualUse.html">Click here to donate!</a></h3>
</div>
<script src="/Athletics/Mens_Ultimate/javascript/draw_thermometer.js"></script>

<script>
    <?php require($ROOT.'constants.php'); ?>
    $(document).ready(function() {
    draw_thermometer(document.getElementById("annual_thermometer"),
                     <?php echo $site_constants['annual_fund_amount']?>,
                     <?php echo $site_constants['annual_fund_goal']?>);
    draw_thermometer(document.getElementById("franz_thermometer"),
                     <?php echo $site_constants['franz_fund_amount']?>,
                     <?php echo $site_constants['franz_fund_goal']?>);
    
        
    });
</script>