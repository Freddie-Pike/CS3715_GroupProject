<html>
<script type="text/javascript">
var canvas, ctx, flag = false,
    prevX = 0,
    currX = 0,
    prevY = 0,
    currY = 0,
    dot_flag = false;
var x = "black",
    y = 2;
function init() {   //creates the canvas
    canvas = document.getElementById('can');
    ctx = canvas.getContext("2d");
    w = canvas.width;
    h = canvas.height;
    canvas.addEventListener("mousemove", function (e) {
        findxy('move', e)
    }, false);
    canvas.addEventListener("mousedown", function (e) {
        findxy('down', e)
    }, false);
    canvas.addEventListener("mouseup", function (e) {
        findxy('up', e)
    }, false);
    canvas.addEventListener("mouseout", function (e) {
        findxy('out', e)
    }, false);
}
function color(obj) {   //makes the drawing tool black in color
    switch (obj.id) {
        case "black":
            x = "black";
            break;
    }
}
function draw() {  //drawing tool
    ctx.beginPath();
    ctx.moveTo(prevX, prevY);
    ctx.lineTo(currX, currY);
    ctx.strokeStyle = x;
    ctx.lineWidth = y;
    ctx.stroke();
    ctx.closePath();
}
function erase() { //Clears Entire Image from Canvas
    var m = confirm("Clear Image?");
    if (m) {
        ctx.clearRect(0, 0, w, h);
        document.getElementById("canvasimg").style.display = "none";
    }
}
function save() {   //saves image
    document.getElementById("canvasimg").style.border = "3px solid";
    var dataURL = canvas.toDataURL();
    document.getElementById("canvasimg").src = dataURL;
    document.getElementById("canvasimg").style.display = "inline";
}
function findxy(res, e) {   //finds positioning
    if (res == 'down') {
        prevX = currX;
        prevY = currY;
        currX = e.clientX - canvas.offsetLeft;
        currY = e.clientY - canvas.offsetTop;
        flag = true;
        dot_flag = true;
        if (dot_flag) {
            ctx.beginPath();
            ctx.fillStyle = x;
            ctx.fillRect(currX, currY, 2, 2);
            ctx.closePath();
            dot_flag = false;
        }
    }
    if (res == 'up' || res == "out") {
        flag = false;
    }
    if (res == 'move') {
        if (flag) {
            prevX = currX;
            prevY = currY;
            currX = e.clientX - canvas.offsetLeft;
            currY = e.clientY - canvas.offsetTop;
            draw();
        }
    }
}
</script>
<body onload="init()">
    <canvas id="can" width="600" height="600" style="position:absolute;top:10%;left:10%;border:3px solid;"></canvas>
    <img id="canvasimg" style="position:absolute;top:10%;left:52%;" style="display:none;">
    <input type="button" value="save" id="btn" size="30" onclick="save()" style="position:absolute;top:7%;left:10%;">
    <input type="button" value="clear" id="clr" size="23" onclick="erase()" style="position:absolute;top:7%;left:13%;">
</body>
</html>
