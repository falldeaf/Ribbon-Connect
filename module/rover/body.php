<div id="report_rover"></div>

<p></p>

<img src="http://192.168.1.140:8168/GetData.cgi" width="280" height="220" />

<p></p>

<div id="rot_left" class="button_small rover">rot-L</div>
<div id="move_forward" class="button_small rover">forward</div>
<div id="rot_right" class="button_small rover">rot-R</div>
<div class="clearing"></div>
<div id="move_left" class="button_small rover">left</div>
<div id="" class="button_small rover">home</div>
<div id="move_right" class="button_small rover">right</div>
<div class="clearing"></div>
<div class="button_small rover">Back</div>
<div id="move_back" class="button_small rover">back</div>
<div class="button_small rover">Guide</div>
<div class="clearing"></div>

<script>
var MOVEMENT_INTERVAL = 200;
var movement_interval_id = -1;

get_comm("http://192.168.1.140/rev.cgi?Cmd=nav&action=1");
//get_comm(escape('http://192.168.1.140:8168/rev.cgi?Cmd=nav&action=1'));

function get_comm(rurl)
{
	//$('#report_rover').post();
	$.post('module/rover/control.php', { rurl: rurl }, 
		function(data){
			alert("Data Loaded: " + data);
		});
}

$(".rover").mousedown(function(event){
	//alert($(this).attr('id'));
	startMoving($(this).attr('id'), 5);
	//$.get("http://192.168.1.140:8168/rev.cgi?Cmd=nav&action=22

});

$(".rover").mouseup(function(event){
	stopMoving();	
});

function startMoving(move_id,speed){
    if(speed == null){
        speed = movement_speed;
    }
    if(movement_interval_id != -1){
        clearInterval(movement_interval_id);
    }
    move(move_id,speed);    
    movement_interval_id = setInterval("move('" + move_id + "', " + speed + ")",MOVEMENT_INTERVAL);
}

function move(move_id,speed){

    speed = 5;
    is_moving = 1;

    var drive_cmd = 0;
            
    switch(move_id){
        case 'rot_left':
            drive_cmd = 5;
            break;
        case 'rot_right':
            drive_cmd = 6;
            break;
        case 'move_forward':
            drive_cmd = 1;
            break;
        case 'move_left':
            drive_cmd = 3;
            break;
        case 'move_right':
            drive_cmd = 4;
            break;
        case 'move_back':
            drive_cmd = 2;
            break;   
        case 'move_fwd_left':
            drive_cmd = 7;
            break;
        case 'move_fwd_right':
            drive_cmd = 8;
            break;
        case 'move_bck_left':
            drive_cmd = 9;
            break;
        case 'move_bck_right':
            drive_cmd = 10;
            break;
    }
    if(move_id.indexOf('rotr_') != -1){
        var angle = move_id.substr(5);
        get_comm("http://192.168.1.140/rev.cgi?Cmd=nav&action=18&drive=18&speed=" + speed + "&angle=" + angle);
        //$.get("http://192.168.1.140/rev.cgi?Cmd=nav&action=18&drive=18&speed=" + speed + "&angle=" + angle);
    } else if(move_id.indexOf('rotl_') != -1) {
        var angle = move_id.substr(5);
        get_comm("http://192.168.1.140/rev.cgi?Cmd=nav&action=18&drive=17&speed=" + speed + "&angle=" + angl);
        //$.get("http://192.168.1.140/rev.cgi?Cmd=nav&action=18&drive=17&speed=" + speed + "&angle=" + angle);
    } else {
        if(drive_cmd){
        	get_comm("http://192.168.1.140/rev.cgi?Cmd=nav&action=18&drive=" + drive_cmd + "&speed=" + speed);
        	//$.get("http://192.168.1.140/rev.cgi?Cmd=nav&action=18&drive=" + drive_cmd + "&speed=" + speed);
        }
    }
}

function stopMoving(){
    is_moving = 0;
    //$.get("http://192.168.1.140/rev.cgi?Cmd=nav&action=33");
    get_comm("http://192.168.1.140/rev.cgi?Cmd=nav&action=33");
    //sendMCUCommand("114D4D000100534852540001000100000000");
    if(movement_interval_id != -1){
        clearInterval(movement_interval_id);
    }
}

</script>