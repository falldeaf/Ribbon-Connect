<?php
$DEBUG = false;
require("mp3id3write.php");

$dir = "/media/a7bb8396-0089-4d7a-a388-2ec507632905/music/";
//$imageurl = "http://sleevage.com/wp-content/uploads/2007/08/keane_under_the_iron_sun.jpg";

//if debug is true fake some download time and display the output
if($DEBUG) 
{ 

	//sleep(2); 
	
	echo "Saving this data<br />";
	echo 	$_REQUEST['file'] . " " . 
			$_REQUEST['title'] . " " .  
			$_REQUEST['artist'] . " " . 
	 		$_REQUEST['album'] . " " . 
			$_REQUEST['year'] . " " . 
			$_REQUEST['genre'] . " " . 	 
			$_REQUEST['comment'] . " " . 
			$_REQUEST['track'] . " " . 
			$_REQUEST['imageurl'] . " " .
			$_REQUEST['url'];
} else {

	//Download the flv and convert it to mp3
	exec("youtube-dl -o TEMP --no-progress " . escapeshellarg($_REQUEST['url']) ); 
	exec("ffmpeg -y -i TEMP \"" . $_REQUEST['file'] . "\""); 
	
	//check if mp3 is intact with new name
	if (!file_exists($_REQUEST['file']))
	{
		$mp3_mess =  "Error! " . $_REQUEST['file'] . " isn't there :(";
	} else {
	
		if (tagWrite($_REQUEST['file'], 
				 $_REQUEST['title'], 
				 $_REQUEST['artist'],
		 		 $_REQUEST['album'],		 
				 $_REQUEST['year'],		 
				 $_REQUEST['genre'],		 
				 $_REQUEST['comment'],
				 $_REQUEST['track'],
				 $_REQUEST['imageurl'] ) )
		{
			if( copy($_REQUEST['file'], $dir . $_REQUEST['file']) )
			{
				$mp3_mess =  "Tagged and bagged, the mp3 is yours!";
				unlink("TEMP");
				unlink($_REQUEST['file']);
			} else {
				$mp3_mess = "Error, couldn't copy file :( ";
			}
		}
		
	}//if_file
}//debug

?>

<script>
	function notify_download_complete()
	{
			var notification = webkitNotifications.createNotification(
			'48.png',  // icon url - can be relative
			'youtube video DLd and CVd',  // notification title
			'The file <?=$_REQUEST['file']?> has been downloaded and converted successfully'  // notification body text
			);
			notification.show();
	}

	$('#yturl').val('');
	$("#mp3fix").show();
	$('#mp3_message').html('<?=$mp3_mess?>');
	notify_download_complete();
</script>