<?
// Set the module name and give it a category number
$module_title = "pipe";
$module_category = "3";
$active = true;

$dst = disk_total_space("/media/a7bb8396-0089-4d7a-a388-2ec507632905/");
$dsa = disk_free_space("/media/a7bb8396-0089-4d7a-a388-2ec507632905/");

$graph_type = "pie";
$graph_description = "Disk space";
$graph_data = (string)$dsa . ", " . (string)($dst - $dsa);

//Debug: will echo out above header box
//echo (string)$dsa . ", " . (string)($dst - $dsa);
?>
