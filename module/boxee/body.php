<div id="report_boxee"></div>

<div id="Mute" class="button_small boxee">Mute</div>
<div id="SendKey(270)" class="button_small boxee">&uarr;</div>
<div id="Pause" class="button_small boxee">Pause</div>

<div class="clearing"></div>

<div id="SendKey(272)" class="button_small boxee">&larr;</div>
<div id="SendKey(256)" class="button_small boxee">Select</div>
<div id="SendKey(273)" class="button_small boxee">&rarr;</div>

<div class="clearing"></div>

<div id="Stop" class="button_small boxee">Stop</div>
<div id="SendKey(271)" class="button_small boxee">&darr;</div>
<div id="SendKey(275)" class="button_small boxee">Back</div>

<div class="clearing"></div>

<p>
	<div id="progress_bar" class="load-bar-background rounded">
			<div id="progress_bar_value" class="load-bar-background-value rounded"></div>
	</div>
</p>

<p>
	<div id="volume_bar" class="load-bar-background rounded">
			<div id="volume_bar_value" class="load-bar-background-value rounded" style="width:60%"></div>
	</div>
</p>

<script>

//clear interval on close!
setInterval ( "setProgress()", 5000 );

function setProgress ( )
{
	// refresh percentage
	$.get('http://192.168.1.150/module/boxee/control.php?url=192.168.1.150:8800/xbmcCmds/xbmcHttp?command=GetPercentage', function(data) {
		if (data == "Error" || data > 100)
		{
			$('#progress_bar_value').width(0);
		} else {
			$('#progress_bar_value').width(parseInt(data) + '%');
		}
	});
}

//listen to buttons and execute
$(".boxee").mousedown(function(event)
{
	$.get("http://192.168.1.150:8800/xbmcCmds/xbmcHttp?command=" + $(this).attr('id'));
});

//set initial volume bar
$.get('http://192.168.1.150/module/boxee/control.php?url=192.168.1.150:8800/xbmcCmds/xbmcHttp?command=GetVolume', function(data)
{
	$('#volume_bar_value').width(parseInt(data) + '%');
	  //alert('volume ' + data);
});

$('#progress_bar').click(function(e)
{
    //$('#mouse-xy').html("X: " + e.pageX + " Y: " + e.pageY);
   
    var x = e.pageX; // - this.position();
    //var x = getAbsolutePosition(document.getElementById('progress_bar'));
    var ratio = x * 100 / $('#progress_bar').width;
    alert(e.pageX + " " + this.position() + " " + x);
    //$.get("http://192.168.1.150:8800/xbmcCmds/xbmcHttp?command=SetProgress(" + ratio + ")");
});

$('#mouse-click').click(function(e)
{
    $('#mouse-xy').html("X: " + e.pageX + " Y: " + e.pageY);
});

</script>