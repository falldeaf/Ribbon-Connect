<?php


require("mp3tag.php");
 //Reads ID3v1 from a MP3 file and displays it
 
 
$mp3 = $_REQUEST['mp3']; //"1.mp3"; //MP3 file to be read
$dir = './';
 
$handle = opendir($dir);
while (false !== ($file = readdir($handle))){
  $extension = strtolower(substr(strrchr($file, '.'), 1));
  if($extension == 'mp3')  {

	echo $file . "|" . $extension . "<br />" ;
  
  	$ID3 = new ID3v1x($dir . $file);
  	
  /*	if($ID3->write_tag(1, "Title Test", "Artist Test", "Album Test", "2003", "Fatih Hood Test", "2", "13") == true) {
  echo "Successful!"; 
} 
else { 
  echo "Error!"; 
} */
  	
  	if($ID3->read_tag() == true) { 
  echo "-] : File : $file<br>"; 
  echo "-] : ----------------------------------<br>"; 
  echo "-] : ID3v1 : $ID3->tag<br>"; 
  echo "-] : Title : $ID3->title<br>"; 
  echo "-] : Artist : $ID3->artist<br>"; 
  echo "-] : Album : $ID3->album<br>"; 
  echo "-] : Year : $ID3->year<br>"; 
  echo "-] : Comment : $ID3->comm<br>"; 
  echo "-] : Track : $ID3->track<br>"; 
  echo "-] : Genre : $ID3->genre<br>"; 
  echo "-] : ----------------------------------<br>"; 
} 
else { 
  echo "Error! - cannot read tag<br />"; 
} 

  } 
} 
   closedir($handle); 

?>
