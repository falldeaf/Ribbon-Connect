<?php 

/*
 * static Vars
 */




/*
 * func: include the javascript files
 * from each module's module/js directory
 * arg: none
 */
function include_dynamic_js()
{

	//define the path as relative
	$path = "module/";
	//using the opendir function
	$dir_handle = @opendir($path) or die("Unable to open $path");
	//loop through the module directory
	while (false !== ($file = readdir($dir_handle)))
	{
			if($file!="." && $file!="..")
			{
		        //echo "-- $file --<br/>";
				//require("module/" . $file . "/head.php");

						//define the path as relative
						$path2 = $path . $file . "/js/";
						//using the opendir function
						$dir_handle2 = @opendir($path2) or die("Unable to open $path2");
						//running the while loop
						while ($jsfile = readdir($dir_handle2))
						{
							if($jsfile!="." && $jsfile!="..")
							{
		        				//echo "-- $file --<br/>";
								?><script src="module/<?=$file?>/js/<?=$jsfile?>"></script><? 
					        }
						}	
						//closing the directory
						closedir($dir_handle2);
		
	        }
	}
	//closing the directory
	closedir($dir_handle);

}


//this function builds the control ribbon
function include_module_header()
{
	//define the path as relative
	$path = "module/";

	//using the opendir function
	$dir_handle = @opendir($path) or die("Unable to open $path");

	//running the while loop
	while (false !== ($file = readdir($dir_handle)))
	{
	        if($file!="." && $file!="..")
	        {
		        //echo "-- $file --<br/>";
	        	require("module/" . $file . "/head.php");
	        	
	        	if($active)
	        	{
		?>

		        <div id="box1" class="module_container">
		                <div id="module_header_<?=$module_title?>" class="module_header module_theme_A_<?=$module_category?>">
                		        <div id="module_header_layer_<?=$module_title?>" class="module_header_layer module_theme_B_<?=$module_category?>">
			                        <div id="module_header_center_<?=$module_title?>" class="module_header_center">
			                                <div class="module_stat">
			                                	<div class="<?=$graph_type?>spark module_header_graph"><?=$graph_data?></div>
			                                	<div class="module_header_bar_description"><?=$graph_description?></div>
			                                </div>
			                                <div class="module_title"><strong><?=strtoupper($module_title)?></strong></div>
		        	                        <div onclick="toggleModule('<?=$module_title?>');" id="module_collapse_<?=$module_title?>" class="module_collapse">+</div>
		                	                <div class="clearing"></div>
		                        	</div>
		                        </div>
		                </div>
		                <div id="module_body_<?=$module_title?>"  class="module_body module_theme_B_<?=$module_category?>">
	
				</div>
		        </div>

		<?
	        	}
		
	        }
	}

	//closing the directory
	closedir($dir_handle);
}

//this function builds the control ribbon representation
function include_module_representation()
{
	//define the path as relative
	$path = "module/";

	//using the opendir function
	$dir_handle = @opendir($path) or die("Unable to open $path");
	
	//contain div for representational picker
	?>
		<div id="rep_div">
	<?

	$count = 0;
	//running the while loop
	while (false !== ($file = readdir($dir_handle)))
	{
	        if($file!="." && $file!="..")
	        {
		        //echo "-- $file --<br/>";
	        	require("module/" . $file . "/head.php");
	        	
	        	if($active)
	        	{
		?>

		        <div id="<?=$module_title?>_contain_rep" class="module_container_representation">
		          <div class="module_label"><?=$module_title?></div>
		          <div class="module_box_background"><div id="module_box_<?=$module_title?>" class="module_box module_theme_single_color_<?=$module_category?>" onclick="scrollModule('<?=$module_title?>');" ondblclick="toggleModule('<?=$module_title?>');"></div></div>
		          <div class="module_extended_background"><div id="module_extended_<?=$module_title?>" class="module_extended module_theme_single_color_<?=$module_category?>" onclick="toggleModule('<?=$module_title?>');"></div></div>
		        </div>
                <div class="clearing"></div>

		<?
	        	}
		
			$count++;
	        }
	}

	//contain div for rep picker close
	?>
		</div>
	<?

	//closing the directory
	closedir($dir_handle);
}

function include_informational_box()
{
	?>
    
    <div id="information-block-container">
    	<div id="global_info_container">
        </div>
        <div id="local_info_container">
        </div>
    </div>
    
    <?
}

function detect_mobile()
{
	$mobile_browser = '0';
	 
	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$mobile_browser++;
	}
	 
	if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
		$mobile_browser++;
	}    
	 
	$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
	$mobile_agents = array(
		'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
		'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
		'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
		'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
		'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
		'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
		'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
		'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
		'wapr','webc','winw','winw','xda ','xda-');
	 
	if (in_array($mobile_ua,$mobile_agents)) {
		$mobile_browser++;
	}
	 
	if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini') > 0) {
		$mobile_browser++;
	}
	 
	if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) {
		$mobile_browser = 0;
	}
	 
	if ($mobile_browser > 0) {
		return true;
	} else {
		return false;
	}
   
}
?>