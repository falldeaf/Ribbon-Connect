<?php
// Define variables in case they aren't all passed in.
// this way we won't get 'undefined variable' warnings in
// log files.

$device = "";
$action = "";
$name = "";
$change = "";

$device = $_REQUEST["d"];
$action = $_REQUEST["a"];
$name =   $_REQUEST["n"];

if (($action == "fbright") || ($action == "fdim"))
   { 
     $change = $_REQUEST["c"];
   }

$command = "heyu $action $device $change";

//echo "command sent";

exec($command);
//echo $exval[0];
?>

<script>
	//alert('control alert');
	$('#power_result').html('command sent').delay(1600).hide(600);
</script>