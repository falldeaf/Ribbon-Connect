<span class="tiny_text_description"> Enter a torrent url and click [get it]</span><br />
<input id="torrenturl"></input>
<div id="ytbut" class="button_small">get it</div>
<div class="clearing"></div>
<br />

<?

require_once("function/TransmissionRPC.class.php");

$test_torrent = "http://releases.ubuntu.com/10.04/ubuntu-10.04-netbook-armel+dove.img.torrent";

$rpc = new TransmissionRPC();
$rpc->username = '';
$rpc->password = '';
//$rpc->debug = true;

  $result = $rpc->get();
  //print_r($result->arguments->torrents);
  
  //echo "<div class='dotted_container'>";
  foreach($result->arguments->torrents as $val)
  {
  	$percent = round( $val->haveValid / $val->totalSize, 2 ) * 100;
  	display_torrent_info($percent, $val->status, $val->name, $val->id, $val->doneDate);
  	echo "<p />";
  }
  //echo "</div>";
  
function display_torrent_info ( $percent, $status, $name, $id, $ddate)
{
  /*
   *  Status number guesses:
   *  4  - downloading
   *  8  - finished / seeding
   *  16 - paused 
   */
  	
  	switch($status)
  	{
  	case 4:
  		$color = "#FFFFFF";
  		break;
  	case 8:
  		$color = "#00FF00";
  		break;
  	case 16:
  		$color = "#999999";
  		//$color = "#00FF00";
  		break;
  	default:
  		$color = "#FF0000";
  		break;
  	}
	
  	
  	//Display torrent
  	?>

	<div class='tiny_text_description' style='width:218px; color:<?=$color?>;'> <?=name_abridge($name)?> </div>
	<div class='tiny_text_control remove_torrent' tid='<?=$id?>' style='color:#000000;'>X</div>
  	<div class='load-small-bar-background'>
  		<div class='load-small-bar-background-value' style='background-color:<?=$color?>; width:<?=$percent?>%;'></div>
  	</div>
  	
  	<!-- <p>
  	<div class='tiny_text_description' style='width:240px; color:<?=$color?>;'> 
  		 <?=$ddate?> :  <?=time()?> :
  	</div>
  	</p> -->
  	
  	<?php 
}

function name_abridge ($name)
{
	$length = 35;

	if(strlen($name) < $length)
	{
		return $name;
	} else {
		return substr($name, 0, $length - 1) . "...";
	}
}

?>