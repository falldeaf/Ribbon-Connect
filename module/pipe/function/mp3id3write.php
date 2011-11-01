<?php
/////////////////////////////////////////////////////////////////
/// getID3() by James Heinrich <info@getid3.org>               //
//  available at http://getid3.sourceforge.net                 //
//            or http://www.getid3.org                         //
/////////////////////////////////////////////////////////////////
//                                                             //
// /demo/demo.simple.write.php - part of getID3()              //
// Sample script showing basic syntax for writing tags         //
// See readme.txt for more details                             //
//                                                            ///
/////////////////////////////////////////////////////////////////

function tagWrite($filename, $title, $artist, $album, $year, $genre, $comment, $track, $imageurl)
{

//height and width of cover album art
//$newwidth = 300;
//$newheight = 300;

//list($width, $height) = getimagesize($imageurl);


// Load
//$imgresource = @imagecreatefromjpeg($imageurl);
//$thumb = imagecreatetruecolor($newwidth, $newheight);
//$source = imagecreatefromjpeg($filename);

// Resize
/*
imagecopyresized($thumb, $imgresource, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

imagejpeg($thumb, "tempfile");
$cover = file_get_contents("tempfile"); 
unlink("tempfile");
*/

$TaggingFormat = 'UTF-8';

require_once('../../../lib/getid3/getid3.php');
// Initialize getID3 engine
$getID3 = new getID3;
$getID3->setOption(array('encoding'=>$TaggingFormat));

require_once('../../../lib/getid3/write.php');
// Initialize getID3 tag-writing module
$tagwriter = new getid3_writetags;
$tagwriter->filename       = $filename;
//$tagwriter->filename       = 'd:/file.mp3';
$tagwriter->tagformats     = array('id3v1', 'id3v2.3');

// set various options (optional)
$tagwriter->overwrite_tags = true;
$tagwriter->tag_encoding   = $TaggingFormat;
$tagwriter->remove_other_tags = true;

// populate data array
$TagData['title'][]   = $title;
$TagData['artist'][]  = $artist;
$TagData['album'][]   = $album;
$TagData['year'][]    = $year;
$TagData['genre'][]   = $genre;
$TagData['comment'][] = $comment;
$TagData['track'][]   = $track;

//$TagData['attached_picture'][]=array(
//'picturetypeid'=>3, // Cover. More: module.tag.id3v2.php -> function APICPictureTypeLookup
//'description'=>'cover', // text field
//'mime'=>'image/jpeg', // Mime type image
//'data'=>$cover // Image data
//);
//$TagData['attached_picture'][3]['data']          = $cover;
//$TagData['attached_picture'][3]['picturetypeid'] = '3';
//$TagData['attached_picture'][3]['description']   = "description";
//$TagData['attached_picture'][3]['mime']          = 'image/jpeg';

$tagwriter->tag_data = $TagData;

// write tags
if ($tagwriter->WriteTags()) {
	//echo 'Successfully wrote tags<br>';
	if (!empty($tagwriter->warnings)) {
		//echo 'There were some warnings:<br>'.implode('<br><br>', $tagwriter->warnings);
	}
	return true;
} else {
	//echo 'Failed to write tags!<br>'.implode('<br><br>', $tagwriter->errors);
	return false;
}

}

?>
