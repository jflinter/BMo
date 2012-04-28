function money(amount)
{
    x = amount.toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");
    x = '$'+x;
    return x;
}

function draw_thermometer(therm_canvas, amount, goal) {
var ctx1 = therm_canvas.getContext("2d");
var goal1 = goal;
var goal2 = Math.floor(2*goal1/3000)*1000;
var goal3 = Math.floor(goal1/3000)*1000;
var start_y = 20;
var total_height = 270;
var height = 270*(amount/goal);
var img = new Image();
img.src = "images/thermometer_blank.png";
  img.onload = function() {
    ctx1.drawImage(img, 0, 0);
    ctx1.fillStyle = "#ea0000";
    ctx1.fillRect(40, start_y+total_height-height, 53, height+2);
    ctx1.fillStyle = "#000000";
    ctx1.strokeStyle = "#000000";
    ctx1.font = "normal 14px Helvetiker";
    ctx1.fillRect(100,start_y,25,5);
    ctx1.fillText(money(goal1), 110, start_y+20);
    ctx1.fillRect(100,start_y+total_height/3,25,5);
    ctx1.fillText(money(goal2), 110, start_y+total_height/3+20);
    ctx1.fillRect(100,start_y+2*total_height/3,25,5);
    ctx1.fillText(money(goal3), 110, start_y+2*total_height/3+20);
    ctx1.fillStyle = "#ffffff";
    ctx1.strokeStyle = "#ffffff";
    ctx1.font = "normal 26px Helvetiker";
    ctx1.textAlign = "center";
    ctx1.fillText(money(amount), 66, 350);
  };
}