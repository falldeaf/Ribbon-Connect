<?php 

	require_once("standardbody.php");
	$mobile = detect_mobile();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<meta name="HandheldFriendly" content="True" />

<title>Home Connect</title>

<link REL="icon" type="image/ico" href="hc-favicon.ico" />

<link rel="stylesheet" type="text/css" href="mainstyle.css" />
<link rel="stylesheet" type="text/css" href="standardbody.css" />

<script src="http://www.google.com/jsapi"></script>
<script>google.load("jquery", "1.4.4");</script>
<script src="js/jquery.sparkline.min.js"></script>
<script src="js/processing-0.8.min.js"></script>
<script src="js/standardbody.js"></script>

<?php include_dynamic_js(); ?>

</head>
<body>

<!-- background/live-wallpaper -->
<?php if(!$mobile){ echo '<canvas height="100%" width="100%" id="animWallpaper" datasrc="live_wallpaper.php"></canvas>'; } ?>

<!-- representational windows -->
<?php if(!$mobile){ include_module_representation(); } ?>

<!-- informational box -->
<?php //include_informational_box(); ?>
 
<div id="center_column">

<!-- Create the dynamic categories -->
<?php include_module_header(); ?>

<!-- End of Dynamic category creation -->

<!-- in-page notification area
<div id="box1" class="module_container">
	<div id="module_header_<?=$module_title?>" class="module_header module_theme_A_<?=$module_category?>">
		<a onClick="auth_notify();"> Request notify perms </a>
		<a onClick="notify();"> Notify test </a>
	</div>
</div>
 -->

<!-- test apps here -->
<!-- end of app test -->

</div> <!--  End of Center column div -->

</body>
</html>
