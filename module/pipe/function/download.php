<?php

	$DEBUG = false;
	
	//Clean filenames to unix standards
	function clean_filename($filename)
	{ 
		$reserved = preg_quote('\/:*?"<>|', '/');//characters that are  illegal on any of the 3 major OS's 
		//replaces all characters up through space and all past ~ along with the above reserved characters 
		return preg_replace("/[^a-z0-9\\040\\.\\-\\_]/i", "", $filename); 
	}

	//simulate working, remove this later...
	//sleep(2);

	//unlink("TEMP");
	
	//Download the mp3 with youtube-dl python script, then get the video's title
	//then transcode it into an mp3 with the title as the mp3's filename: ($exval[0] . ".mp3")	
	//if(!$DEBUG) { exec("youtube-dl -o TEMP --no-progress " . escapeshellarg($_REQUEST['url']) ); }
	

	if($DEBUG) 
	{
		//DEBUG to test
		$yt_title = "Plaid - Whites Dream";
		$filename = "Plaid - Whites Dream.mp3";
	} else {
		exec("youtube-dl -e " . escapeshellarg($_REQUEST['url']), $exval );
		$yt_title = clean_filename($exval[0]);
		$filename = $yt_title . ".mp3";
	}
	
	//if(!$DEBUG) { exec("ffmpeg -y -i TEMP \"" . $filename . "\""); }
	
	//try to split out artist and title from song if possible. i.e. if it's properly 
	//formated by the youtuber: artist - title
	if( strpos($yt_title,"-") > 0)
	{
		list($yt_artist_split, $yt_title_split) = explode("-", $yt_title);
		$yt_artist_split = clean_filename(trim($yt_artist_split));
		$yt_title_split = clean_filename(trim($yt_title_split));
	} else {
		$yt_title_split = clean_filename($yt_title);
	}
	$yahoo_api = 'NhvRO2vV34GIhJpfr15eXV9kina96ynk_lxzEx.FtPrGHoTOl4EhWbRhejzHGT3xwI8k6CHU.g--';
		
	//function to clean a filename string so it is a valid filename

?>

<span id="filename" fn="<?php echo $filename;?>"></span>
<div id="mp3_debug"> </div>

<div class="dotted_container">

	<div class="field_label">Search title    </div> <input func_call="call_music_brainz" class="field_search" id="search_title" value="<?php echo $yt_title_split;?>"></input>
	<div class="field_label">Search artist    </div> <input func_call="call_music_brainz"  class="field_search" id="search_artist" value="<?php echo $yt_artist_split;?>"></input>

	<div class="tiny_text_control rotate_tag" act="left">&lsaquo;</div>
	<div class="tiny_text_control">Tag Info</div><div class="tiny_text_control" id="tag_order"></div>
	<div class="tiny_text_control rotate_tag" act="right">&rsaquo;</div><br />

	<div class="field_label">title    </div> <input class="tag_field" id="title"></input> <br />
	<div class="field_label">artist   </div> <input class="tag_field" id="artist"></input> <br />
	<div class="field_label">album    </div> <input class="tag_field" id="album"></input> <br />
	<div class="field_label">year     </div> <input class="tag_field" id="year"></input> <br />
	<div class="field_label">genre    </div> <input class="tag_field" id="genre"></input> <br />
	<div class="field_label">comment  </div> <input class="tag_field" id="comment"></input> <br />
	<div class="field_label">track    </div> <input class="tag_field" id="track"></input> <br />
</div>

<div class="dotted_container">
	<div class="field_label">Search album   </div> <input func_call="call_Yahoo_image_search" class="field_search" id="search_album" value="<?php echo $yt_title;?>"></input>
	
	<div class="tiny_text_control rotate_img" act="left">&lsaquo;</div>
	<div class="tiny_text_control">Album Cover</div><div class="tiny_text_control" id="img_order"></div>
	<div class="tiny_text_control rotate_img" act="right">&rsaquo;</div>

	<img id="album_show" src="http://www.bboynyc.com/wp-content/uploads/2010/02/music-notes-main_Full-300x300.jpg" width="280" height="280" />
	<div class="field_label">imageurl </div> <input class="tag_field" id="imageurl"></input> <br />
</div>

<br />
<div class="button_small done">tag it!</div>


<script>

var tagArray = new Array();
var imgArray = new Array();
var cur_index_img = 0;
var cur_index_tag = 0;

$(".rotate_tag").click(function(event){

	if( $(this).attr('act') == "left" && cur_index_tag > 0 )
	{
		cur_index_tag--;
		update_tag(cur_index_img, tagArray);
		
	} else if( $(this).attr('act') == "right" && cur_index_tag < (tagArray.length - 1) ) {

		cur_index_tag++;
		update_tag(cur_index_tag, tagArray);

	}
	
});

$(".rotate_img").click(function(event){

	if( $(this).attr('act') == "left" && cur_index_img > 0 )
	{
		cur_index_img--;
		update_img(cur_index_img, imgArray);
		
	} else if( $(this).attr('act') == "right" && cur_index_img < (imgArray.length - 1) ) {

		cur_index_img++;
		update_img(cur_index_img, imgArray);

	}
	
});

$(".field_search").change(function(){

	//alert( $(this).attr('func_call') );
	if (typeof(window[$(this).attr('func_call')]) === "function")
	{
		window[$(this).attr('func_call')] () ;
	}
	
	
});
				

function update_img(index, array)
{
	if( !(array.length < 1) )
	{
		$('#img_order').html( (cur_index_img + 1) + ' of ' + imgArray.length );
		$('#imageurl').val(array[index]);
		$('#album_show').attr('src', array[index]);
	}
}

function update_tag(index, array)
{
	if( !(array.length < 1) )
	{	
		$('#tag_order').html( (cur_index_tag + 1) + ' of ' + tagArray.length );
		$('#title').val(array[index][0]);
		$('#artist').val(array[index][1]);
		$('#album').val(array[index][2]);
		$('#year').val(array[index][3]);
		$('#genre').val(array[index][4]);
		$('#comment').val(array[index][5]);
		$('#track').val(array[index][6]);
	}
}

//finished, call the tag and move script
$(".done").click(function(event){

	$("#mp3_message").html(loader_html + 'Retrieving mp3, please wait...').show('fast');

	$("#mp3fix").hide();
	
	$('#mp3fix').load('module/pipe/function/tagandsave.php?file=' + escape($('#filename').attr('fn'))
			+ '&title=' + escape($('#title').val()) 
			+ '&artist=' + escape($('#artist').val())
			+ '&album=' + escape($('#album').val())
			+ '&year=' + escape($('#year').val())
			+ '&genre=' + escape($('#genre').val())
			+ '&comment=' + escape($('#comment').val())
			+ '&track=' + escape($('#track').val())
			+ '&imageurl=' + escape($('#imageurl').val())
			+ '&url=' +  $('#yturl').val()
			);

});

function call_music_brainz ()
{
	var tag_query = "http://musicbrainz.org/ws/1/track/?type=xml&title=" + escape( $('#search_title').val() ) + "&artist=" + escape( $('#search_artist').val() )
	//get the xml of the album covers
	//alert( tag_query );
	$.post("module/pipe/function/xmlProxy.php", { proxy: tag_query },
		function parse_tag(xml) {
			//alert( xml );
			var temp_count = 0;
			var xmlR = xml.replace(/title/g,'FUCK');
			//$('#mp3_debug').text(xml);
			alert( $(xmlR).text() );
			$(xmlR).find('track').each(function()
				{
				  	var tempArray = new Array();	
					//alert(  $(this).text() ); //find('duration').html() ); //.attr('id') );
					//alert( $(this).find('name').text() );

					tempArray[1] = $(this).find('name').text();
					tempArray[6] = $(this).find('track-list').attr('offset');

					alert( tempArray[1] );
					
					var temp_count2 = 0;
					$(this).find('FUCK').each(function()
					{
						if(temp_count2 == 0)
						{
							tempArray[0] = $(this).text();
						} else {
							tempArray[2] = $(this).text();
						}
						
						temp_count2 ++;
					});
					
					tagArray[temp_count] = tempArray; 
					temp_count++;
				});
				cur_index_tag = 0;
				update_tag(cur_index_tag, tagArray);
			});
}

function call_Yahoo_image_search ()
{
	
	var image_query = "http://boss.yahooapis.com/ysearch/images/v1/" + escape( $('#search_album').val() ) + "?appid=NhvRO2vV34GIhJpfr15eXV9kina96ynk_lxzEx.FtPrGHoTOl4EhWbRhejzHGT3xwI8k6CHU.g--&format=xml"; 
	//get the xml of the album covers
	$.post("module/pipe/function/xmlProxy.php", { proxy: image_query },
		function parse_img(xml) {
			//alert( xml );
			var temp_count = 0;
			$(xml).find("url").each(function()
					  {
						//alert( $(this).html() );
					    imgArray[temp_count] = $(this).html(); 
					    temp_count++;
					  });
			cur_index_img = 0;
			update_img(cur_index_img, imgArray);
		});
}

//call once on load for each
call_Yahoo_image_search();
//call_music_brainz();
$('#mp3_message').html('').hide();

</script>