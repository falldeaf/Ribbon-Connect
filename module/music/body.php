<link rel="stylesheet" type="text/css" href="style.css" media="all">

<div id="jquery_jplayer"></div>

<div class="jp-playlist-player">
	<div class="jp-interface">
			<div id="jplayer_previous" class="jp-previous button_small">prev</div>
			<div id="jplayer_play" class="jp-play button_large">play</div>
			<div id="jplayer_pause" class="jp-pause button_large">pause</div>
			<div id="jplayer_stop" class="jp-stop button_small">stop</div>
			<div id="jplayer_next" class="jp-next button_small">next</div>
			<div class="clearing"></div>
		
		<!-- 		<div class="jp-progress">
		</div> -->

		<p>
		<!--  <div id="jplayer_play_time" class="jp-play-time"></div> -->
		<div id="jplayer_load_bar" class="load-bar-background rounded">
			<div id="jplayer_play_bar" class="load-bar-background-value rounded"></div>
		</div>
		<!--  <div id="jplayer_total_time" class="jp-total-time"></div> -->
		</p>

		<p>
		<!--  <div id="jplayer_volume_min" class="jp-volume-min">min volume</div> -->
		<div id="jplayer_volume_bar" class="load-bar-background rounded">
			<div id="jplayer_volume_bar_value" class="load-bar-background-value rounded"></div>
		</div>
		<!--  <div id="jplayer_volume_max" class="jp-volume-max">max volume</div> -->
		</p>
		
		
	</div>

	<div id="jplayer_playlist" class="jp-playlist">
		<ul>
			<!-- The function displayPlayList() uses this unordered list -->
		</ul>
	</div>
</div>




<script>
var playItem = 0;

var myPlayList = [<? 
	//define the path as relative
	$path = "music/";
	//using the opendir function
	//$dir_handle = @opendir($path) or die("Unable to open $path");
	//flag to check if it's the first run
	$first = 1;
	//running the while loop
	//while ($file = readdir($dir_handle))
	$music_arr = scandir($path);
	foreach($music_arr as &$file)
	{
		if($file!="." && $file!="..")
		{
				?>{name:"<?=$file?>",mp3:"module/music/music/<?=htmlentities($file)?>"},<?
		}
	}	
	//closing the directory
	//closedir($dir_handle);

	//{name:"Tempered Song",mp3:"http://www.miaowmusic.com/mp3/Miaow-01-Tempered-song.mp3"},
	//{name:"Thin Ice",mp3:"http://www.miaowmusic.com/mp3/Miaow-10-Thin-ice.mp3"}

?>{name:"Thin Ice",mp3:"http://www.miaowmusic.com/mp3/Miaow-10-Thin-ice.mp3"}
];

// Local copy of jQuery selectors, for performance.
var jpPlayTime = $("#jplayer_play_time");
var jpTotalTime = $("#jplayer_total_time");

$("#jquery_jplayer").jPlayer({
	ready: function() {
		displayPlayList();
		playListInit(true); // Parameter is a boolean for autoplay.
	}
})
.jPlayer("onProgressChange", function(loadPercent, playedPercentRelative, playedPercentAbsolute, playedTime, totalTime) {
	jpPlayTime.text($.jPlayer.convertTime(playedTime));
	jpTotalTime.text($.jPlayer.convertTime(totalTime));
})
.jPlayer("onSoundComplete", function() {
	playListNext();
});

$("#jplayer_previous").click( function() {
	playListPrev();
	return false;
});

$("#jplayer_next").click( function() {
	playListNext();
	return false;
});

function displayPlayList() {
	for (i=0; i < myPlayList.length; i++) {
		$("#jplayer_playlist ul").append("<li id='jplayer_playlist_item_"+i+"'>"+ myPlayList[i].name +"</li>");
		$("#jplayer_playlist_item_"+i).data( "index", i ).click( function() {
			var index = $(this).data("index");
			if (playItem != index) {
				playListChange( index );
			} else {
				$("#jquery_jplayer").jPlayer("play");
			}
		});
	}
}

function playListInit(autoplay) {
	if(autoplay) {
		playListChange( playItem );
	} else {
		playListConfig( playItem );
	}
}

function playListConfig( index ) {
	$("#jplayer_playlist_item_"+playItem).removeClass("jplayer_playlist_current");
	$("#jplayer_playlist_item_"+index).addClass("jplayer_playlist_current");
	playItem = index;
	$("#jquery_jplayer").jPlayer("setFile", myPlayList[playItem].mp3);
}

function playListChange( index ) {
	playListConfig( index );
	$("#jquery_jplayer").jPlayer("play");
}

function playListNext() {
	var index = (playItem+1 < myPlayList.length) ? playItem+1 : 0;
	playListChange( index );
}

function playListPrev() {
	var index = (playItem-1 >= 0) ? playItem-1 : myPlayList.length-1;
	playListChange( index );
}

</script>