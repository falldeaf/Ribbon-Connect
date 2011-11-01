<div class="tab_box">
	<div id="music_tab" class="tab" act="music_pipe">music</div>
	<div id="torrent_tab" class="tab" act="torrent_pipe">torrent</div>
	<div id="file_tab" class="tab" act="file_pipe">file</div>
</div>

<div id="tab_content">

<?php 
require("music_pipe.php");
?>

</div>

<script>

$(".tab").click(function(event){
	//alert( 'module/pipe/function/download.php?url=' + $('#yturl').val() );
	$("#tab_content").html(loader_html + ' choding...').show('fast');
	$("#tab_content").load('module/pipe/' + $(this).attr('act') + '.php');	
});

</script>