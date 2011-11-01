<?
#change the line below that has localhost pointing to the address of your frontend.
$HOSTNAME = "localhost";

$submit = $_REQUEST['submit'];

#if we aren't being posted to, then don't do anything useful
if ( $submit == "" )
{
	echo "Sorry, this file is meant to be called by one of the frontend ";
	echo "pages, please try using one of them instead.";
	exit();
}

# We set jump when we want to perform more complex commands
$jump="";

if ($submit == "Power"){
	#Power - not really used yet
	$key = "";
} else if ($submit == "tv"){
	$jump = "livetv";
} else if ($submit == "music"){
	$jump = "playmusic";
} else if ($submit == "video"){
	$jump = "mythvideo";
} else if ($submit == "record"){
	$jump = "playbackrecordings";
} else if ($submit == "guide"){
	$jump = "programguide";
} else if ($submit == "gallery"){
	$jump = "mythgallery";
} else if ($submit == "Back") {
	$key = "escape";
} else if ($submit == "Info") {
	$key = "i";
} else if ($submit == "Menu") {
	#Menu
	$key = "m";
} else if ($submit == "Up") {
	$key = "up";
} else if ($submit == "Left") {
	$key = "left";
} else if ($submit == "Down") {
	$key = "down";
} else if ($submit == "Right") {
	$key = "right";
} else if ($submit == "OK") {
	$key = "enter";
} else if ($submit == "Page Up") {
	$key = "pageup";
} else if ($submit == "Page Dn") {
	$key = "pagedown";
} else if ($submit == "Vol_Up") {
	$key = "bracketright";
} else if ($submit == "Vol_Dn") {
	$key = "bracketleft";
} else if ($submit == "mute") {
	$key = "f9";
} else if ($submit == "pause") {
	$key = "p";
} else if ($submit == "stop") {
	$key = "s";
} else if ($submit == "play") {
	$key = "p";
} else if ($submit == "rec") {
	$key = "r";
} else if ($submit == "<<") {
	$key = "left";
} else if ($submit == ">>") {
	$key = "right";
} else if ($submit == "|<") {
	#skip commercial back
	$key = "q";
} else if ($submit == ">|") {
	#skip commercial
	$key = "z";
# Special keys used by myPVR
} else if ($submit == "#") {
	# Change tuner
	$key = "y";
} else if ($submit == "*") {
	#skip commercial
	$key = "z";
} else if ($submit == "0" ||
           $submit == "1" ||
           $submit == "2" ||
           $submit == "3" ||
           $submit == "4" ||
           $submit == "5" ||
           $submit == "6" ||
           $submit == "7" ||
           $submit == "8" ||
           $submit == "9" ) {
	$key = $submit;
}

#set the maximum time to execute the page
set_time_limit (5);

#open the socket to the frontend
$fp = fsockopen($HOSTNAME, 6546, $errno, $errstr, 30);

if (!$fp) {
	#couldn't connect, print the error
	echo "ERROR: $errstr ($errno)<br />\n";
	exit();
} else {
	#set up a place for the banner to get read into
	$banner = "";

	#read through the banner, one char at a time and append
	#to the banner string until we see a '#'
	$c = fgetc($fp);
	while ($c !== false && $c != "#")
	{
		$banner .= $c;
		$c = fgetc($fp);
	}
	if ($c !== false)
	{
		#if the connection is still valid then read
		#in the extra space after the #
		$c = fgetc($fp);
	}

	#create the command to issue to the frontend based
	#on what the user clicked on
	if ($jump != "") {
		$cmd = "jump $jump\x0d\x0a";
		$jump="";
	} else {
		$cmd = "key $key\x0d\x0a";
	}

	#write the command to the socket
	fwrite($fp,$cmd);

	#close the socket
	fclose($fp);
}

echo "success";
?>
