<span class="tiny_text_description"> Enter a youtube url and click [get it]</span><br />
<input id="yturl"></input>
<div id="ytbut" class="button_small">get it</div>
<div class="clearing"></div>

<div id="mp3_message" class="message_box"></div>
<div id="mp3fix"></div>

<script>

$("#ytbut").click(function(event){
	//alert( 'module/pipe/function/download.php?url=' + $('#yturl').val() );
	$("#mp3_message").html(loader_html + 'Retrieving tag info, please wait...').show('fast');
	$("#mp3fix").load('module/pipe/function/download.php?url=' + $('#yturl').val() );	
});

</script>